<?php
session_start();
$admin_id = $_SESSION['admin_id'];
 if(isset($_REQUEST['id'])){
   require_once ('config.php');
$db = mysql_connect($hostname, $hostacessname, $hostpassword);
mysql_select_db($databasename, $db) or die(mysql_error());
$msg='';
$id=$_REQUEST['id'];
mysql_query("delete from deals where id='$id' AND admin_id='$admin_id'")or die(mysql_error());
 echo '<script>top.location.href="viewdeal.php"</script>';
     }

?>