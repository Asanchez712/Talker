<?php

echo $_POST["formSignUpEmail"]; echo '<br>';
echo $_POST["formSignUpPassword"]; echo '<br>';
echo $_POST["formSignUpPasswordConf"]; echo '<br>';

$user_email= $_POST["formSignUpEmail"];
$user_password= $_POST["formSignUpPassword"];
$user_password_confirmation= $_POST["formSignUpPasswordConf"];

$user_email_pattern ='/^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})/';
$user_password_pattern ='/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@*$#]).{8,16}/';

$email_validation = preg_match($user_email_pattern, $user_email);
$password_validation = preg_match($user_password_pattern, $user_password);

if ($email_validation && $password_validation && $user_password == $_POST["formSignUpPasswordConf"]) {
  echo "Everything is valid, we can store the record to the database";
} else if ($user_password !== $user_password_confirmation){
  echo "Passwords don't match";
} else if (!$email_validation) {
  echo "Email doesn't meet the requirements";
} else if (!$password_validation) {
  echo "Password doesn't meet the requirements";
}

?>