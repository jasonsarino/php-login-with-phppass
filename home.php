<?php 
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP LOGIN</title>
</head>
<body>
<center>
	<h2>Welcome <?=$_SESSION['username']?> | <a href="logout.php">Logout</a></h2>
</center>
</body>
</html>