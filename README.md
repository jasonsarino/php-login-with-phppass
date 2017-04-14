# PHP Login script with PHPPass Library

This tutorial demonstrates how to create a login page with MySQL Data base. Before enter into the code part, You would need special privileges to create or to delete a MySQL database. So assuming you have access to root user, you can create any database using mysql mysqladmin binary.

## Create Table 
```
CREATE TABLE `employee_login` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

## Config and Database Connection
```
define("HOST",               "localhost");
define("USERNAME",           "root");
define("PASSWORD",           "");
define("DBNAME",             "phptutorial");
define("PORT",               "3306");

$db = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);

if(mysqli_connect_errno()) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}
```

## PHPPass Library
We will use phppass library to secure our information and important information. Avoid from hacker and sql injection.

phpass (pronounced "pH pass") is a portable public domain password hashing framework for use in PHP applications. It is meant to work with PHP 3 and above, and it has actually been tested with at least PHP 3.0.18 through 5.4.x so far. (PHP 3 support is likely to be dropped in next revision.)

For more information and to download phppass click the link  
http://www.openwall.com/phpass/

## Include and Initialize PHP Pass
```
require_once 'phppass/PasswordHash.php';
$phppass = new PasswordHash(8, TRUE);
```

## PHPPass Usage
#### Hash and Insert to database
```
$password = $_POST['password'];
$hashPassword = $phppass->HashPassword($password);
```
### Hash and Check Password to Database
```
$getpwd = fetch to database
$password = $_POST['password'];
$result = $phppass->CheckPassword($password, $getpwd);
```

## Login Script
```
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
  ```
  
  ## Register Script
  ```
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
  ```
