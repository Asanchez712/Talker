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
  // Hash the password before storing it into the database
  $hashed_user_password = password_hash($user_password,PASSWORD_DEFAULT);
  //checking if the submitted email is already in users table
  $db_data = array($user_email);
  $isAlreadySignedUp = phpFetchDB('SELECT user_email FROM users WHERE user_email = ?', $db_data);
  $db_data = "";

//if no result is returned, insert new record to the table, otherwise display feedback
if (!is_array($isAlreadySignedUp)) {
  $db_data = array($user_email, $hashed_user_password, 0);
  phpModifyDB('INSERT INTO users (user_email, user_password, user_verified) values (?,?,?)', $db_data);
  $db_data = "";
  $verify_message = '

	Welcome to Talker! Thanks for signing up!<br><br>
	Your account has been created but before you can login you need to activate it with the link below.<br><br>

	Please click this link to activate your account:
	<a href="http://localhost:3000/verify.php?email='.$user_email.'&hash='.$hashed_user_password.'">Verify your email</a>

  ';

  phpSendEmail($user_email,'verify your account',$verify_message);
  }else{
    $_SESSION["msgid"] = "804";
  }
    header('Location: index.php');
  } else if (!$email_validation) {
    $_SESSION["msgid"] = "801";
    $_SESSION["formSignUpEmail"] = $user_email;
    header('Location: index.php');
  } else if (!$password_validation) {
    $_SESSION["msgid"] = "802";
    $_SESSION["formSignUpEmail"] = $user_email;
    header('Location: index.php');
  }else if ($user_password !== $user_password_confirmation){
    $_SESSION["msgid"] = "803";
    $_SESSION["formSignUpEmail"] = $user_email;
    header('Location: index.php');
}
?>