<?php

/////This function is used to connect to the database
function ConnectDataBase() {

global $dbhost, $dbuser, $dbpass, $dbname;
  mysql_connect($dbhost, $dbuser, $dbpass) or die("cannot connect");
  mysql_select_db($dbname) or die("cannot select DB");
}

//this function is used to save the userinfo

function SaveUserInfo($user,$email,$name,$gender,$location,$appid)
{
  $isnewuser=0;
$query = "SELECT 	fid FROM appusers WHERE 	fid='" . $user . "' and 	appid='".$appid."'";
//echo $query;
//This check the whether user exist or not
  $results = mysql_query($query) or die("Error: " . mysql_error());
  if (mysql_num_rows($results) < 1) {

//This create a new record
   $query = "INSERT INTO appusers(fid, email,name,gender,currentlocattion,appid)
                VALUES('" . $user . "', '" . $email . "','" . $name ."','".$gender."','".$location."',".$appid.")";
             //echo  $query;
    $result = mysql_query($query);
    mysql_free_result($results);
    $isnewuser=1;
  }
  return  $isnewuser;
}
///This is used to get the app info
function GetInfo($appid)
{
   $userarr='';
   $userarr= mysql_query("SELECT * FROM application WHERE facebookid=".$appid)or die('mysql_error()') ;
   return $userarr;
}
/////This function is used to disconnect to the database
function DisConnectDataBase() {

mysql_close();
}
  function PostToAweber($name, $email, $aweberlistid) {
   $post_data['listname'] = $aweberlistid;
   $post_data['redirect'] = 'http://' . $_SERVER['HTTP_HOST'];
   $post_data['name'] = $name;
   $post_data['email'] = $email;
   $post_data['meta_adtracking'] = 'custom form';
   $post_data['meta_message'] = '1';
   $post_data['meta_required'] = 'name,email';
   $post_data['meta_forward_vars'] = '1';
   foreach ($post_data as $key => $value) {
     $post_items[] = $key . '=' . $value;
   }
   $post_string = implode('&', $post_items);
   $curl_connection = curl_init('www.aweber.com/scripts/addlead.pl');
   curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
   curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
   curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
   curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);
   $result = curl_exec($curl_connection);
   //print_r($result);
   curl_close($curl_connection);
 }


 ///This function is used to save the data to mailchimp

 function PostToMailChimp($name, $email, $mailchimplistid,$mailchimpkey)
 {
     // Load MailChimp Sync Libraries
    require_once 'mc/Galahad/MailChimp/Synchronizer/Array.php';
    require_once 'mc/MailChimp/MCAPI.class.php';

      $MAILCHIMP_APIKEY=$mailchimpkey;
      $MAILCHIMP_LISTID=$mailchimplistid;
     // echo   $email;
      // Add the user to MailChimp list if integration has been set up.
         $arrname=         explode(" ",$name);
       $first_name= $arrname[0];
       $last_name=$arrname[1];

    $users = array(
	array('EMAIL' => $email, 'FNAME' => $first_name, 'LNAME' => $last_name),
    );

try {
$Synchronizer = new Galahad_MailChimp_Synchronizer_Array($MAILCHIMP_APIKEY, $users);
$Synchronizer->sync($MAILCHIMP_LISTID);

   } catch (Galahad_MailChimp_Synchronizer_Exception $e) {
    echo "\nError syncing: ", $e->getMessage();
}

 }
  ///This is used to add the getresponse

   function PostToGetResponse($api_key,$name,$email,$campaignname)
   {

            require_once 'jsonRPCClient.php';

# your API key
# available at http://www.getresponse.com/my_api_key.html
//$api_key = 'ENTER_YOUR_API_KEY_HERE';

# API 2.x URL
$api_url = 'http://api2.getresponse.com';

# initialize JSON-RPC client
$client = new jsonRPCClient($api_url);

$result = NULL;

# get CAMPAIGN_ID of  campaign
try {
    $result = $client->get_campaigns(
        $api_key,
        array (
            # find by name literally
            'name' => array ( 'EQUALS' => $campaignname )
        )
    );
}
catch (Exception $e) {
    # check for communication and response errors
    # implement handling if needed
    die($e->getMessage());
}

# uncomment this line to preview data structure


# since there can be only one campaign of this name
# first key is the CAMPAIGN_ID you need
$campaigns = array_keys($result);
$CAMPAIGN_ID = array_pop($campaigns);

//echo 'CAMPAIGN_ID'. $CAMPAIGN_ID;
# add contact to 'sample_marketing' campaign
try {
    $result = $client->add_contact(
        $api_key,
        array (
            'campaign'  => $CAMPAIGN_ID,
            'name'      => $name,
            'email'     => $email,
            'cycle_day' => '0'

        )
    );
}
catch (Exception $e) {
    # check for communication and response errors
    # implement handling if needed
    die($e->getMessage());
}

# uncomment this line to preview data structure
# print_r($result);

print("Contact added\n");
   }
?>

