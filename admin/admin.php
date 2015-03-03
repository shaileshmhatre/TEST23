<?php
error_reporting(0);session_start(); ob_start();
if (!isset ($_SESSION['user']))
{
  function do_alert($msg)
  {
    echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
  }
  do_alert("Login to get started");
  echo '<script>top.location.href="index.php"</script>';
  exit ();
}

$admin_id = $_SESSION['admin_id'];
if($admin_id <> '1'){
echo 'Nothing to do here.';
exit;
}

include("config.php");
//connect the database
$db = mysql_connect($hostname, $hostacessname, $hostpassword);
mysql_select_db($databasename, $db) or die(mysql_error());



$full_sql = 'select * from admin';
$rsd = mysql_query($full_sql) or die(mysql_error());

$pageURL = $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
$pageURL = str_replace("admin.php", "", $pageURL);
$pageURL = $pageURL.'register.php?st='.$regtoken;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="bt/bootstrap.css" />
<script src="http://code.jquery.com/jquery-latest.min.js "></script>
<script src="js/bootstrap-dropdown.js"></script>
<script type="text/javascript">
function ConfirmChoice(id){
  answer = confirm("Are you sure you want to delete this user?")
  if (answer !=0){
    location = "deleteuser.php?id="+id;
  }
}
</script>
</head>

<body>
<?php include("top.php");?>
  <div class="page-header" style="margin-top: 50px;">
  <a href="adduser.php" class="btn primary" style="float:right;">Add New User</a>
    <h1>Manage Users</h1>

  </div>
  <div class="clearfix">
              <label for="xlInput" style="width:160px;">Customer registration URL:&nbsp;&nbsp;</label>
              <div class="input">
                <input name="username" id="username" class="xlarge" type="text" value="http://<?php echo $pageURL?>" style="width:590px;" />
              </div>
            </div>
			<br>


  <table class="bordered-table zebra-striped" >
    <thead>
      <tr>
        <th>Username</th>
		<th>Email</th>
        <th>Manage User</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysql_fetch_array($rsd)){ ?>
      <tr>
        <td><?php echo $row['username'];  ?></td>
		<td><?php echo $row['email'];  ?></td>
        <td style="width: 280px;"><a href="loginuser.php?id=<?php echo $row['ID']; ?>&user=<?php echo $row['username']; ?>" class="btn primary" >Login as this user</a>&nbsp; <a href="edituser.php?id=<?php echo $row['ID']; ?>" class="btn" >Edit</a><?php if($row['ID'] <> '1') { ?>&nbsp; <a href="javascript:void(0);" onclick="ConfirmChoice('<?php echo $row['ID']; ?>'); return false;" class="btn danger" >Delete</a><?php } ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

</div>
</body>
</html>
