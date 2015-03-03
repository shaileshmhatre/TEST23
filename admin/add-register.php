<?php
ob_start();
session_start();

$username=$_POST['username'];
$pass1= $_POST['pass1'];
$pass2= $_POST['pass2'];
$email= $_POST['email'];

require_once ('config.php');
$db = mysql_connect($hostname, $hostacessname, $hostpassword);
mysql_select_db($databasename, $db) or die(mysql_error());


	$query =mysql_query("SELECT * FROM admin WHERE username='$username'");
if (mysql_num_rows($query) > 0) {
	$message = urlencode("The username is already taken.");
	echo '<script>top.location.href="register.php?error='.$message.'"</script>';
	exit;
}

if($pass1 <> $pass2){
	$message = urlencode("The two passwords do not match!");
	echo '<script>top.location.href="register.php?error='.$message.'"</script>';
	exit;
}

if($username == ''){
	$message = urlencode("Username is required!");
	echo '<script>top.location.href="register.php?error='.$message.'"</script>';
	exit;
}

if($email == ''){
	$message = urlencode("Valid email is required!");
	echo '<script>top.location.href="register.php?error='.$message.'"</script>';
	exit;
}


$pass = md5($pass1);

	mysql_query("INSERT INTO `admin` (`ID`, `username`, `password`, `email`, `token`, `version`) VALUES (NULL, '".$username."', '".$pass."', '".$email."', '', '');");



echo '<script>top.location.href="index.php"</script>';
exit;
?>
