<?php
session_start();

$admin_id = $_SESSION['admin_id'];

if (isset ($_REQUEST['save']))
  {
   require_once ('config.php');
   $db = mysql_connect($hostname, $hostacessname, $hostpassword);

mysql_select_db($databasename, $db) or die(mysql_error()) ;

//define the variables
    $layouttype=$_REQUEST['layouttype'];
    $paymenttype=$_REQUEST['paymenttype'];
    $paymentlink=$_REQUEST['paymentlink'];
    $dealbuttontext=$_REQUEST['dealbuttontext'];
    $appid = $_REQUEST['appid'];
    $appsecret = $_REQUEST['appsecret'];

    $wallpermission = stripslashes($_REQUEST['wallpermission']);
    $dealtitle = $_REQUEST['dealtitle'];
	$dealtitle = htmlentities($dealtitle, ENT_QUOTES,'UTF-8');
    $terms = stripslashes($_REQUEST['terms']);
    $privacy = stripslashes($_REQUEST['privacy']);
    $paypalemail = $_REQUEST['paypalemail'];
    $date = $_REQUEST['date'];
//uploader section start here
    $uniqname = uniqid();
    $target = "./images/headerimage/" . $uniqname;
    $target = $target . basename($_FILES['headerimage']['name']);
    move_uploaded_file($_FILES['headerimage']['tmp_name'], $target);
    $headerimage = $uniqname . basename($_FILES['headerimage']['name']);
    $target2 = "./images/dealimage/" . $uniqname;
    $target2 = $target2 . basename($_FILES['dealimage']['name']);
    move_uploaded_file($_FILES['dealimage']['tmp_name'], $target2);
    $dealimage = $uniqname . basename($_FILES['dealimage']['name']);
//new uploaders
    $target3 = "./images/fangatedimage/" . $uniqname;
    $target3 = $target3 . basename($_FILES['fangatedimage']['name']);
    move_uploaded_file($_FILES['fangatedimage']['tmp_name'], $target3);
    $fangatedimage = $uniqname . basename($_FILES['fangatedimage']['name']);
    $target4 = "./images/wallimage/" . $uniqname;
    $target4 = $target4 . basename($_FILES['wallimage']['name']);
    move_uploaded_file($_FILES['wallimage']['tmp_name'], $target4);
    $wallimage = $uniqname . basename($_FILES['wallimage']['name']);
    $target5 = "./images/backgroundimage/" . $uniqname;
    $target5 = $target5 . basename($_FILES['backgroundimage']['name']);
    move_uploaded_file($_FILES['backgroundimage']['tmp_name'], $target5);
    $backgroundimage = $uniqname . basename($_FILES['backgroundimage']['name']);
    $target6 = "./images/buttonimage/" . $uniqname;
    $target6 = $target6 . basename($_FILES['buttonimage']['name']);
    move_uploaded_file($_FILES['buttonimage']['tmp_name'], $target6);
    $buttonimage = $uniqname . basename($_FILES['buttonimage']['name']);
    $fangated = $_REQUEST['fangated'];
    $ourprice = $_REQUEST['ourprice'];
    $realprice = $_REQUEST['realprice'];
    $wallname = $_REQUEST['wallname'];
    $wallmessage = $_REQUEST['wallmessage'];
    $aweberid = $_REQUEST['aweberid'];
    $mailchimplist = $_REQUEST['mailchimplist'];
    $mailchimplistapikey = $_REQUEST['mailchipapikey'];
    $style=$_REQUEST['style'];
    $dealdescription=stripslashes($_REQUEST['dealdescription']);
    $autorespondertype=$_REQUEST['autorespondertype'];
    $contentheadline=$_REQUEST['contentheadline'];
    $paypalredirecturl=$_REQUEST['paypalredirecturl'];
    $getresponseapi=$_REQUEST['getresponseapi'];
    $campaignname=$_REQUEST['campaignname'];
	$content=$_REQUEST['content'];
	$content = urlencode($content);
	$custom_message=$_REQUEST['custom_message'];
	$dialog_type = $_REQUEST['dialog_type'];
	$app_url = $_REQUEST['app_url'];
	$subheadline = $_REQUEST['subheadline'];
	$customlink = $_REQUEST['customlink'];
	$liketext = $_REQUEST['liketext'];
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



$insertquerry="insert into deals (campaignname,getresponseapi,paypalredirecturl,contentheadline,autorespondertype,dealdescription,style,layouttype,paymenttype,paymentlink,mailchimpapikey,mailchimplist,aweberid,wallmessage,wallname,realprice,ourprice,buttonimage,wallimage,headerimage,fangatedimage,fangated,appsecret,appid,wallpermission,date,dealtitle,terms,privacy,paypalemail,dealimage,content,custom_message,dialog_type,app_url,subheadline,customlink,liketext,language,invite_friends,terms_conditions,privacy_policy,price_text,normal_price_text,discount_text,offer_price_text,days_text,hours_text,minutes_text,seconds_text,buy_now_text,click_here_text,paypal_language,colorscheme,darkcollor,lightcollor,textcollor,buy_now_button_color,buy_now_text_color,pricetag_color,tracking_code,show_dealtitle,admin_id)values('$campaignname','$getresponseapi','$paypalredirecturl','$contentheadline','$autorespondertype','".mysql_real_escape_string($dealdescription)."','".mysql_real_escape_string($style)."','".mysql_real_escape_string($layouttype)."','".mysql_real_escape_string($paymenttype)."','".mysql_real_escape_string($paymentlink)."','".mysql_real_escape_string($mailchimplistapikey)."','".mysql_real_escape_string($mailchimplist)."','".mysql_real_escape_string($aweberid)."','".mysql_real_escape_string($wallmessage)."','".mysql_real_escape_string($wallname)."','".mysql_real_escape_string($realprice)."','".mysql_real_escape_string($ourprice)."','".mysql_real_escape_string($buttonimage)."','".mysql_real_escape_string($wallimage)."','".mysql_real_escape_string($headerimage)."','".mysql_real_escape_string($fangatedimage)."','".mysql_real_escape_string($fangated)."','".mysql_real_escape_string($appsecret)."','".mysql_real_escape_string($appid)."','".mysql_real_escape_string($wallpermission)."','".mysql_real_escape_string($date)."','".mysql_real_escape_string($dealtitle)."','".mysql_real_escape_string($terms)."','".mysql_real_escape_string($privacy)."','".mysql_real_escape_string($paypalemail)."','".mysql_real_escape_string($dealimage)."','".$content."','".mysql_real_escape_string($custom_message)."','".mysql_real_escape_string($dialog_type)."','".$app_url."','".$subheadline."','".$customlink."','".$liketext."','".$language."','".$invite_friends."','".$terms_conditions."','".$privacy_policy."','".$price_text."','".$normal_price_text."','".$discount_text."','".$offer_price_text."','".$days_text."','".$hours_text."','".$minutes_text."','".$seconds_text."','".$buy_now_text."','".$click_here_text."','".$paypal_language."','".$colorscheme."','".$darkcollor."','".$lightcollor."','".$textcollor."','".$buy_now_button_color."','".$buy_now_text_color."','".$pricetag_color."','".$tracking_code."','".$show_dealtitle."', '".$admin_id."')";
/*
echo '<br>';
echo '<br>';
echo $insertquerry;
echo '<br>';
echo '<br>';
*/
mysql_query($insertquerry)or die(mysql_error());
if(!mysql_error()){
 echo '<script>top.location.href="viewdeal.php"</script>';}
 }

 ?>
