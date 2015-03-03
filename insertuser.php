<?php
require_once ('./admin/config.php');
require_once ('commonfunctions.php');
require_once ('jsonRPCClient.php');
if (isset ($_REQUEST['email']))
{
  $email = $_REQUEST['email'];
  $name = $_REQUEST['name'];
  $aweberid = $_REQUEST['aweberid'];
  $mailchimplist = $_REQUEST['mailchimplist'];
  $mailchimpapikey = $_REQUEST['mailchimpapikey'];
  $autorespondertype = $_REQUEST['autorespondertype'];
  $getresponseapi = $_REQUEST['getresponseapi'];
  $campaignname = $_REQUEST['campaignname'];
  $admin_id = $_REQUEST['admin_id'];
  $dealid = $_REQUEST['dealid'];
  $db = mysql_connect($hostname, $hostacessname, $hostpassword);
  mysql_select_db($databasename, $db) or die(mysql_error());
  $selectquery = 'SELECT * FROM dealviewer WHERE email="' . $email . '" and viewdealid="' . $dealid . '"';
  $selectexe = mysql_query($selectquery) or die(mysql_error());
  $countnum = mysql_num_rows($selectexe);
  if ($countnum == '0')
  {
    mysql_query('INSERT INTO dealviewer (name,email,viewdealid,admin_id) VALUES("' . mysql_real_escape_string($name) . '","' . mysql_real_escape_string($email) . '","' . mysql_real_escape_string($dealid) . '","' . mysql_real_escape_string($admin_id) . '")') or die(mysql_error());
    if (!mysql_error())
    {
    }
    if ($autorespondertype == "Aweber")
    {
      PostToAweber($name, $email, $aweberid);
    }
    if ($autorespondertype == "Mailchimp")
    {
      PostToMailChimp($name, $email, $mailchimplist, $mailchimpapikey);
    }
    if ($autorespondertype == "getresponse")
    {
      PostToGetResponse($getresponseapi, $name, $email, $campaignname);
    }
    mysql_close();
  }
}
?>