<?php
ob_start();
session_start();
error_reporting(0);
include("config.php");

function accesstoken($length=8,$use_upper=1,$use_lower=1,$use_number=1,$use_custom=""){
	$upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$lower = "abcdefghijklmnopqrstuvwxyz";
	$number = "0123456789";
	if($use_upper){
		$seed_length += 26;
		$seed .= $upper;
	}
	if($use_lower){
		$seed_length += 26;
		$seed .= $lower;
	}
	if($use_number){
		$seed_length += 10;
		$seed .= $number;
	}
	if($use_custom){
		$seed_length +=strlen($use_custom);
		$seed .= $use_custom;
	}
	for($x=1;$x<=$length;$x++){
		$password .= $seed{rand(0,$seed_length-1)};
	}
	return($password);
}


$db = mysql_connect($hostname, $hostacessname, $hostpassword);
mysql_select_db($databasename, $db) or die(mysql_error()) ;


	if($_GET['token']){
		$token=$_GET['token'];
		mysql_real_escape_string($token);
		$newpass= 'false';
	}

	if($_GET['stoken']){
		$stoken=$_GET['stoken'];
		mysql_real_escape_string($stoken);
		$newpass= 'true';
	}

$email=$_POST['email'];
$reset= $_POST['reset'];

if ($reset == 'true'){

mysql_real_escape_string($email);
mysql_real_escape_string($reset);

$result=mysql_query("SELECT * FROM admin WHERE email = '$email'");
$dbemail=mysql_result($result,$a,"email");
$username=mysql_result($result,$a,"username");
$num=mysql_numrows($result);

if($num <= 0){
$message = urlencode('We do not know this email!');
echo '<script>top.location.href="index.php?error='.$message.'"</script>';
exit;
}
else
{
$accesstoken = accesstoken(20,1,0);

$pageURL = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

$reseturl = 'http://'.$pageURL.'?token='.$accesstoken;


mysql_query("UPDATE `admin` SET `token`='$accesstoken' WHERE email = '$email'");

$to      = $email;
$subject = $site_name.' Password Reset';
$message = $site_name.' Password Reset

To reset your '.$site_name.' admin password please click on the link bellow or if isn\'t clickable than please copy the link bellow in your browser and hit enter. 

Your current username is: '.$username.'
Your password reset link is:

'.$reseturl.'

Please do not reply to this email. Thank you!
';
mail($to, $subject, $message);
$message = urlencode('Please click on the confirmation link in the email that we just sent to '.$email.'. Thank you!');
echo '<script>top.location.href="index.php?error='.$message.'"</script>';
exit;
}
} // end of reset true

if($newpass == 'false'){
$result=mysql_query("SELECT * FROM admin WHERE token = '$token'");
$num=mysql_numrows($result);

if($num <= 0){
echo "Incorrect security token!";
exit;
}
else
{
header("location: index.php?token=".$token);
exit;
}
} //end if newpass false

if($newpass == 'true'){
$result=mysql_query("SELECT * FROM admin WHERE token = '$stoken'");
$num=mysql_numrows($result);

if($num <= 0){
echo "Incorrect security token!";
exit;
}
else
{
$pass1= $_POST['pass1'];
$pass2= $_POST['pass2'];
echo $pass1.'<br>';
echo $pass2.'<br>';
mysql_real_escape_string($pass1);
mysql_real_escape_string($pass2);

echo $pass1.'<br>';
echo $pass2.'<br>';
if($pass1 <> $pass2){
echo "The two passwords are not the same. Please go back and correct them!";
exit;
}

$password = md5($pass1);

mysql_query("UPDATE `admin` SET `password`='$password' WHERE token = '$stoken'");
header("location: index.php");
exit;
}
} //end if newpass true
?>
