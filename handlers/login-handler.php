<?php
session_start();
require_once '../Dao.php';
$is_invalid = false;
$email = trim($_POST['email']);
$password = trim($_POST['password']);



$dao = new Dao();
$check = $dao->authenticate($email, $password);
if ($check) {
   $_SESSION['authenticated'] = 1;
   $_SESSION["user_id"] = $check["UserID"];
   if (isset($_SESSION['redirect_url'])) {
      $redirect_url = $_SESSION['redirect_url'];
      unset($_SESSION['redirect_url']); // Optional: clear the stored URL
      header("Location: $redirect_url");
      exit;
  } else {
      // If there's no stored URL, redirect to a default page
      header("Location: index.php");
      exit;
  }
} else {
   header('Location: ../pages/loginfailed.php');
}
//exit;