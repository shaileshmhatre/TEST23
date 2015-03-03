<?php
ob_start();
session_start();
if (!isset ($_SESSION['user']))
{
  function do_alert($msg)
  {
    echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
  }
  do_alert("Hello stranger!! Welcome to our website.Login to get started");
  echo '<script>top.location.href="index.php"</script>';
  exit ();
}
?>
<?php

//this is for the defining the parameters
require_once ('config.php');
//this class is database class
$db = mysql_connect($hostname, $hostacessname, $hostpassword);
mysql_select_db($databasename, $db) or die(mysql_error());
$appid=$_REQUEST['id'];
//this is for making the connection to the database
$selectquery = 'select * from deals where appid="' . $appid . '"';
$selectexe = mysql_query($selectquery) or die(mysql_error());
//get the content of the deal
//get the content of the deal
while ($row = mysql_fetch_array($selectexe))
{
  $id=$row['id'];
}
$pageURL = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

$pizza  = $pageURL;
$pieces = explode("/admin/", $pizza);
$pageurl = 'http://'.$pieces[0];
$pageurls = 'https://'.$pieces[0];

 ?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
    <script src="http://autobahn.tablesorter.com/jquery.tablesorter.min.js"></script>
    <script src="assets/js/google-code-prettify/prettify.js"></script>

    <script src="js/bootstrap-dropdown.js"></script>
     <script src="js/bootstrap-twipsy.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>App Setting</title>

<meta charset=utf-8 />
<style>
  article, aside, figure, footer, header, hgroup,
  menu, nav, section { display: block; }
</style>


<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href="css/styles.css"  rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="bt/bootstrap.css" />
<script type="text/javascript">
function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
</script>

</head>

<body >
<div class="container canvas">

<?php include("top.php");?>

 <div class="page-header" style="margin-top: 50px;">
    <h1>Add to Facebook</h1>
 </div>
<div class="row">
    <div class="span12">
      Copy these URL's to your Facebook app settings<br><br>
    </div>
  </div>
  <div class="row">
    <div class="span2">
      Canvas Url:
    </div>
    <div class="span4">
      <input type="text" readonly class="xlarge" onClick="SelectAll('curl');" id="curl" value="<?php echo $pageurl."/?id=".$id?>" /><br><br>
    </div>
  </div>
  <div class="row">
   <div class="span2">
    Secure Convas Url:
  </div>
  <div class="span4">
    <input type="text" readonly onClick="SelectAll('surl');" id="surl" class="xlarge" value="<?php echo $pageurls."/?id=".$id?>" /><br><br>
  </div>
</div>

  <div class="row">
    <div class="span2">
      Page Tab URL:
    </div>
    <div class="span4">
      <input type="text" readonly class="xlarge" onClick="SelectAll('curl2');" id="curl2" value="<?php echo $pageurl."/index.php?id=".$id?>" /><br><br>
    </div>
  </div>
  <div class="row">
   <div class="span2">
    Secure Page Tab URL:
  </div>
  <div class="span4">
    <input type="text" readonly onClick="SelectAll('surl2');" id="surl2" class="xlarge" value="<?php echo $pageurls."/index.php?id=".$id?>" /><br><br>
  </div>
</div>
<div class="row">
  <div class="span12">
  After you have added the URL's above, you must now add the app to your page by clicking the button below<br><br>
  <a href='https://www.facebook.com/add.php?api_key=<?php echo $appid; ?>&pages=1' target='_blank' class="btn primary">Add  to Fb</a>
  </div>
</div>
</body>
</html>
