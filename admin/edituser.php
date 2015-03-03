<?php
ob_start();
session_start();

if (!isset ($_SESSION['user']))
{
  function do_alert($msg)
  {
    echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
  }
  do_alert("Please log in to get started.");
  echo '<script>top.location.href="index.php"</script>';
  exit ();
}

$admin_id = $_SESSION['admin_id'];

if($admin_id <> '1'){
echo 'Nothing to do here.';
exit;
}

include('config.php');
$db = mysql_connect($hostname, $hostacessname, $hostpassword);
mysql_select_db($databasename, $db) or die(mysql_error());

$id = $_REQUEST['id'];
$selectquery = 'select * from admin where id="' . $id . '"';
$selectexe = mysql_query($selectquery) or die(mysql_error());
while ($row = mysql_fetch_array($selectexe))
{
	$username = $row['username'];
	$email = $row['email'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="bt/bootstrap.css" />
<script src="http://code.jquery.com/jquery-latest.min.js "></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.8.23/themes/smoothness/jquery-ui.css" />
<script src="js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<link href="css/colorpicker.css" rel="stylesheet">
<title>Edit User</title>

</head>

<body style="overflow: visible;">
<?php include("top.php");?>
<div class="page-header" style="margin-top: 50px;">
  <h1>Edit User</h1>
</div>
<h2><?php echo $msg;?></h2>
<div class="row">
  <div class="span12">
    <form action="insertuser.php" method="post">
      <div class="actions">
        <fieldset>
			<div class="clearfix">
              <label for="xlInput">Username</label>
              <div class="input">
                <input name="username" id="username" class="xlarge" type="text" value="<?php echo $username;?>" />
              </div>
            </div>
			<div class="clearfix">
              <label for="xlInput">Email Address</label>
              <div class="input">
                <input name="email" id="email" class="xlarge" type="text" value="<?php echo $email;?>" />
              </div>
            </div>
			<div class="clearfix">
            <label for="xlInput">Change Password</label>
            <div class="input">
			  <input type="checkbox" name="change_password" id="change_password" value="yes">
            </div>
          </div>
		  <div class="clearfix">
              <label for="xlInput">New Password</label>
              <div class="input">
                <input name="password" id="password" class="xlarge" type="text" value="" />
              </div>
          </div>
		</fieldset>
        
        <!-- input hidden for getting the preivious images naame-->
        <input type="hidden" value="<?php echo $id;?>"  name='id' id='id'/>
		<input type="hidden" value="edit"  name='role' id='role'/>
        <input type="submit" name="save" class="btn primary" value="Save changes">
      </div>
    </form>
  </div>
</div>
</div>

</body>
</html>
