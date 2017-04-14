<?php 
require_once 'config.php';
require_once 'phppass/PasswordHash.php';
$phppass = new PasswordHash(8, TRUE);

if (isset($_POST['btnRegister'])) {

	$employee_name = $db->real_escape_string($_POST['employee_name']);
	$username = $db->real_escape_string($_POST['username']);
	$password = $_POST['password'];

	$hashPassword = $phppass->HashPassword($password);

	$sql = "INSERT INTO `employee_login`(`employee_name`,`username`,`password`) 
	VALUES('". $employee_name  . "','". $username  . "','". $hashPassword  . "')";
	$result = $db->query($sql);

	if ($result === TRUE) {
		$msg = "You have been successfully registered.";
	} else {
		$msg = "Error: " . $sql . "<br>" . $db->error;
	}


}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP LOGIN</title>
</head>
<body>
<center>
	<h2>Register</h2>
	<?=(isset($msg)) ? $msg : ""?>
	<form method="post">
		<table cellspacing="6" cellpadding="6">
			<tr>
				<td>Your Name: </td>
				<td><input type="text" name="employee_name"></td>
			</tr>
			<tr>
				<td>Username: </td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>Password: </td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td><input type="submit" value="Login" name="btnRegister"></td>
				<td><a href="index.php">back to login</a></td>
			</tr>
		</table>
	</form>
</center>
</body>
</html>