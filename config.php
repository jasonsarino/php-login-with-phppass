<?php 
define("HOST",               "localhost");
define("USERNAME",           "u395220709_nice");
define("PASSWORD",           "KDsjmw6iy1Ho");
define("DBNAME",             "u395220709_php1");
define("PORT",               "3306");

$db = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);

if(mysqli_connect_errno()) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

?>