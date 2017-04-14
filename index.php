<?php 
require_once 'config.php';
require_once 'phppass/PasswordHash.php';
$phppass = new PasswordHash(8, TRUE);

if (isset($_POST['btnLogin'])) {
	$username = $db->real_escape_string($_POST['username']);
	$password = $_POST['password'];

	$sql = "SELECT `password` FROM `employee_login` WHERE `username` = '" . $username . "'";
	$result = $db->query($sql);
	if ($result->num_rows == 1) {
		// Get password
		$row = $result->fetch_assoc();
		$getpwd = $row['password'];

		// Check and match password
		$result = $phppass->CheckPassword($password, $getpwd);
		if ( $result ) {
			session_start();
			$_SESSION['username'] = $username;
			header("Location: home.php");
		} else {
			$msg = "Invalid Login";
		}

	} else {
		$msg = "Username not found.";
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
	<h2>Login</h2>
	<?=(isset($msg)) ? $msg : ""?>
	<form method="post">
		<table cellspacing="6" cellpadding="6">
			<tr>
				<td>Username: </td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>Password: </td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td><input type="submit" value="Login" name="btnLogin"></td>
				<td><a href="register.php">register here</a></td>
			</tr>
		</table>
	</form>
</center>
</body>
</html>