<?php
//connect to the datbase
require_once ('./admin/config.php');
$id = $_REQUEST['id'];
error_reporting(0);
$db = mysql_connect($hostname, $hostacessname, $hostpassword);
mysql_select_db($databasename, $db) or die(mysql_error());
echo $selectquery = 'select * from deals where id="'.$id.'"';
$selectexe = mysql_query($selectquery) or die(mysql_error());
//get the content of the deal
while ($row = mysql_fetch_array($selectexe))
{
  $autorespondertype = $row['autorespondertype'];
  $date = $row['date'];
  $dealtitle = $row['dealtitle'];
  $terms = $row['terms'];
  $privacy = $row['privacy'];
  $paypalemail = $row['paypalemail'];
  $wallimage = $row['wallimage'];
  $wallname = $row['wallname'];
  $wallmessage = $row['wallmessage'];
  $wallpermission = $row['wallpermission'];
  $textoverlay = $row['textoverlay'];
  $fangatedimage = $row['fangatedimage'];
  $dealimage = $row['dealimage'];
  $dealbuttontext = $row['dealbuttontext'];
  $realprice = $row['realprice'];
  $ourprice = $row['ourprice'];
  $buttonimage = $row['buttonimage'];
  $headerimage = $row['headerimage'];
  $fangated = $row['fangated'];
  $appsecret = $row['appsecret'];
  $appid = $row['appid'];
  $backgroundimage = $row['backgroundimage'];
  $style = $row['style'];
  $contentheadline = $row['contentheadline'];
  $layouttype = $row['layouttype'];
  $paymenttype = $row['paymenttype'];
  $paymentlink = $row['paymentlink'];
  $dealdescription = $row['dealdescription'];
//this for the getting the month date and year seprately
  $dateresulttime = explode(" ", $date);
  $dateresult = explode("-", $dateresulttime[0]);
  $month = $dateresult[1];
  $day = $dateresult[0];
  $year = $dateresult[2];
  $timeresult = explode(":", $dateresulttime[1]);
  $hour = $timeresult[0];
  $minute = $timeresult[1];
  $second = $timeresult[2];
// print_r ($month);
  $aweberid = $row['aweberid'];
  $mailchimplist = $row['mailchimplist'];
  $mailchimpapikey = $row['mailchimpapikey'];
  $dealid = $row['id'];
  $returnurl = $row['paypalredirecturl'];
  $getresponseapi = $row['getresponseapi'];
  $content = $row['content'];
  $content = urldecode($content);
  $content = stripslashes($content);
  $custom_message = $row['custom_message'];
  $content = stripslashes($content);
  $dialog_type = $row['dialog_type'];
  $app_url = $row['app_url'];
  $subheadline = $row['subheadline'];
  $customlink = $row['customlink'];
  $liketext = $row['liketext'];
  $currency = $row['currency'];
  $show_dealtitle = $row['show_dealtitle'];

  if($currency == "USD"){$dcurrency = '$';}
  if($currency == "EUR"){$dcurrency = '€';}
  if($currency == "GBP"){$dcurrency = '£';}
  if($currency == "JPY"){$dcurrency = '¥';}
$currencylist = array("EUR","USD","JPY","GBP");

if(in_array($currency, $currencylist)){
//Element present in list
}else{
//not present.
$dcurrency = '<span style="font-size:10px;">'.$currency.'</span> ';
}
/*
$darkcollor="#e7205f";
$lightcollor="#b80425";
$textcollor="#000000";
$buy_now_button_color="#000000";
$buy_now_text_color="#dedede";
$pricetag_color="#ffffff";
*/
$darkcollor = $row['darkcollor'];
$lightcollor = $row['lightcollor'];
$textcollor = $row['textcollor'];
$buy_now_button_color = $row['buy_now_button_color'];
$buy_now_text_color = $row['buy_now_text_color'];
$pricetag_color = $row['pricetag_color'];

$invite_friends = $row['invite_friends'];
$terms_conditions = $row['terms_conditions'];
$privacy_policy = $row['privacy_policy'];
$price_text = $row['price_text'];
$normal_price_text = $row['normal_price_text'];
$discount_text = $row['discount_text'];
$offer_price_text = $row['offer_price_text'];
$days_text = $row['days_text'];
$hours_text = $row['hours_text'];
$minutes_text = $row['minutes_text'];
$seconds_text = $row['seconds_text'];
$buy_now_text = $row['buy_now_text'];
$click_here_text = $row['click_here_text'];
	$paypal_language = $row['paypal_language'];
	$tracking_code = $row['tracking_code'];
	$tracking_code = urldecode($tracking_code);
	$tracking_code = stripslashes($tracking_code);

	$admin_id = $row['admin_id'];


  //if($currency <> 'USD' || $currency <> 'EUR' || $currency <> 'GBP' || $currency <> 'JPY'){$dcurrency = $currency.' ';}

//echo   $getresponseapi;
  $campaignname = $row['campaignname'];
}
//this if condition is for the predefined theme
/*if ($layouttype == 'Yes')
{
$headerimages = './themes/' . $style . '/images/x_02.png';
$dealbuttons = './themes/' . $style . '/images/x_11.png';
$backgroundimages = './themes/' . $style . '/images/x_01.png';
$headercss = './themes/' . $style . '/css/header.css';
$css = './themes/' . $style . '/style.css';
}
*///this is for the mannual layout setting
if($layouttype == 'pre'){
	$topimg = './themes/' . $style . '/images/x_02.png';
}elseif($layouttype == 'upload'){
	$topimg = './admin/images/headerimage/' . $headerimage;
}

