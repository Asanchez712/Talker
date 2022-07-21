<?php

require("system.ctrl.php");
session_start();

// echo $_POST["formSignUpEmail"]; echo '<br>';
// echo $_POST["formSignUpPassword"]; echo '<br>';
// echo $_POST["formSignUpPasswordConf"]; echo '<br>';

$user_email= $_POST["formSignUpEmail"];
$user_password= $_POST["formSignUpPassword"];
$user_password_confirmation= $_POST["formSignUpPasswordConf"];

$user_email_pattern ='/^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})/';
$user_password_pattern ='/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@*$#]).{8,16}/';

$email_validation = preg_match($user_email_pattern, $user_email);
$password_validation = preg_match($user_password_pattern, $user_password);

if ($email_validation && $password_validation && $user_password == $_POST["formSignUpPasswordConf"]) {
    $db_data = array($user_email, $user_password);
    phpModifyDB('INSERT INTO users (user_email, user_password) values (?,?)',$db_data);
    $_SESSION["msgid"] = "811";
    header('Location: index.php');
} else if (!$email_validation) {
  $_SESSION["msgid"] = "801";
  header('Location: index.php');
} else if (!$password_validation) {
  $_SESSION["msgid"] = "802";
  header('Location: index.php');
}else if ($user_password !== $user_password_confirmation){
  $_SESSION["msgid"] = "803";
  header('Location: index.php');
}
?>