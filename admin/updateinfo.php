<?php
session_start();

$admin_id = $_SESSION['admin_id'];

if (isset ($_REQUEST['save']))
{
  $id = $_REQUEST['id'];
  require_once ('config.php');
  $db = mysql_connect($hostname, $hostacessname, $hostpassword);
  mysql_select_db($databasename, $db) or die(mysql_error());
//uploader section start here
  $uniqname = uniqid();
  $target = "./images/headerimage/" . $uniqname;
  $target = $target . basename($_FILES['headerimage']['name']);
//now apply if condition to check image is uploaded or not
  if (move_uploaded_file($_FILES['headerimage']['tmp_name'], $target))
  {
    $headerimage = $uniqname . basename($_FILES['headerimage']['name']);
  }
  else
  {
    $headerimage = $_REQUEST['image1'];
  }
  $target2 = "./images/dealimage/" . $uniqname;
  $target2 = $target2 . basename($_FILES['dealimage']['name']);
//this is for the checking image is updated or not
  if (move_uploaded_file($_FILES['dealimage']['tmp_name'], $target2))
  {
    $dealimage = $uniqname . basename($_FILES['dealimage']['name']);
  }
  else
  {
    $dealimage = $_REQUEST['image2'];
  }
  $target3 = "./images/fangatedimage/" . $uniqname;
  $target3 = $target3 . basename($_FILES['fangatedimage']['name']);
  if (move_uploaded_file($_FILES['fangatedimage']['tmp_name'], $target3))
  {
    $fangatedimage = $uniqname . basename($_FILES['fangatedimage']['name']);
  }
  else
  {
    $fangatedimage = $_REQUEST['image3'];
  }
  $target4 = "./images/wallimage/" . $uniqname;
  $target4 = $target4 . basename($_FILES['wallimage']['name']);
  if (move_uploaded_file($_FILES['wallimage']['tmp_name'], $target4))
  {
    $wallimage = $uniqname . basename($_FILES['wallimage']['name']);
  }
  else
  {
    $wallimage = $_REQUEST['image5'];
  }
  $target5 = "./images/backgroundimage/" . $uniqname;
  $target5 = $target5 . basename($_FILES['backgroundimage']['name']);
  if (move_uploaded_file($_FILES['backgroundimage']['tmp_name'], $target5))
  {
    $backgroundimage = $uniqname . basename($_FILES['backgroundimage']['name']);
  }
  else
  {
    $backgroundimage = $_REQUEST['image6'];
  }
  $target6 = "./images/buttonimage/" . $uniqname;
  $target6 = $target6 . basename($_FILES['buttonimage']['name']);
  if (move_uploaded_file($_FILES['buttonimage']['tmp_name'], $target6))
  {
    $buttonimage = $uniqname . basename($_FILES['buttonimage']['name']);
  }
  else
  {
    $buttonimage = $_REQUEST['image4'];
  }
//this is for defining the variables
  $appid = $_REQUEST['appid'];
  $appsecret = $_REQUEST['appsecret'];
  $textoverlay = stripslashes($_REQUEST['textoverlay']);
  $wallpermission = stripslashes($_REQUEST['wallpermission']);
  $dealtitle = $_REQUEST['dealtitle'];
  $terms = stripslashes($_REQUEST['terms']);
  $privacy = stripslashes($_REQUEST['privacy']);
  $paypalemail = $_REQUEST['paypalemail'];
  $date = $_REQUEST['date'];
  $time = time();
//array for the data to be inserted
  $fangated = $_REQUEST['fangated'];
  $ourprice = $_REQUEST['ourprice'];
  $realprice = $_REQUEST['realprice'];
  $wallname = $_REQUEST['wallname'];
  $wallmessage = $_REQUEST['wallmessage'];
  $aweberid = $_REQUEST['aweberid'];
  $mailchimplist = $_REQUEST['mailchimplist'];
  $mailchimplistapikey = $_REQUEST['mailchipapikey'];
  $dealbuttontext = $_REQUEST['dealbuttontext'];
  $layouttype = $_REQUEST['layouttype'];
  $paymenttype = $_REQUEST['paymenttype'];
  $paymentlink = $_REQUEST['paymentlink'];
  $style = $_REQUEST['style'];
  $dealdescription = stripslashes($_REQUEST['dealdescription']);
  $autorespondertype = $_REQUEST['autorespondertype'];
  $contentheadline = $_REQUEST['contentheadline'];
  $getresponseapi = $_REQUEST['getresponseapi'];
  $campaignname = $_REQUEST['campaignname'];
  $content = $_REQUEST['content'];
  $content = urlencode($content);
  $custom_message = $_REQUEST['custom_message'];
  $dialog_type = $_REQUEST['dialog_type'];
  $app_url = $_REQUEST['app_url'];
  $subheadline = $_REQUEST['subheadline'];
  $customlink = $_REQUEST['customlink'];
  $liketext = $_REQUEST['liketext'];
  $currency = $_REQUEST['currency'];
$language = $_REQUEST['language'];
$invite_friends = $_REQUEST['invite_friends'];
$terms_conditions = $_REQUEST['terms_conditions'];
$privacy_policy = $_REQUEST['privacy_policy'];
$price_text = $_REQUEST['price_text'];
$normal_price_text = $_REQUEST['normal_price_text'];
$discount_text = $_REQUEST['discount_text'];
$offer_price_text = $_REQUEST['offer_price_text'];
$days_text = $_REQUEST['days_text'];
$hours_text = $_REQUEST['hours_text'];
$minutes_text = $_REQUEST['minutes_text'];
$seconds_text = $_REQUEST['seconds_text'];
$buy_now_text = $_REQUEST['buy_now_text'];
$click_here_text = $_REQUEST['click_here_text'];
	$paypal_language = $_REQUEST['paypal_language'];

	$colorscheme=$_REQUEST['colorscheme'];
	$darkcollor=$_REQUEST['customdarkcolor'];
	$lightcollor=$_REQUEST['customlightcolor'];
	$textcollor=$_REQUEST['textcollor'];
	$buy_now_button_color=$_REQUEST['buy_now_button_color'];
	$buy_now_text_color=$_REQUEST['buy_now_text_color'];
	$pricetag_color=$_REQUEST['pricetag_color'];

	$tracking_code = $_REQUEST['tracking_code'];
	$tracking_code = urlencode($tracking_code);

	$show_dealtitle=$_REQUEST['show_dealtitle'];
	if($show_dealtitle == 'yes'){$show_dealtitle = 'yes';}else{$show_dealtitle = 'no';}


//array for the data to be inserted
  $paypalredirecturl = $_REQUEST['paypalredirecturl'];
  $updatequerry = "UPDATE deals SET campaignname='$campaignname',getresponseapi='$getresponseapi', paypalredirecturl='$paypalredirecturl', contentheadline='$contentheadline', autorespondertype='$autorespondertype', layouttype='" . mysql_real_escape_string($layouttype) . "', paymenttype='" . mysql_real_escape_string($paymenttype) . "',paymentlink='".mysql_real_escape_string($paymentlink) . "',style='" . mysql_real_escape_string($style) . "',dealdescription='" . mysql_real_escape_string($dealdescription) . "', dealbuttontext='" . mysql_real_escape_string($dealbuttontext) . "', mailchimpapikey='" . mysql_real_escape_string($mailchimplistapikey) . "',mailchimplist='" . mysql_real_escape_string($mailchimplist) . "',aweberid='$aweberid',wallmessage='" . mysql_real_escape_string($wallmessage) . "',wallname='" . mysql_real_escape_string($wallname) . "',realprice='$realprice',ourprice='$ourprice',buttonimage='$buttonimage',wallimage='$wallimage',backgroundimage='$backgroundimage',headerimage='$headerimage',fangatedimage='$fangatedimage',fangated='$fangated',appsecret='$appsecret',appid='$appid',textoverlay='" . mysql_real_escape_string($textoverlay) . "',wallpermission='$wallpermission',date='$date',dealtitle='$dealtitle',terms='" . mysql_real_escape_string($terms) . "', privacy='" . mysql_real_escape_string($privacy) . "', paypalemail='$paypalemail',dealimage='$dealimage', content='" .$content . "', custom_message='" . mysql_real_escape_string($custom_message) . "', dialog_type='" . mysql_real_escape_string($dialog_type) . "', app_url='" . $app_url . "', subheadline='" . $subheadline . "', customlink='" . $customlink . "', liketext='" . $liketext . "', language='" . $language . "', invite_friends='" . $invite_friends . "', terms_conditions='" . $terms_conditions . "', privacy_policy='" . $privacy_policy . "', price_text='" . $price_text . "', normal_price_text='" . $normal_price_text . "', discount_text='" . $discount_text . "', offer_price_text='" . $offer_price_text . "', days_text='" . $days_text . "', hours_text='" . $hours_text . "', minutes_text='" . $minutes_text . "', seconds_text='" . $seconds_text . "', buy_now_text='" . $buy_now_text . "', click_here_text='" . $click_here_text . "', paypal_language='" . $paypal_language . "', currency='" . $currency . "', colorscheme='". $colorscheme ."', darkcollor='". $darkcollor ."', lightcollor='". $lightcollor ."', textcollor='". $textcollor ."', buy_now_button_color='". $buy_now_button_color ."', buy_now_text_color='". $buy_now_text_color ."', pricetag_color='". $pricetag_color ."', tracking_code='". $tracking_code ."', show_dealtitle='". $show_dealtitle ."', admin_id='". $admin_id ."' where id='$id' ";

  mysql_query($updatequerry) or die(mysql_error());
  mysql_close();
  echo '<script>top.location.href="createdeal.php?id=' . $id . '&update"</script>';
}
?>