//https://www.fbsocialdeals.com/deals/admin/images/buttonimage/5066048340d0dx_11.png
$dealbuttons = './admin/images/buttonimage/button_red.png';
$backgroundimages = './themes/' . $style . '/images/x_01.png';
$css = './themes/' . $style . '/style.css';

if(!@$_GET['preview']){
// check if application is loaded in TAB or CANVAS and redirect to TAB if needed
$referer = parse_url($_SERVER['HTTP_REFERER']);
$referer = $referer['host'];
if ($referer == 'apps.facebook.com'){
echo '<script> top.location.href="' . $app_url . '"</script>';
exit;
}

//this the facebook function
try
{
  include_once "facebook.php";
}
catch (Exception $o)
{
  echo '<pre>';
  print_r($o);
  echo '</pre>';
}
$facebook = new Facebook(array('appId' => '437387719744801', 'secret' => '0a539fe8bc09ac619ae2af7ea48cffaf', 'cookie' => true));
echo $signed_request = $facebook->getSignedRequest();
$pageid = $signed_request["page"]["id"];
$page_admin = $signed_request["page"]["admin"];
$like_status = $signed_request["page"]["liked"];
$country = $signed_request["user"]["country"];
$locale = $signed_request["user"]["locale"];
$fql = "select page_url FROM page WHERE page_id ='" . $pageid . "'";
$page_url = $facebook->api(array('method' => 'fql.query', 'query' => $fql,));
print_r($page_url);
$page_url = $page_url[0]['page_url'] . '?sk=app_437387719744801';
$imageurl = $weburl . '/admin/images/wallimage/' . $wallimage;
//checking for the like status and the wallpost
if ($like_status == '1' || $fangated == 'No')
{
  $user = $facebook->getUser();
//if wallpost is allowed for user than login urll with publish_stream
  if ($wallpermission == 'Yes')
  {
    echo $loginUrl = $facebook->getLoginUrl(array('scope' => 'email,publish_stream', 'redirect_uri' => $page_url,
//,user_birthday,user_location,user_work_history,user_about_me,user_hometown
    ));
  }
//else get user basic info
  else
  {
    $loginUrl = $facebook->getLoginUrl(array('scope' => 'email', 'redirect_uri' => $page_url,
//,user_birthday,user_location,user_work_history,user_about_me,user_hometown
    ));
  }
//this is for the checking the user have given permission or not
  if ($user)
  {
//this for getting the user basic information
    $user_info = $facebook->api("/$user");
	 $name = $user_info['name'];
     $email = $user_info['email'];
//if the wallpost is allowed tha it post the data to user wallpost
    if ($wallpermission == 'Yes')
    {
$results=mysql_query("SELECT * FROM dealviewer WHERE viewdealid = '$id' AND email = '$email' AND admin_id = '$admin_id'");
$message_sent=mysql_result($results,$a,"message_sent");

		if($message_sent <> 'true'){
			$post = $facebook->api("/me/feed", 'post', array('description' => $wallmessage, 'link' => $page_url, 'picture' => $imageurl, 'name' => $wallname, 'caption' => $page_url));
			mysql_query("UPDATE `dealviewer` SET `message_sent`='true' WHERE viewdealid = '$id' AND email = '$email' AND admin_id = '$admin_id'");
		}


    }
  }
  else
  {
	  if ($wallpermission == 'Yes' || $autorespondertype <> ''){
    echo '<script>top.location.href="' . $loginUrl . '"</script>';
	  }
  }
}

} // end preview check
mysql_close();
?>

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
<title>Deal Site</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel = "stylesheet" type="text/css" href="<?php echo $css;?>" >
<link rel = "stylesheet" type="text/css" href="css/header.css" >
<link rel = "stylesheet" type="text/css" href="themes/style.css" >

