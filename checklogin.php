<?php
	session_start();
	$username = $_POST['username'];
	$password = $_POST['password'];

	$db = new PDO('mysql:host=localhost;dbname=first_db', 'root', '');
	$result = $db->query("SELECT * from users WHERE username='$username'");
	$exists = $result->rowCount();
	//echo $exists;
	$table_users = "";
	$table_password = "";

	if($exists >0)
	{
		while ($row = $result->fetch(PDO::FETCH_ASSOC)){
			$table_users = $row['username'];
			$table_password = $row['password'];
		}
		if(($username == $table_users) && ($password == $table_password))
		{
			if ($password = $table_password)
			{
				$_SESSION['user'] = $username;
				header("location: home.php");
			}
		}
		else
		{
			Print '<script>alert("Incorrect Passowrd!");</script>';
			Print '<script>window.location.assign("login.php");</script>';
		}
	}
	else
	{
		Print '<script>alert("Incorrect username!");</script>';
		Print '<script>window.location.assign("login.php");</script>';
	}
 ?>