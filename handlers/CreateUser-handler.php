<?php
session_start();

require_once '../Dao.php';

if (empty($_POST["name"])) {
    die("Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 6) {
    die("Password must be at least 6 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$dao = new Dao();



$userName = trim($_POST["name"]);
$email = trim($_POST["email"]);
$dao->newUser($userName, $email, $password_hash);

header("Location: ../pages/signup.php");
exit;


