<?php session_start(); require('system.ctrl.php');?>

<?php //?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TALKER</title>
    
    <!-- Bootstrap CSS -->
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">  </head>
  <body>
  <div class="container">
	<div class="row justify-content-md-center">
		<div style="margin-top: 80px" class="col-12 col-md-auto"><h1>TALKER | SIGN UP</h1></div>
	</div>

	<hr><br>

  <!-- SYSTEM-WIDE FEEDBACK -->
<?php if (isset($_SESSION["msgid"]) && $_SESSION["msgid"]!="" && phpShowSystemFeedBack($_SESSION["msgid"])[0]!="") { ?>

<div class="row">
  <div class="col-12">
    <div class="alert alert-<?php echo (phpShowSystemFeedBack($_SESSION['msgid'])[0]); ?>" role="alert">
      <?php echo (phpShowSystemFeedBack($_SESSION['msgid'])[1]); ?>
    </div>
  </div>
</div>

<?php } ?>
<!-- SYSTEM-WIDE FEEDBACK -->



	<div class="row">
		<div class="col-6">
			<form name="formSignUp" action="signup.ctrl.php" method="post" novalidate >
				<div class="form-group">
					<label for="formSignUpEmail">Email address</label>
					<input type="email" <?php echo (phpShowEmailInputValue($_SESSION["formSignUpEmail"]));?> 
          class="form-control <?php if($_SESSION["msgid"]!= "801" && $_SESSION["msgid"]!=""){echo 'is-valid';}
          else { echo (phpShowInputFeedback($_SESSION['msgid'])[0]); } ?> " 
          id="formSignUpEmail" 
          name="formSignUpEmail"
          placeholder="Enter your email address" 
          required pattern='^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})'>
          <?php if ($_SESSION["msgid"]== "801"){ ?>
            <div class="invalid-feedback">
             <?php echo (phpShowInputFeedback($_SESSION['msgid'])[1]);?>				    
            </div> 
          <?php } ?>  
        </div> 
				<div class="form-group">
					<label for="formSignUpPassword">Password</label>
					<input type="password" class="form-control <?php echo (phpShowInputFeedback($_SESSION['msgid'])[0]);?>" id="formSignUpPassword" 
          name="formSignUpPassword"
          placeholder="Enter your password" required pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@*$#]).{8,16}"
          onkeyup="jsSignUpValidatePassword()">
          <?php if ($_SESSION["msgid"]== "802"){ ?>
            <div class="invalid-feedback">
             <?php echo (phpShowInputFeedback($_SESSION['msgid'])[1]);?>				    
            </div> 
          <?php } ?>  


					<input type="password" class="form-control mt-4" id="formSignUpPasswordConf" 
          name="formSignUpPasswordConf"
          placeholder="Confirm your password" required pattern='(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@*$#]).{8,16}'
          onkeyup="jsSignUpValidatePassword()">

				</div>
        <p id='password_comparison' style='margin-top:20px'></p>
				<button style='margin-top:20px' type="submit" class="btn btn-primary btn-success">Sign Up</button>
			</form>
		</div>

		<div class="col-6">
			<p>Hello and welcome to Talker! We are very happy that you want to join our great community!</p>
			<p>Please, enter your email and password. Your must have access to your email because we will send
          a confirmation code to that address. Your password must be between 8 and 16 characters long, with at
          least one uppercase and one lowercase character, one number and one special character (@, *, $ or #).</p>
			<p>We hope you'll enjoy Talker!</p>
		</div>
	</div>
</div>

          <?php $_SESSION["msgid"]=""; $_SESSION["formSignUpEmail"] = ""; ?>


<script>
      var jsSignUpPassword = document.getElementById("formSignUpPassword");
      var jsSignUpPasswordConf = document.getElementById("formSignUpPasswordConf");

      function jsSignUpValidatePassword(){
        if(jsSignUpPassword.value != jsSignUpPasswordConf.value) {
          jsSignUpPasswordConf.setCustomValidity("Passwords don't match!");
		 document.getElementById("password_comparison").innerHTML = "<div class='alert alert-danger' role='alert'>Passwords don't match!</div>";
        } else {
          jsSignUpPasswordConf.setCustomValidity('');
		 document.getElementById("password_comparison").innerHTML = "";
        }
      }

</script>


    <!-- Optional Javascript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>    
  </body>
</html>
