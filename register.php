<?php

require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tumse Na Ho Payega</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Lobster Two" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Archivo' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/register.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
	<?php 

		if(isset($_POST['reg_button'])){
			echo '
			<script>
			$(document).ready(function(){
				$("#first").hide();
				$("#second").show();
			});

			</script>
			';
		}



	 ?>

	<div class="login_box">
		<div class="login_header">
			<h2>Validated Login and Sign Up Form</h2>
			<label>Login or Sign Up below!</label>
		</div>
		<div id="first">
	<form action="register.php" method="POST">
		<input type="email" name="log_email" placeholder="Email Address" value="<?php
		if(isset($_SESSION['log_email']))
			echo $_SESSION['log_email'];
		?>" required>
		<br>
		<input type="password" name="log_pass" placeholder="Password" required>
		<br>		
		<input type="submit" name="log_button" value="Login">
		<br>
		<?php if(in_array("Email or password is incorrect <br>", $error_array)) 
		echo "Email or password is incorrect <br>";
		?>
		<a href="#" id="signup" class="signup">Need an account? Register here!</a>
	</form>
	</div>
	<br>
	<!-- Form for Registeration of a new user ...... -->
	<div id="second">
	<form action="register.php" method="POST">
		<input type="text" name="reg_fname" placeholder="First Name" value="<?php
		if(isset($_SESSION['reg_fname']))
			echo $_SESSION['reg_fname'];
		?>" required>
		<?php if(in_array("First name must be between 2 and 25 characters <br>", $error_array))
		echo "First name must be between 2 and 25 characters <br>";
		?>
		<input type="text" name="reg_lname" placeholder="Last Name" value="<?php
		if(isset($_SESSION['reg_lname']))
			echo $_SESSION['reg_lname'];
		?>" required>
		<?php if(in_array("Last name must be between 2 and 25 characters <br>", $error_array))
		echo "Last name must be between 2 and 25 characters <br>";
		?>
		<br>
		<input type="email" name="reg_email" placeholder="Email Address" value="<?php
		if(isset($_SESSION['reg_email']))
			echo $_SESSION['reg_email'];
		?>" required>
		<br>
		<input type="email" name="reg_email_2" placeholder="Confirm Email Address" value="<?php
		if(isset($_SESSION['reg_email_2']))
			echo $_SESSION['reg_email_2'];
		?>" required> 
		<?php if(in_array("E-mails don't match <br>", $error_array))
		{
			echo "E-mails don't match <br>";
		}
		else if(in_array("E-mail already in use <br>", $error_array))
		{
			echo "E-mail already in use <br>";
		}
		else if(in_array("Invalid E-mail format <br>", $error_array))
		{
			echo "Invalid E-mail format <br>";
		}
		?>
		<br>
		<label>Birthday :</label>
		<input type="date" name="r_dob" value="<?php
		if(isset($_SESSION['r_dob']))
			echo $_SESSION['r_dob'];
		?>" required>
		<br>
		<div class="gender">
		<input type="radio" name="sex" value="Female" value="<?php
		if(isset($_SESSION['sex']))
			echo $_SESSION['sex'];
		?>" required> <label>Female</label>
		<input type="radio" name="sex" value="Male" value="<?php
		if(isset($_SESSION['sex']))
			echo $_SESSION['sex'];
		?>" required> <label>Male</label>
		</div>
		<br>
		<input type="password" name="reg_pass" placeholder="Password" required>
		<br>
		<input type="password" name="reg_pass_2" placeholder="Confirm Password" required>
		<?php if(in_array("Your Passwords don't match <br>", $error_array))
		{
			echo "Your Passwords don't match <br>";
		}
		else if(in_array("Your password must be between 5 and 30 characters only <br>", $error_array))
		{
			echo "Your password must be between 5 and 30 characters only <br>";
		}
		?>
		<br>
		<input type="submit" name="reg_button" value="Register">
		<br>
		<?php if(in_array("Registeration Successful !! Go ahead and Login. <br>", $error_array))
		echo "<span style='color:green'> Registeration Successful !! Go ahead and Login. <br> </span>";
		?>
		<a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
	</form>
	</div>
	</div>
</body>
</html>