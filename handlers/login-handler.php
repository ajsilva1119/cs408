<?php

require_once '../Dao.php';
$is_invalid = false;
$email = trim($_POST['email']);
$password = trim($_POST['password']);


$dao = new Dao();
$check = $dao->authenticate($email, $password);
if ($check) {
    session_start();
    $_SESSION['authenticated'] = 1;
    $_SESSION["user_id"] = $check["UserID"];
   header('Location: ../index.php');
   exit;
} else {
   header('Location: ../pages/loginfailed.php');
}
//exit;