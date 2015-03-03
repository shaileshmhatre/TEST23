<?php
session_start();
$admin_id = $_SESSION['admin_id'];

if($admin_id <> '1'){
echo 'Nothing to do here.';
exit;
}

require_once('config.php');
$db = mysql_connect($hostname, $hostacessname, $hostpassword);
mysql_select_db($databasename, $db) or die(mysql_error());

$role=$_POST['role'];
$id=$_POST['id'];
$username=$_POST['username'];
$email=$_POST['email'];
$change_password=$_POST['change_password'];
$password=$_POST['password'];
$password = md5($password);


if($role == 'edit'){
if($change_password == 'yes'){
mysql_query("UPDATE `admin` SET `username`='$username',`password`='$password',`email`='$email' WHERE ID = '$id'")or die(mysql_error());
}
else
{
mysql_query("UPDATE `admin` SET `username`='$username',`email`='$email' WHERE ID = '$id'")or die(mysql_error());
}
} // end if role is edit

if($role =='adminadd'){
	$query =mysql_query("SELECT * FROM admin WHERE username='$username'");
if (mysql_num_rows($query) > 0) {
	echo "The username is already taken.";
	exit;
}

if($password == ''){
	echo "Password is required!";
	exit;
}

if($username == ''){
	echo "Username is required!";
	exit;
}

if($email == ''){
	echo "Valid email is required!";
	exit;
}


$pass = md5($password);

	mysql_query("INSERT INTO `admin` (`ID`, `username`, `password`, `email`, `token`, `version`) VALUES (NULL, '".$username."', '".$pass."', '".$email."', '', '');");
}

echo '<script>top.location.href="admin.php"</script>';
?>