<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.countdown.js"></script>

<?php
//turn date to unix timestamp for copmparison
$systime = mktime(date("H"), date("i"), date("s"), date("n"), date("j"), date("Y"));

$sys = preg_split('/[- :]/',$date);
$expdate = mktime($sys['3'],$sys['4'],$sys['5'],$sys['1'],$sys['0'],$sys['2'],-1); 

?>

<script type="text/javascript">
var currenttime = '<? print date("Y/m/d H:i:s", time())?>';

var montharray=new Array("01","02","03","04","05","06","07","08","09","10","11","12");
var serverdate=new Date(currenttime);

function padlength(what){
var output=(what.toString().length==1)? "0"+what : what
return output
}

function displaytime(){
serverdate.setSeconds(serverdate.getSeconds()+1)
var datestring=serverdate.getFullYear()+"/"+montharray[serverdate.getMonth()]+"/"+padlength(serverdate.getDate())
var timestring=padlength(serverdate.getHours())+":"+padlength(serverdate.getMinutes())+":"+padlength(serverdate.getSeconds())
return datestring+" "+timestring; 
}

var dtime = displaytime();

$(function() {
    var currentDate = new Date();
    var currentDate = dtime;
	var mixStuf = "<?php echo $date; ?>###"+dtime;
	var d, h, m, s;
	$('div#clock').countdown(mixStuf, function(event) {
    $this = $(this);
    switch(event.type) {
      case "days":
        d = event.value;
        break;
      case "hours":
        h = event.value;
        break;
      case "minutes":
        m = event.value;
        break;
      case "seconds":
        s = event.value;
        break;
      case "finished":

document.getElementById('light3').style.display='block';
document.getElementById('fade3').style.display='block';
$('#price').val('<?php echo $realprice;?>');
$('#de234').val('yes');
        break;
    }
$this.find('span#seconds').html(s);
$this.find('span#minutes').html(m);
$this.find('span#hours').html(h);
$this.find('span#daysLeft').html(d);

  });
});

<?php if(!@$_GET['preview']){ ?>

function submitform()
{
  document.paypal_form.submit();
}

//script for the user info storing the  database calling ajax
//for inserting the user info inthe database the replies by the user

  var dealid='<?php echo $dealid;?>';
  var username= '<?php echo $name;?>';
  var email= '<?php echo $email;?>';
  var aweberid= '<?php echo $aweberid;?>';
  var mailchimpapikey='<?php echo $mailchimpapikey;?>';
  var mailchimplist='<?php echo $mailchimplist;?>';
  var autorespondertype='<?php echo $autorespondertype;?>';
  var getresponseapi='<?php echo $getresponseapi;?>';
  var admin_id='<?php echo admin_id;?>';


//  alert(getresponseapi);
  var campaignname='<?php echo $campaignname;?>';
//  alert(campaignname);
 if(name!='' && email!=''){
  var req = $.ajax(
    {
    type: "POST",
    url: "insertuser.php",
    data: "campaignname="+campaignname+"&getresponseapi="+getresponseapi+"&name="+username+"&email="+email+"&aweberid="+aweberid+"&mailchimpapikey="+mailchimpapikey+"&mailchimplist="+mailchimplist+"&dealid="+dealid+"&autorespondertype="+autorespondertype+"&admin_id="+admin_id,
    cache: false,
    success: function(html) {
 //  alert(html);
      }
    }
  );
}
<?php } ?>
</script>




<link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<style>
#dealhdr{

	font-family: 'Droid Sans', sans-serif;
	font-weight: bold;
	font-size: 42px;
	text-align: center;
	color: #FFF;
	text-shadow: 1px 1px 1px #000;
	vertical-align:middle;
}

.likebox_out{
background-color:#ffffff;
z-index:900;
position:absolute;
top:200px;
width:446px;
margin-left:180px;
vertical-align:middle;
border:1px solid #d0d0d0;
-webkit-box-shadow: 0px 0px 4px 0px #000000;
box-shadow: 0px 0px 4px 0px #000000;
}

.likebox_in{
width:400px;
border:3px solid #dbdbdb;
padding:20px;
text-align:center;
}

