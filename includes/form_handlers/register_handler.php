<?php 

	// Declaring variables to store/accept the values received from the form via POST method ......
	$fname="";
	$lname="";
	$email_1="";
	$email_2="";
	$dob="";
	$gender="";
	$pass_1="";
	$pass_2="";
	$reg_date="";
	$error_array=array(); // To store error messages ..... 

	// Validating the form if the register button is clicked i.e if a response is submitted by the user .......    

	if(isset($_POST["reg_button"]))
	{
		// Validating the first name text field .....
		$fname=strip_tags($_POST['reg_fname']); // Getting rid of any html tags entered in the text field ( just a measure of security) ......
		$fname=str_replace(' ','',$fname); // Replacing any spaces (first name can't include any spaces)......
		$fname=ucfirst(strtolower($fname)); // Modifying the date before storing it in the database ........
		$_SESSION['reg_fname']=$fname;
		// Validating the last name text field .....
		
		$lname=strip_tags($_POST['reg_lname']); // Getting rid of any html tags entered in the text field ( just a measure of security) ......
		$lname=str_replace(' ','',$lname); // Replacing any spaces (first name can't include any spaces)......
		$lname=ucfirst(strtolower($lname)); // Modifying the date before storing it in the database ........
		$_SESSION['reg_lname']=$lname;
		// Validating the email address text field .....
		
		$email_1=strip_tags($_POST['reg_email']); // Getting rid of any html tags entered in the text field ( just a measure of security) ......
		$email_1=str_replace(' ','',$email_1); // Replacing any spaces (first name can't include any spaces)......
		$email_1=ucfirst(strtolower($email_1)); // Modifying the date before storing it in the database ........
        $_SESSION['reg_email']=$email_1;
		// Validating the confirm email address text field .....
		
		$email_2=strip_tags($_POST['reg_email_2']); // Getting rid of any html tags entered in the text field ( just a measure of security) ......
		$email_2=str_replace(' ','',$email_2); // Replacing any spaces (first name can't include any spaces)......
		$email_2=ucfirst(strtolower($email_2)); // Modifying the date before storing it in the database ........
		$_SESSION['reg_email_2']=$email_2;

		$dob=$_POST['r_dob'];
		$_SESSION['r_dob']=$dob;

		$gender=$_POST['sex'];
		$_SESSION['sex']=$gender;

		$pass_1=strip_tags($_POST['reg_pass']); // Getting rid of any html tags entered in the text field ( just a measure of security) ......
		$pass_2=strip_tags($_POST['reg_pass_2']); // Getting rid of any html tags entered in the text field ( just a measure of security) ......

		$reg_date=date("Y-m-d");

		if($email_1==$email_2) // Checking if the email and confirmatory email entered by user match or not ......
		{
			if(filter_var($email_1,FILTER_VALIDATE_EMAIL)) // Checking if the email is in valid format provided it matches with the confirmatory email....
			{
				$email_1=filter_var($email_1,FILTER_VALIDATE_EMAIL);

				// Checking if the email already exists i.e if there is any other user with same e-mail ....

				$em_exists=mysqli_query($con,"SELECT email FROM users WHERE email='$email_1'");
				$num_rows=mysqli_num_rows($em_exists);
				if($num_rows>0)
				{ 
					array_push($error_array,"E-mail already in use <br>");
				}
			}
			else
			{
				array_push($error_array,"Invalid E-mail format <br>");
			}
		}
		else
		{
			array_push($error_array,"E-mails don't match <br>");
		}
		if(strlen($fname)>25||strlen($fname)<2)
		{
			array_push($error_array,"First name must be between 2 and 25 characters <br>");
		}
		if(strlen($lname)>25||strlen($lname)<2)
		{
			array_push($error_array,"Last name must be between 2 and 25 characters <br>");
		}
		if($pass_1!=$pass_2)
		{
			array_push($error_array,"Your Passwords don't match <br>");
		}
		else
		{
			if(strlen($pass_1)>30||strlen($pass_1)<5)
			{
				array_push($error_array,"Your password must be between 5 and 30 characters only <br>");
			}
			else
			{
				// Check for valid password format if in case you want to fix a valid type of passwords to accepted only .........
			}
		}

		// Now doing preprocessing before sending the data to database only if error_array is empty ..........
		if(empty($error_array))
		{
			$pass_1=md5($pass_1) ;// Encrypting password before sending it to database .....

			// Generating username... if a username exists then add a number to it .... for ex:- lakshay_sharma if exists then when registering with same fname and lname will give new username lakshay_sharma_1 ......
			$username=strtolower($fname."_".$lname);
			$u_name_exists=mysqli_query($con,"SELECT username FROM users WHERE username='$username'");
			$i=0;
			while(mysqli_num_rows($u_name_exists)!=0)
			{
				$i++;
				$username=$username."_".$i;
				$u_name_exists=mysqli_query($con,"SELECT username FROM users WHERE username='$username'");
			}

			// Assigning default profile pic to the user initially .....
			if($gender=="Female")
			{
				$rand=rand(1,2);
				if($rand==1)
				{
					$profile_pic="assets/images/profile_pics/defaults/girl_1.png";
				}
				else if($rand==2)
				{
					$profile_pic="assets/images/profile_pics/defaults/girl_2.png";
				}
			}
			else
			{
				$rand=rand(1,2);
				if($rand==1)
				{
					$profile_pic="assets/images/profile_pics/defaults/boy_1.png";
				}
				else if($rand==2)
				{
					$profile_pic="assets/images/profile_pics/defaults/boy_2.png";
				}
			}

			// Inserting all values in database now .......
			$in_query=mysqli_query($con,"INSERT INTO users VALUES('','$fname','$lname','$username','$email_1','$pass_1','$reg_date','$profile_pic','$dob','$gender','0','0','no',',')");

			// Displaying the success message to user that his/her registeration is successful .....
			array_push($error_array,"Registeration Successful !! Go ahead and Login. <br>");

			// Clearing the session variables .........

			$_SESSION['reg_fname']="";
			$_SESSION['reg_lname']="";
			$_SESSION['reg_email']="";
			$_SESSION['reg_email_2']="";
			$_SESSION['r_dob']="";
			$_SESSION['sex']="";
		}
	}

?>