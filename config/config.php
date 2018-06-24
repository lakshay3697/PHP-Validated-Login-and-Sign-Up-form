<?php 
	
	ob_start(); // Turns on the output buffering i.e rather than outputting anything to browser store the results in an internal buffer .......
	session_start();
	$timezone=date_default_timezone_set("Asia/Kolkata");
	// Establishing connection with the database .........

	$con=mysqli_connect("localhost","root","","social");
	if(mysqli_connect_errno())
	{
		echo "Failed to connect ".mysqli_connect_errno();
	}

 ?>