.likebox_text{
font-family: 'Droid Sans', sans-serif;
font-weight: bold;
font-size:32px;
color: #333333;
text-shadow: 1px 1px 1px #000;
line-height:42px;
}

.gradient_menu{
	background-color: <?php echo $lightcollor; ?>;
	background-image: -webkit-gradient(linear, left top, left bottom, from(<?php echo $lightcollor; ?>), to(<?php echo $darkcollor; ?>));
	background-image: -webkit-linear-gradient(top, <?php echo $lightcollor; ?>, <?php echo $darkcollor; ?>);
	background-image: -moz-linear-gradient(top, <?php echo $lightcollor; ?>, <?php echo $darkcollor; ?>);
	background-image: -o-linear-gradient(top, <?php echo $lightcollor; ?>, <?php echo $darkcollor; ?>);
	background-image: linear-gradient(to bottom, <?php echo $lightcollor; ?>, <?php echo $darkcollor; ?>);
	margin-top:-4px;
	margin-left:11px;
	margin-right:6px;
	border-left:1px solid #d0d0d0;
	border-right:1px solid #d0d0d0;
	border-bottom:1px solid #d0d0d0;
}

.menu-top a{
color:<?php echo $textcollor; ?>;
}

.menu-top2 a{
color:<?php echo $textcollor; ?>;
}

.gradient_offer{
	background-color: <?php echo $lightcollor; ?>;
	background-image: -webkit-gradient(linear, left top, left bottom, from(<?php echo $lightcollor; ?>), to(<?php echo $darkcollor; ?>));
	background-image: -webkit-linear-gradient(top, <?php echo $lightcollor; ?>, <?php echo $darkcollor; ?>);
	background-image: -moz-linear-gradient(top, <?php echo $lightcollor; ?>, <?php echo $darkcollor; ?>);
	background-image: -o-linear-gradient(top, <?php echo $lightcollor; ?>, <?php echo $darkcollor; ?>);
	background-image: linear-gradient(to bottom, <?php echo $lightcollor; ?>, <?php echo $darkcollor; ?>);
	margin-left:2px;
	margin-right:20px;
	border-left:1px solid #d0d0d0;
	border-right:1px solid #d0d0d0;
	border-top:1px solid #d0d0d0;
	padding-top:10px;
	padding-bottom:10px;
	height:25px;
}

.buy_button{
	display:block;
	background-color: <?php echo $buy_now_button_color; ?>;
	-moz-border-radius: 20px;
	-webkit-border-radius: 20px;
	-khtml-border-radius: 20px;
	border-radius: 20px;
	font-size:14px;
	float:right;
	margin-right:20px;
	padding-left:25px;
	padding-right:25px;
	padding-top:5px;
	padding-bottom:5px;


}
.buy_button a{
text-decoration:none;
color:<?php echo $buy_now_text_color; ?>;
}
</style>


