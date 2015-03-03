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
include("config.php");
//connect the database
$db = mysql_connect($hostname, $hostacessname, $hostpassword);
mysql_select_db($databasename, $db) or die(mysql_error());
//this is for the pagination class
require "class.pagination.php";

/*** Variables ***/
//default page
$page = 1;

//rows per page
$per_page = 10;

$full_sql = 'select * from deals WHERE admin_id = '.$admin_id;
//to get the total no of pages

$totalpages=mysql_num_rows(mysql_query($full_sql));
//now apply condition if the total rows are greater than of the  20 than show pagination otherwise hide it
if($totalpages<10){
  $pagingstyle="display:none;";
}else{
  $pagingstyle="";
}
//check page number
if(isset($_REQUEST['page']))
        $page = $_REQUEST['page'];

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
<script type="text/javascript">
function ConfirmChoice(id){
  answer = confirm("Are you sure you want to delete the deal?")
  if (answer !=0){
    location = "deletedeal.php?id="+id;
  }
}
</script>
<script type="text/javascript">
function handleSelect(elm){
  window.location = elm.value+".php";
}
</script>

<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','scrollbars=yes,toolbar=no,menubar=no,status=no,height=600,width=828');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>
</head>

<body>
<?php include("top.php");?>
  <div class="page-header" style="margin-top: 50px;">
    <h1>Dashboard</h1>
  </div>
  
  <table class="bordered-table zebra-striped" >
    <thead>
      <tr>
        <th>Deal Title</th>
        <th>Payment email/link</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysql_fetch_array($rsd)){ ?>
      <tr>
        <td><?php echo $row['dealtitle'];  ?></td>

		  <td style="width: 150px;"><?php if($row['paymentlink'] <> ''){echo $row['paymentlink']; }else{echo $row['paypalemail'];} ?></td>
        <td style="width: 280px;"><a href="../index.php?id=<?php echo $row['id']; ?>&preview=true" class="btn success" onclick="return popitup('../index.php?id=<?php echo $row['id']; ?>&preview=true')">Preview</a>&nbsp; <a href="addtopage.php?id=<?php echo $row['appid']; ?>" class="btn primary" >Add to Fb</a>&nbsp; <a href="createdeal.php?id=<?php echo $row['id']; ?>" class="btn" >Edit</a>&nbsp; <a href="javascript:void(0);" onclick="ConfirmChoice('<?php echo $row['id']; ?>'); return false;" class="btn danger" >Delete</a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="pagination" style="<?php echo $pagingstyle; ?>"> <?php echo $pageObj->get_links(); ?></div>
</div>
</body>
</html>
