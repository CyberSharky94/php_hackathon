<?php
	date_default_timezone_set('Asia/Kuala_Lumpur');

	$host = "localhost";
	$username = "root";
	$pass = "";
	$dbname = "explytics";


	$conn = mysqli_connect($host, $username, $pass, $dbname);

	// Check connection
	if (mysqli_connect_errno())
  	{			
	  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		echo "Successfully connected to the Database. =)";
	}

?>