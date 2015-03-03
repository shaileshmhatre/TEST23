<?php
session_start();
$admin_id = $_SESSION['admin_id'];

if($admin_id <> '1'){
echo 'Nothing to do here.';
exit;
}

$id=$_REQUEST['id'];
$username=$_REQUEST['user'];

$_SESSION['user'] = $username;
$_SESSION['admin_id'] = $id;
	  
echo '<script>top.location.href="viewdeal.php"</script>';
?>