</head>
<body bgcolor=#ffffff leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script> 
<?php
//this validation for the checking the fangated is allowed or not if allowed than show fangate image if user didn't like this page
if ($fangated == 'Yes' && $like_status == '0')
{
?>


<img src="./admin/images/fangatedimage/<?php echo $fangatedimage;?>" />
<?php if($liketext <> ''){?>
<div class="likebox_out">
<div class="likebox_in">
<span class="likebox_text"><?php echo $liketext;?></span>
</div>
</div>
<?php } ?>


<?php }else {
if($paymenttype == "paypal"){
?>
<form name='paypal_form' class="paypal" action="payments.php" method="post" id="paypal_form" target="_blank">
  <input type="hidden" name="cmd" value="_xclick" />
  <input type="hidden" name="no_note" value="1" />
  <input type="hidden" name="quantity_x" value="2" />
  <input type="hidden" name="lc" value="<?php echo $paypal_language;?>" />
  <input type="hidden" name="currency_code" value="<?php echo $currency;?>" />
  <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
  <input type="hidden" name="first_name" value="Customer's First Name"  />
  <input type="hidden" name="last_name" value="Customer's Last Name"  />
  <input type="hidden" name="payer_email" />
  <input type="hidden" name="item_number" value="<?php echo $id;?> " / >
  <input type="hidden" name="payingto" value="<?php echo $paypalemail;?>"/>
  <input type="hidden" id="price" name="price" value="<?php echo $ourprice;?>"/>
  <input type="hidden" name="dealname" value="<?php echo $dealtitle;?>"/>
  <input type="hidden" id="oid" name="oid" value="<?php echo $id;?>"/>
  <input type="hidden" id="de234" name="de" value="no"/>
</form>
<?php
}//end if paypal
?>
<div style="background:url(<?php echo $backgroundimages;?>) top repeat-x;">
<div style="background:url(images/p_13.jpg) bottom repeat-x;">
<script>
 window.fbAsyncInit = function() {
 FB.init({ appId: "<?php echo $appid ?>", status: true, cookie: true, xfbml: true,oauth:true });
 FB.Canvas.setAutoGrow();
};

(function() {
    var e = document.createElement('script');
    e.type = 'text/javascript';
    e.src = document.location.protocol +
                    '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
} ());




</script>



<center>
<table border="0" cellpadding="0" cellspacing="0" width=757>
  <tr>
    <td valign="middle" style="background-image: url(<?php echo $topimg;?>);height:155px;width:738px;background-repeat:no-repeat;background-position:12px 0px;" id="dealhdr"><span style="top:15px;position:relative;"><?php if($show_dealtitle == 'yes'){echo $dealtitle;}?></span></td>
  </tr>
  <tr>
    <!--<td background="images/x_04.png" width=757 height=51>-->
	<td width=757 height=51>
	<div class="gradient_menu">
	  <table border=0>
        <tr>
          <td width=400 style="margin: 0;padding: 0; border: 0;">
          	<div class="menu-top" style="padding-top:8px;">
          		<a href='javascript:void(0)'  onclick='sendRequests()' ><?php echo $invite_friends;?></a></div></td>
          <td width=320 align=right><div class="menu-top2" style="padding-top:8px;padding-bottom:12px;"> <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"><?php echo $terms_conditions; ?></a> <a href = "javascript:void(0)" onclick = "document.getElementById('light1').style.display='block';document.getElementById('fade1').style.display='block'"><?php echo $privacy_policy; ?></a></div></td>
        </tr>
      </table>
	</div>
	</td>
  </tr>
  <tr>
    <td><div style="padding:0px 4px; padding-top:0px; ">
        <div class=headline><?php echo $subheadline;?></div>
        <center>
          <table style="margin:4px;margin-top:15px;">
            <tr>
              <td valign=top><img src="./admin/images/dealimage/<?php echo $dealimage;?>" width='275' height='276'></td>
              <td width=20></td>
              <td valign=top><center>
			  <div class="gradient_offer">
			  <div style="font-size:17px;font-family:arial;color:<?php echo $textcollor;?>;font-weight:Bold;padding-left:20px;float:left;margin-top:2px;"><?php echo $price_text; ?> <span style="color:<?php echo $pricetag_color;?>;"><?php echo $dcurrency;?><?php echo $ourprice;?></span></div>
			  
						<?php
		          		if($paymenttype == "paypal"){echo '<div class="buy_button"><a href="javascript:document.paypal_form.submit();">'.$buy_now_text.'</a></div>';}
		          		elseif($paymenttype == "other"){echo '<div class="buy_button"><a href="'.$paymentlink.'" target="_blank">'.$buy_now_text.'</a></div>';} ?>

			  </div>
                  <table border="0" cellspacing="0" cellpadding="0" width="419">

                    <tr>
                      <td colspan=2 background="images/x_12.png" width=419 valign=top><div class=head44><?php echo $contentheadline;?></div>
                        <div class=head43><?php echo $dealdescription;?></div></td>
                    </tr>
                    <tr>
                      <td background="images/x_15.png" width=419 height=50 colspan=2><center>
                          <table width=319 cellspacing=0 cellpadding=0 border=0>
                            <tr>
                              <td width=100><div class=value><?php echo $normal_price_text; ?></div>
                                <div class=price><?php echo $dcurrency;?><?php echo $realprice;?></div></td>
                              <td width=100><div class=value><?php echo $discount_text; ?></div>
                                <div class=price><?php echo $dcurrency;?><?php echo $realprice - $ourprice;?></div></td>
                              <td width=100><div class=value><?php echo $offer_price_text; ?></div>
                                <div class=price><?php echo $dcurrency;?><?php echo $ourprice;?></div></td>
                            </tr>
                          </table>
                        </center></td>
                    </tr>
                    <tr>
                      <td colspan=2 align=center background="images/x_12.png" width=419></td>
                    </tr>
                    <tr>
                      <td colspan=2 background="images/x_17.png" width=419 height=69>
						<div id="clock">
							<p>
								<span id="daysLeft"></span>
								<?php echo $days_text; ?>
							</p>
							<div class="space"></div>
							<p>
								<span id="hours"></span>
								<?php echo $hours_text; ?>
							</p>
							<div class="space"></div>
							<p>
								<span id="minutes"></span>
								<?php echo $minutes_text; ?>
							</p>
							<div class="space"></div>
							<p>
								<span id="seconds"></span>
								<?php echo $seconds_text; ?>
							</p>
						</div>
                        </td>
                    </tr>
                  </table>
                </center></td>
            </tr>


          </table>

        </center>
<?php if($content <> ''){ ?>
<div style="border:1px solid #d0d0d0;width:700px;margin-left:13px;">
<div style="width:654px;border:3px solid #dbdbdb;padding:20px;">
<?php echo $content;?>
</div>
</div>
<?php } ?>

        <BR>
        <BR>
        <BR>
        <div style="padding-left:160px;">
         
      </div>
    </div>
  
    
  <!-- div for  the deal description-->
  <div id="fade" class="black_overlay"></div>
  <div id="fade3" class="deal_overlay" style="top:315px;left:346px;height:340px;width:420px;opacity:1.0;filter:alpha(opacity=100);background:none;}">
  <img src="images/deal_expired_banner.png" style="width:406px;margin-top:30px;">
  </div>
  
  <!--this div is for the deal expire-->
  <div id="light3" class="deal_content" style="top:540px;left:364px;height:75px;overflow:hidden;">
 
  
  <?php 
echo $custom_message; 
  if($customlink <> ''){
  $use_link= $customlink;
  $use_text= $click_here_text;
  $pp_link = $customlink;
  }
  else
  {
  $use_link = $paymentlink;
  $use_text= $buy_now_text;
  $pp_link = "javascript:document.paypal_form.submit();";
  }
  ?>
  <br />
  <center><p><?php if($paymenttype == "paypal"){echo '<a href="'.$pp_link.'" >'.$use_text.'</a>';}
          		elseif($paymenttype == "other"){echo '<a href="'.$use_link.'" target="_blank">'.$use_text.'</a>';} ?> 
				</p>
	
	</center>
  </div>

	

  <div id="light" class="white_content">
  <a class="boxclose" id="boxclose" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"></a>
  <h1 href = "javascript:void(0)" class="overlay_header"><?php echo $terms_conditions; ?></h1>
  <br />
  <?php echo $terms;?>
  </div>
  
  <!-- div for  the deal policy-->
  <div id="fade1" class="black_overlay"></div>
  <div id="light1" class="white_content">
  <a class="boxclose" id="boxclose" onclick = "document.getElementById('light1').style.display='none';document.getElementById('fade1').style.display='none'"></a>
  <h1 href = "javascript:void(0)" class="overlay_header"><?php echo $privacy_policy; ?></h1>
  <br />
  <?php echo $privacy;?>
  </div>

  <!-- div for  the deal terms-->
  <div id="fade2" class="black_overlay"></div>
  <div id="light2" class="white_content">
  <a href = "javascript:void(0)" style='float:right;' onclick = "document.getElementById('light2').style.display='none';document.getElementById('fade2').style.display='none'">Close</a><br />
  <br />
  <?php echo $terms;?>
  </div>

  <div id="fade5" class="black_overlay"></div>
  <div id="light5" class="white_content"> <a href = "javascript:void(0)" onclick = "document.getElementById('light5').style.display='none';document.getElementById('fade5').style.display='none'" style='float:right;'>Close</a> <br />
  <br />
  <?php echo $dealdescription;?>
  </div>

  </div>
  
    </td>
  
    </tr>
  

</table>
</div>
<?php }?>


<script>
      FB.init({
        appId  : '449796138396104',
        frictionlessRequests: true
      });
	FB.Canvas.setAutoGrow();
	

<?php if($dialog_type == 'Yes'){ ?>

      function sendRequests() {
        FB.ui({method: 'apprequests',
          message: 'Invite Your Friends'
        }, requestCallback);
      }
   
<?php }else{?>
	function sendRequests() {
		FB.ui({
          method: 'send',
          display: 'popup',
          name: '<?php echo $dealtitle;?>',
          link: '<?php echo $app_url;?>',
          picture: '<?php echo $weburl ?>/admin/images/dealimage/<?php echo $dealimage;?>',
          show_error: 'true'
        });
	}
<?php } ?>


	  function requestCallback(response) {
        // Handle callback here
      }

    </script>

<?php if($tracking_code <> ''){ echo $tracking_code;}?>
</body>
</html>