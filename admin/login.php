<?php
ob_start();
session_start();
include("config.php");


$user=$_REQUEST['user'];
$pass= $_REQUEST['pass'];
$db = mysql_connect($hostname, $hostacessname, $hostpassword);

mysql_select_db($databasename, $db) or die(mysql_error()) ;


mysql_real_escape_string($user);
mysql_real_escape_string($pass);

$enc_pass = md5($pass);

$query = "select * from admin where username='$user' and password='$enc_pass'";



$result = mysql_query($query) or die(mysql_error());

if (mysql_num_rows($result) != 1) {
$error = "Bad Login";
function do_alert($msg)
    {
        echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
    }
 do_alert("Incorrect username or password");
  echo '<script>top.location.href="index.php"</script>';
} else {

	  $admin_id = mysql_result($result,0,"ID");

      $_SESSION['user'] = $_REQUEST['user'];
	  $_SESSION['admin_id'] = $admin_id;



echo '<script>top.location.href="viewdeal.php"</script>';

}

?>
