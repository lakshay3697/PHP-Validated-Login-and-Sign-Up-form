<?php 
		
		if(isset($_POST['log_button']))
		{
			$email=filter_var($_POST['log_email'],FILTER_SANITIZE_EMAIL); // sanitizing or removing any illegal characters ....
			$_SESSION['log_email']=$email;
			$password=md5($_POST['log_pass']);

			// query to check if user exists ...
			$u_exists=mysqli_query($con,"SELECT * FROM users WHERE email='$email' AND password='$password'");
			$u_exists_num_rows=mysqli_num_rows($u_exists);

			if($u_exists_num_rows==1)
			{
				// Fetching the username of the user from the database and storing in a session variable before moving on to index.php ......
				$row=mysqli_fetch_array($u_exists);
				$_SESSION['username']=$row['username'];

				// Query to check if the user account is closed or open ..... If closed then reopen the account again ....
				$user_closed=mysqli_query($con,"SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
				$u_closed_rows=mysqli_num_rows($user_closed);
				if($u_closed_rows==1)
				{
					$reopen=mysqli_query($con,"UPDATE users SET user_closed='no' WHERE email='$email'");
				}

				// Clearing the session variables as login is successful and after that redirecting the user to index.php.....
				$_SESSION['log_email']="";
				header("Location:index.php");
				exit(); 
			}
			else
			{
				array_push($error_array,"Email or password is incorrect <br>");
			}
		}

?>