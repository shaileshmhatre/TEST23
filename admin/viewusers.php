<?php
error_reporting(0);session_start(); ob_start();
$admin_id = $_SESSION['admin_id'];
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

include("config.php");
//connect the database
$db = mysql_connect($hostname, $hostacessname, $hostpassword);
mysql_select_db($databasename, $db) or die(mysql_error());
//this is for the pagination class
require "class.pagination1.php";

/*** Variables ***/
//default page
$page = 1;

//rows per page
$per_page = 5;

$full_sql = 'select * from dealviewer where admin_id='.$admin_id;
//to get the total no of pages

$totalpages=mysql_num_rows(mysql_query($full_sql));
//now apply condition if the total rows are greater than of the  20 than show pagination otherwise hide it
if($totalpages<5){
  $pagingstyle="display:none;";
}else{
  $pagingstyle="";
}
//check page number
if(isset($_GET['page']))
        $page = $_GET['page'];

		

//create object, pass the values
$pageObj = new pagination($full_sql, $per_page, $page);

//sql after getting split in to pages
$sql = $pageObj->get_query();
$rsd = mysql_query($sql) or die(mysql_error());

//starting serial number
$sl_start = $pageObj->offset;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="bt/bootstrap.css" />
<script src="http://code.jquery.com/jquery-latest.min.js "></script>
<script src="js/bootstrap-dropdown.js"></script>


</head>

<body>
<?php include("top.php");?>
  <div class="page-header" style="margin-top: 50px;">
    <h1>Dashboard</h1>
  </div>
  <table class="bordered-table zebra-striped" >
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysql_fetch_array($rsd)){ ?>
      <tr>
        <td><?php echo $row['name'];  ?></td>
        <td><?php echo $row['email'];  ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="pagination" style="<?php echo $pagingstyle; ?>"> <?php echo $pageObj->get_links(); ?></div>
</div>

</body>
</html>
