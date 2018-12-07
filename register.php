<!DOCTYPE html>
<html>
<head>
	<title>Webpage1</title>
</head>
<body>
	<h2>Registration Page</h2>
	<a href="index.php">Click here to go back</a><br/><br/>
	<form action="register.php" method="POST">
		Enter Username: <input type="text" name="username" required="required"/><br/>
		Enter password: <input type="password" name="password" required="required"/><br/>
		<input type="submit" name="Register">
	</form>
		
</body>
</html>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	echo "Username entered is: ". $username ."<br/>";
	echo "Password entered is: ". $password ."<br/>";

	$bool = true;
	$db = new PDO('mysql:host=localhost;dbname=first_db', 'root', '');
	// mysql_connect("localhost", "root", "") or die(mysql_error());
	// mysql_select_db("first_db") or die ("Cannot connect to database");
	foreach($db->query("Select * from users") as $row){
		echo $row;
		$table_users = $row['username'];
		if($username == $table_users)
		{
			$bool = false;
			Print '<script>alert("Username has been taken!");</script>';
			Print '<script>window.location.assign("register.php");</script>';
		}
	}

	if ($bool) {
	
		$db->query("INSERT INTO users (username,password) VALUES ('$username','$password')");
		Print '<script>alert("Successfully Registered!");</script>';
		Print '<script>window.location.assign("register.php");</script>';
		
	}
}

 ?>