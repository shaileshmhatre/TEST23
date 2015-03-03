<?php
error_reporting(1);
ob_start();
session_start();

if(isset($_REQUEST['id'])){ $app_check='validate[required]';}else{$app_check='';};


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
$msg = '';
$themename = 'Select theme';
?>
<?php
//this is for the defining the parameters
require_once ('config.php');
$admin_id = $_SESSION['admin_id'];
//this class is database class

//this for showing the hidding the div for the functiong of the check box
$mailchimpstyle = "display:none;";
$aweberstyle = "display:none;";
$styleapp = 'display:none;';
$fangateddiv = 'display:none;';
$nolayoutdiv = 'display:none;';
$getresponsestyle = "display:none;";
$msg = '';
//this is for making the connection to the database
$db = mysql_connect($hostname, $hostacessname, $hostpassword);
mysql_select_db($databasename, $db) or die(mysql_error());

//this is for select statement value stored in the database
if (isset ($_REQUEST['id']))     // code for editing deal
{
  $validation = "";
  $containerstyle = "container1";
//action to be performed
  $action = "updateinfo.php?id=" . $_REQUEST['id'];
  $imagestyle = "";
  $id = $_REQUEST['id'];
//to select the data from data base call get function and where for the id condition
$selectquery = 'select * from deals where id="' . $id . '" AND admin_id='.$admin_id;
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
  $walls = $row['wallpermission'];
  $textoverlay = $row['textoverlay'];
  $fangatedimage = $row['fangatedimage'];
  $dealimage = $row['dealimage'];
  $dealbuttontext = $row['dealbuttontext'];
  $realprice = $row['realprice'];
  $ourprice = $row['ourprice'];
//  $buttonimage = $row['buttonimage'];
  $headerimage = $row['headerimage'];
  $fangatecheck = $row['fangated'];
  $appsecret = $row['appsecret'];
  $appid = $row['appid'];
  $backgroundimage = $row['backgroundimage'];
  $style = $row['style'];
  $contentheadline = $row['contentheadline'];
  $layouttype = $row['layouttype'];
  $paymenttype = $row['paymenttype'];
  $paymentlink = $row['paymentlink'];
  $dealdescription = $row['dealdescription'];
  $aweberid = $row['aweberid'];
  $mailchimplist = $row['mailchimplist'];
  $mailchimpapikey = $row['mailchimpapikey'];
  $dealid = $row['id'];
  $returnurl = $row['paypalredirecturl'];
  $getresponseapi = $row['getresponseapi'];
  $campaignname = $row['campaignname'];
  $content = $row['content'];
  $content = urldecode($content);
  $content = stripslashes($content);
  $custom_message = $row['custom_message'];
  $custom_message = stripslashes($custom_message);
  $dialog_type = $row['dialog_type'];
  $app_url = $row['app_url'];
  $subheadline = $row['subheadline'];
  $customlink = $row['customlink'];
  $liketext = $row['liketext'];
  $currency = $row['currency'];
  $themename=$style;
$language = $row['language'];
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
$show_dealtitle = $row['show_dealtitle'];

$colorscheme = $row['colorscheme'];
$customdarkcolor = $row['darkcollor'];
$customlightcolor = $row['lightcollor'];
$textcollor = $row['textcollor'];
$buy_now_button_color = $row['buy_now_button_color'];
$buy_now_text_color = $row['buy_now_text_color'];
$pricetag_color = $row['pricetag_color'];

if($customdarkcolor == ''){$customdarkcolor='#f2f2f2';}
if($customlightcolor == ''){$customlightcolor='#f2f2f2';}
if($textcollor == ''){$textcollor='#f2f2f2';}
if($buy_now_button_color == ''){$buy_now_button_color='#f2f2f2';}
if($buy_now_text_color == ''){$buy_now_text_color='#f2f2f2';}
if($pricetag_color == ''){$pricetag_color='#f2f2f2';}
}




    //this for get autoresponder type and display related fields
  if ($autorespondertype == "Mailchimp")
  {
    $mailchimpstyle = "display:block;";
  }
  if ($autorespondertype == "Aweber")
  {
    $aweberstyle = "display:block;";
  }
  if ($autorespondertype == "getresponse")
  {
    $getresponsestyle = "display:block;";
  }
//for checking the wallpost is allowed or not
  if ($walls == 'Yes')
  {
    $wall = 'checked="checked"';
    $wallno = '';
    $styleapp = 'display:block;';
  }

  else
  {
    $styleapp = 'display:none;';
    $wallno = 'checked="checked"';
    $wall = '';
  }


  if ($dialog_type == 'Yes')
  {
    $dialog = 'checked="checked"';
    $dialogno = '';
  }
  else
  {
    $dialogno = 'checked="checked"';
    $dialog = '';
  }


  if ($layouttype == 'pre')
  {
    $precheck = 'checked="checked"';
    $uploadcheck = '';
    $showpre = 'display:block;';
    $showupload = 'display:none;';
  }
if ($layouttype == 'upload')
  {
    $precheck = '';
    $uploadcheck = 'checked="checked"';
    $showupload = 'display:block;';
    $showpre = 'display:none;';
  }
//check payment type if edit
if($paymenttype == "paypal"){
    $paypal = 'checked="checked"';
    $other = '';
    $showpaypal = 'display:block;';
    $showother = 'display:none;';
}
if($paymenttype == "other"){
    $paypal = '';
    $other = 'checked="checked"';
    $showpaypal = 'display:none;';
    $showother = 'display:block;';
}
//for checking the fangated or not
  if ($fangatecheck == 'Yes')
  {
    $fangated = 'checked="checked"';
    $nofangated = '';
    $fangateddiv = 'display:block;';
  }
  else
  {
    $styleapp = 'display:none;';
    $nofangated = 'checked="checked"';
    $fangated = '';
  }
//this condition for the displaying the updated message
  if (isset ($_REQUEST['update']))
  {
    $msg = 'Your deal info is successfully updated';
  }

}
//else create new deall
else
{
  $aweberstyle = "display:none;";
  $mailchimpstyle = "display:none;";
  $getresponsestyle = "display:none;";
  $layout = 'checked="checked"';
  $nofangated = 'checked="checked"';
  $wallno = 'checked="checked"';
  $containerstyle = "container";
  $action = 'insertinfo.php';
  $imagestyle = "display:none;";
}

//set default layout type
if(!isset($layouttype)){
    $precheck = 'checked';
    $uploadcheck = '';
    $showpre = 'display:block;';
    $showupload = 'display:none;';
}
//set default payment type
if(!isset($paymenttype)){
    $paypal = 'checked="checked"';
    $other = '';
    $showpaypal = 'display:block;';
    $showother = 'display:none;';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="bt/bootstrap.css" />
<script src="http://code.jquery.com/jquery-1.8.0.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.8.23/themes/smoothness/jquery-ui.css" />
<script src="js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<link href="css/colorpicker.css" rel="stylesheet">
<title>Edit Deal</title>
<script>
jQuery(document).ready(function(){
  // binds form submission and fields to the validation engine
  $("#add_evt").validationEngine({promptPosition : "centerRight", scroll: false}); 
  jQuery("#create").validationEngine('attach');
  jQuery('input').attr('data-prompt-position','centerRight');
  jQuery('input').data('promptPosition','centerRight');

  var Switcher = function(showit,hideit) { 
    $(showit).show();
    $(hideit).hide();
  };

  //show/hide layers for check boxes
  $('#pre').click(function() {
    Switcher("#headerpre","#hdrupload");
  });
  $('#upload').click(function() {
    Switcher("#hdrupload","#headerpre");
  });
  $('#allowpermission').click(function() {
    $('#wall2').show();
  });
  $('#notallowed').click(function() {
    $('#wall2').hide();
  });
  $('#fangated').click(function() {
    $('#fangateddiv').show();
  });
  $('#notfangated').click(function() {
    $('#fangateddiv').hide();
  });
  $('#paypal').click(function() {
    Switcher("#showpaypal","#showother");
  });
  $('#other').click(function() {
    Switcher("#showother","#showpaypal");
  });

});

//function for number
 function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }


//function for the check box
function checkOnly(ele){
   var frm=ele.form;
   for (var i=0; i<frm.elements.length; i++){
      if (frm.elements[i].name==ele.name){
        if (frm.elements[i].checked){
         frm.elements[i].checked=false;
        }
     }
  }
  ele.checked=true;
}
  //this function is used for the showing and hidding
function showappid(appsidz){
  //this if condition is used for the showing the auto responder
  var auto=document.getElementById('autorespondertype').value;
  if(auto=="Aweber"){
      document.getElementById('mailchimpstyle').style.display='none';
      document.getElementById('aweberstyle').style.display='block';
      document.getElementById('getresponsestyle').style.display='none';
   }
  if(auto=="Mailchimp") {
      document.getElementById('aweberstyle').style.display='none';
      document.getElementById('mailchimpstyle').style.display='block';
      document.getElementById('getresponsestyle').style.display='none';
  }
  if(auto=="getresponse"){
      document.getElementById('aweberstyle').style.display='none';
      document.getElementById('mailchimpstyle').style.display='none';
      document.getElementById('getresponsestyle').style.display='block';
  }
}
</script>
<link rel="stylesheet" media="all" type="text/css" href="js/datetime/jquery-ui-timepicker-addon.css" />
<script type="text/javascript" src="js/datetime/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/datetime/jquery-ui-sliderAccess.js"></script>
<script>
  $(function(){
    $('#dp1').datetimepicker({
            dateFormat: "yy/mm/dd",
            timeFormat: "hh:mm:ss"
      });
  });
</script>
<!--date picker-->
<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<style>
.preview_text{
font-size:17px;
font-family:arial;
color:<?php echo $textcollor; ?>;
font-weight:Bold;
}

.preview_text a{
font-family:arial;
font-size:12px;
font-weight:bold;
letter-spacing:0;
text-decoration:none;
text-transform:uppercase;
color:<?php echo $textcollor; ?>;
}

.preview_pricetag{
font-size:17px;
font-family:arial;
font-weight:Bold;
color:<?php echo $pricetag_color; ?>;
}

.preview_buy_button{
	display:block;
	background-color:<?php echo $buy_now_button_color; ?>;
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
	margin-top:-3px;
	}

.preview_buy_button a{
text-decoration:none;
color:<?php echo $buy_now_text_color; ?>;
}


</style>

</head>

<body style="overflow: visible;">
<?php include("top.php");?>
<div class="page-header" style="margin-top: 50px;">
  <h1>Deal Admin</h1>
</div>
<h2><?php echo $msg;?></h2>
<div class="row">
  <div class="span12">
    <form name="create" id="create" action="<?php echo $action;?>" method="post" enctype="multipart/form-data" >
      <div class="actions">
        <fieldset>
          <legend>Deal Settings</legend>
          <div class="clearfix">
            <label for="xlInput">Deal Title</label>
            <div class="input">
              <input name="dealtitle" id="dealtitle" class="validate[required]" size="30" value="<?php echo $dealtitle;?>" type="text" />
            </div>
          </div>
          <!-- /clearfix -->
		  <div class="clearfix">
            <label for="xlInput">Show Deal Title</label>
            <div class="input">
			  <input type="checkbox" name="show_dealtitle" value="yes" <?php if($show_dealtitle <> 'no'){echo 'checked';}?>>
            </div>
          </div>
          <!-- /clearfix -->
		  <div class="clearfix">
            <label for="xlInput">Sub Headline</label>
            <div class="input">
              <input name="subheadline" id="subheadline" class="validate[required]" size="30" value="<?php echo $subheadline;?>" type="text" />
            </div>
          </div>
          <!-- /clearfix -->
          <div class="clearfix">
            <label for="xlInput">Content headline</label>
            <div class="input">
              <input name="contentheadline" id="contentheadline" class="validate[required]" size="30" value="<?php echo $contentheadline;?>" type="text" />
            </div>
          </div>
          <!-- /clearfix --> 
          <!--Text area start for deall description-->
          
          <div class="clearfix">
            <label for="textarea">Deal Description</label>
            <div class="input">
              <textarea class="validate[required]" id="textarea2" name="dealdescription" rows="3"><?php echo $dealdescription;?></textarea>
            </div>
          </div>
          <!-- /clearfix --> 
          <!--for the deal image-->
          <div class="clearfix">
            <label for="fileInput">Deal Image</label>
            <div class="input">
              <input name="dealimage" id="dealimage" accept="image/x-png, image/gif, image/jpeg" class="input-file<?php if(!$dealimage){echo ' validate[required]';}?>" type="file"  />
            </div>
            <div class="clearfix" style="<?php echo $imagestyle;?>">
              <label for="fileInput">Current Image</label>
              <div class="input"> <img src="images/dealimage/<?php echo $dealimage;?>" width="100"> </div>
            </div>
            <!-- /clearfix --> 
          </div>
          <!-- /clearfix --> 
		  
          <!--this div is used for the deal price-->
          <div class="clearfix">
            <label for="xlInput">Normal Price</label>
            <div class="input">
              <input type="text" name="realprice" id="realprice" class="small validate[required,custom[number]]" value="<?php echo $realprice;?>" />
            </div>
          </div>
          <!-- /clearfix -->
          <div class="clearfix">
            <label for="xlInput">Discount Price</label>
            <div class="input">
              <input type="text" name="ourprice" id="ourprice" class="small validate[required,custom[number]]" value="<?php echo $ourprice;?>" />
            </div>
          </div>
          <!-- /clearfix --> 
		  <div class="clearfix">
          <label for="normalSelect">Currency:</label>
          <div class="input">
            <select  name="currency" id="currency">
              <option value="USD" <?php if($currency == "USD"){echo "selected";}?>>USD - United States Dollars</option>
			  <option value="EUR" <?php if($currency == "EUR"){echo "selected";}?>>EUR - Euros</option>
			  <option value="GBP" <?php if($currency == "GBP"){echo "selected";}?>>GBP - Pounds Sterling</option>
			  <option value="AUD" <?php if($currency == "AUD"){echo "selected";}?>>AUD - Australian Dollars</option>
			  <option value="BRL" <?php if($currency == "BRL"){echo "selected";}?>>BRL - Brazilian Real</option>
			  <option value="CAD" <?php if($currency == "CAD"){echo "selected";}?>>CAD - Canadian Dollars</option>
			  <option value="CHF" <?php if($currency == "CHF"){echo "selected";}?>>CHF - Swiss Franc</option>
			  <option value="CZK" <?php if($currency == "CZK"){echo "selected";}?>>CZK - Czech Koruna</option>
			  <option value="DKK" <?php if($currency == "DKK"){echo "selected";}?>>DKK - Danish Krone</option>
			  <option value="HKD" <?php if($currency == "HKD"){echo "selected";}?>>HKD - Hong Kong Dollar</option>
			  <option value="HUF" <?php if($currency == "HUF"){echo "selected";}?>>HUF - Hungarian Forint</option>
			  <option value="ILS" <?php if($currency == "ILS"){echo "selected";}?>>ILS - Israeli Shekel</option>
			  <option value="JPY" <?php if($currency == "JPY"){echo "selected";}?>>JPY - Japanese Yen</option>
			  <option value="MYR" <?php if($currency == "MYR"){echo "selected";}?>>MYR - Malaysian Ringgit </option>
			  <option value="MXN" <?php if($currency == "MXN"){echo "selected";}?>>MXN - Mexican Peso</option>
			  <option value="NOK" <?php if($currency == "NOK"){echo "selected";}?>>NOK - Norwegian Krone</option>
			  <option value="NZD" <?php if($currency == "NZD"){echo "selected";}?>>NZD - New Zealand Dollar</option>
			  <option value="PHP" <?php if($currency == "PHP"){echo "selected";}?>>PHP - Philippine Peso </option>
			  <option value="PLN" <?php if($currency == "PLN"){echo "selected";}?>>PLN - Polish Zloty</option>
			  <option value="SEK" <?php if($currency == "SEK"){echo "selected";}?>>SEK - Swedish Krona</option>
			  <option value="SGD" <?php if($currency == "SGD"){echo "selected";}?>>SGD - Singapore Dollar</option>
			  <option value="TWD" <?php if($currency == "TWD"){echo "selected";}?>>TWD - Taiwan New Dollar </option>
			  <option value="THB" <?php if($currency == "THB"){echo "selected";}?>>THB - Thai Baht </option>
			  <option value="TRY" <?php if($currency == "TRY"){echo "selected";}?>>TRY - Turkish Lira</option>
            </select>
          </div>
		  </div>
          <!-- /clearfix -->

          <div class="clearfix">
            <label for="xlInput">Payment Type</label>
            <div class="input">
              <table style="padding: 0px; margin: 0px;">
                <tr>
                  <td>Paypal</td>
                  <td><input name="paymenttype" value="paypal" type="radio" id="paypal" <?php echo $paypal;?>/></td>
                  <td>Other</td>
                  <td><input name="paymenttype" value="other" type="radio" id="other" <?php echo $other;?>/></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="showpaypal" style="<?php echo $showpaypal;?>">
            <div class="clearfix">
              <label for="xlInput">PayPal Email</label>
              <div class="input">
                <input name="paypalemail"  class="medium validate[required,custom[email]]" type="text"  value="<?php echo $paypalemail;?>" />
              </div>
            </div>
          <!-- /clearfix -->
          
          <div class="clearfix">
            <label for="xlInput">PayPal Redirect Url</label>
            <div class="input">
              <input name="paypalredirecturl"  class="xlarge validate[condRequired[paypalemail]]" type="text"  value="<?php echo $returnurl;?>" />
            </div>
          </div>

		  <div class="clearfix">
		  <label for="normalSelect">PayPal Localization:</label>
          <div class="input">
            <select  name="paypal_language" id="paypal_language">
<option value="US" <?php if($paypal_language == "US"){echo "selected";}?>>US – United States</option>
<option value="AU" <?php if($paypal_language == "AU"){echo "selected";}?>>AU – Australia</option>
<option value="AT" <?php if($paypal_language == "AT"){echo "selected";}?>>AT – Austria</option>
<option value="BE" <?php if($paypal_language == "BE"){echo "selected";}?>>BE – Belgium</option>
<option value="BR" <?php if($paypal_language == "BR"){echo "selected";}?>>BR – Brazil</option>
<option value="CA" <?php if($paypal_language == "CA"){echo "selected";}?>>CA – Canada</option>
<option value="CH" <?php if($paypal_language == "CH"){echo "selected";}?>>CH – Switzerland</option>
<option value="CN" <?php if($paypal_language == "CN"){echo "selected";}?>>CN – China</option>
<option value="DE" <?php if($paypal_language == "DE"){echo "selected";}?>>DE – Germany</option>
<option value="ES" <?php if($paypal_language == "ES"){echo "selected";}?>>ES – Spain</option>
<option value="FR" <?php if($paypal_language == "FR"){echo "selected";}?>>FR – France</option>
<option value="GB" <?php if($paypal_language == "GB"){echo "selected";}?>>GB – United Kingdom</option>
<option value="IT" <?php if($paypal_language == "IT"){echo "selected";}?>>IT – Italy</option>
<option value="NL" <?php if($paypal_language == "NL"){echo "selected";}?>>NL – Netherlands</option>
<option value="PL" <?php if($paypal_language == "PL"){echo "selected";}?>>PL – Poland</option>
<option value="PT" <?php if($paypal_language == "PT"){echo "selected";}?>>PT – Portugal</option>
<option value="RU" <?php if($paypal_language == "RU"){echo "selected";}?>>RU – Russia</option>
<option value="da_DK" <?php if($paypal_language == "da_DK"){echo "selected";}?>>da_DK – Danish (for Denmark only)</option>
<option value="he_IL" <?php if($paypal_language == "he_IL"){echo "selected";}?>>he_IL – Hebrew (all)</option>
<option value="id_ID" <?php if($paypal_language == "id_ID"){echo "selected";}?>>id_ID – Indonesian (for Indonesia only)</option>
<option value="jp_JP" <?php if($paypal_language == "jp_JP"){echo "selected";}?>>jp_JP – Japanese (for Japan only)</option>
<option value="no_NO" <?php if($paypal_language == "no_NO"){echo "selected";}?>>no_NO – Norwegian (for Norway only)</option>
<option value="pt_BR" <?php if($paypal_language == "pt_BR"){echo "selected";}?>>pt_BR – Brazilian Portuguese (for Portugal and Brazil only)</option>
<option value="ru_RU" <?php if($paypal_language == "ru_RU"){echo "selected";}?>>ru_RU – Russian (for Lithuania, Latvia, and Ukraine only)</option>
<option value="sv_SE" <?php if($paypal_language == "sv_SE"){echo "selected";}?>>sv_SE – Swedish (for Sweden only)</option>
<option value="th_TH" <?php if($paypal_language == "th_TH"){echo "selected";}?>>th_TH – Thai (for Thailand only)</option>
<option value="tr_TR" <?php if($paypal_language == "tr_TR"){echo "selected";}?>>tr_TR – Turkish (for Turkey only)</option>
<option value="zh_CN" <?php if($paypal_language == "zh_CN"){echo "selected";}?>>zh_CN – Simplified Chinese (for China only)</option>
<option value="zh_HK" <?php if($paypal_language == "zh_HK"){echo "selected";}?>>zh_HK – Traditional Chinese (for Hong Kong only)</option>
<option value="zh_TW" <?php if($paypal_language == "zh_TW"){echo "selected";}?>>zh_TW – Traditional Chinese (for Taiwan only)</option>
            </select>
          </div>
		  </div><!-- /clearfix -->
          </div><!-- end show paypal-->

          <div id="showother" style="<?php echo $showother;?>">
            <div class="clearfix">
              <label for="xlInput">Payment Link</label>
              <div class="input">
                <input name="paymentlink"  class="medium" type="text"  value="<?php echo $paymentlink;?>" />
              </div>
            </div>
          <!-- /clearfix -->
          </div><!-- end show other payment-->
          
          <div class="clearfix">
            <label for="xlInput">Expiry Date</label>
            <div class="input">
              <input name="date" class="xlarge" type="text" id="dp1" value="<?php if(isset($date)){echo $date;}?>"/><br>
              <?php echo "(System time: ".date("Y/m/d H:i:s").")";?>
            </div>
          </div>
          <!-- /clearfix -->
          
        </fieldset>
        <!--Deal related setting hasbeen finished-->
        
        <fieldset>
          <legend>Design Settings</legend>
          <div class="clearfix">
            <label for="textarea">Header Type</label>
            <div class="input">
              <table style="padding: 0px; margin: 0px;">
                <tr>
                  <td>Choose style</td>
                  <td><input name="layouttype" value="pre" id="pre" type="radio"  <?php echo $precheck;?>/></td>
                  <td>Upload header image</td>
                  <td><input name="layouttype" value="upload" id="upload" type="radio"  <?php echo $uploadcheck;?>/></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /clearfix --> 
          
          <!-- choose predefined background -->
          <div id="headerpre" style="<?php echo $showpre;?>">
            <div class="clearfix">
              <label for="normalSelect">Choose header:</label>
              <div class="input">
                <select  name="style" id="normalSelect">
                  <?php
                $color = array("black","blue","cyan","darkblue","green","orange","pink","purple","red","yellow");
                foreach($color as $hdr){
                  echo '<option value="'.$hdr.'"';
                  if($style == $hdr){echo ' selected';}
                  echo '>'.$hdr.'</option>';
                }
                ?>
                </select>
              </div>
            </div>
            <!-- /clearfix --> 
          </div>
          <!-- choose predefined background end--> 
          
          <!-- upload background -->
          <div id="hdrupload" style="<?php echo $showupload;?>">
            <div class="clearfix">
              <label for="fileInput">Upload Header</label>
              <div class="input">
                <input name="headerimage" id="headerimage" accept="image/x-png, image/gif, image/jpeg"   class="input-file" type="file"  />
              </div>
              <div class="clearfix" style="<?php echo $imagestyle;?>">
                <label for="fileInput">Current Image</label>
                <div class="input"> <img src="images/headerimage/<?php echo $headerimage; ?>" width="100"> </div>
              </div>
              <!-- /clearfix --> 
            </div>
            <!-- /clearfix --> 
          </div>
          <!-- upload  background end--> 
          
			<div class="clearfix">
              <label for="normalSelect">Choose color scheme:</label>
              <div class="input">
                <select  name="colorscheme" id="colorscheme" class="colorscheme validate[required]">
<option value="">None</option>
<option value="color11" <?php if($colorscheme == "color11"){echo "selected";}?>>Default</option>
<option value="color1" <?php if($colorscheme == "color1"){echo "selected";}?>>Pinky</option>
<option value="color2" <?php if($colorscheme == "color2"){echo "selected";}?>>Skywork</option>
<option value="color3" <?php if($colorscheme == "color3"){echo "selected";}?>>Greenlab</option>
<option value="color4" <?php if($colorscheme == "color4"){echo "selected";}?>>Monograph</option>
<option value="color5" <?php if($colorscheme == "color5"){echo "selected";}?>>Orangecounty</option>
<option value="color6" <?php if($colorscheme == "color6"){echo "selected";}?>>Metalwork</option>
<option value="color7" <?php if($colorscheme == "color7"){echo "selected";}?>>Faceblue</option>
<option value="color8" <?php if($colorscheme == "color8"){echo "selected";}?>>Operator</option>
<option value="color9" <?php if($colorscheme == "color9"){echo "selected";}?>>Purpleflow</option>
<option value="color10" <?php if($colorscheme == "color10"){echo "selected";}?>>uTorque</option>
<option value="colorcustom">Custom</option>
                </select>
              </div>
            </div>
<div id="colorcustom">
			<div class="clearfix">
              <label for="xlInput">Light Color:</label>
              <div class="input">
                <input name="customlightcolor" id="customlightcolor" class="two customlightcolor" type="text"  value="<?php echo $customlightcolor ;?>" />
              </div>
            </div>
            <!-- /clearfix --> 
			<div class="clearfix">
              <label for="xlInput">Dark color:</label>
              <div class="input">
                <input name="customdarkcolor" id="customdarkcolor" class="two" type="text"  value="<?php echo $customdarkcolor ;?>" />
              </div>
            </div>
            <!-- /clearfix --> 
			<div class="clearfix">
              <label for="xlInput">Link / Text color:</label>
              <div class="input">
                <input name="textcollor" id="textcollor" class="two" type="text"  value="<?php echo $textcollor ;?>" />
              </div>
            </div>
            <!-- /clearfix --> 
			<div class="clearfix">
              <label for="xlInput">Button color:</label>
              <div class="input">
                <input name="buy_now_button_color" id="buy_now_button_color" class="two" type="text"  value="<?php echo $buy_now_button_color ;?>" />
              </div>
            </div>
            <!-- /clearfix --> 
			<div class="clearfix">
              <label for="xlInput">Button text color:</label>
              <div class="input">
                <input name="buy_now_text_color" id="buy_now_text_color" class="two" type="text"  value="<?php echo $buy_now_text_color ;?>" />
              </div>
            </div>
            <!-- /clearfix --> 
			<div class="clearfix">
              <label for="xlInput">Pricetag color:</label>
              <div class="input">
                <input name="pricetag_color" id="pricetag_color" class="two" type="text"  value="<?php echo $pricetag_color ;?>" />
              </div>
            </div>
            <!-- /clearfix --> 
</div>
			<div class="clearfix">
              <label for="normalSelect">Color scheme preview:</label>
              <div class="input">
                <div style="width:400px;padding:15px;background-color:#000000;" id="colorscheme_preview">
				<div class="preview_text" id="preview_text">Text: <span class="preview_pricetag">$69</span> <a href="#" style="margin-left:70px;">menu link</a> <div class="preview_buy_button"><a href="#">Buy Button</a></div></div>
				
				</div>
              </div>
            </div>
            <!-- /clearfix --> 

        </fieldset>
        <fieldset>
          <legend>Facebook Settings</legend>
		  <div class="clearfix">
            <label for="textarea">Invite Dialog Type</label>
            <div class="input">
              <table style="padding: 0px; margin: 0px;">
                <tr>
                  <td style="width:100px;">Request Dialog</td>
                  <td><input name="dialog_type" type="radio" id="invite_type_request" <?php echo $dialog;?> <?php if(!isset($_REQUEST['id'])){ echo 'checked="checked"';};?> value="Yes" /></td>
                  <td style="width:85px;">Send Dialog</td>
                  <td><input name="dialog_type" type="radio" id="invite_type_send" <?php echo $dialogno;?> value="No" /></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /clearfix -->
 
		  <div class="clearfix">
              <label for="xlInput">Facebook App URL:</label>
              <div class="input">
                <input name="app_url"  class="two <?php echo $app_check;?>" type="text"  value="<?php echo $app_url;?>" />
              </div>
            </div>
            <!-- /clearfix --> 

          <div class="clearfix">
            <label for="textarea">Wall permissions</label>
            <div class="input">
              <table style="padding: 0px; margin: 0px;">
                <tr>
                  <td>Yes</td>
                  <td><input name="wallpermission" type="radio" id="allowpermission" <?php echo $wall;?> value="Yes" /></td>
                  <td>No</td>
                  <td><input name="wallpermission" type="radio" id="notallowed" <?php echo $wallno;?> value="No" /></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /clearfix -->
          <div id='wall2' style='<?php echo $styleapp;?>' > 
            <!--This div is used for the wallimage-->
            <div class="clearfix">
              <label for="fileInput">Wall post Image</label>
              <div class="input">
                <input name="wallimage" id="wallimage" accept="image/x-png, image/gif, image/jpeg"   class="input-file" type="file"  />
              </div>
              <div class="clearfix" style="<?php echo $imagestyle;?>">
                <label for="fileInput">Current Image</label>
                <div class="input"> <img src="images/wallimage/<?php echo $wallimage;?>" width="100" height="100"> </div>
              </div>
              <!-- /clearfix --> 
            </div>
            <!-- /clearfix --> 
            
            <!--Wall Name-->
            <div class="clearfix">
              <label for="xlInput">Post title</label>
              <div class="input">
                <input name="wallname"  class="xlarge" type="text"  value="<?php echo $wallname;?>" />
              </div>
            </div>
            <!-- /clearfix -->
            
            <div class="clearfix">
              <label for="textarea">Post comment</label>
              <div class="input">
                <textarea  rows="3" class="xxlarge" id="textarea2" name="wallmessage"/><?php echo $wallmessage;?></textarea>
              </div>
            </div>
            <!-- /clearfix --> 
            
          </div>

          <!--fangated-->
          <div class="clearfix">
            <label for="xlInput">Fangated</label>
            <div class="input">
              <table style="padding: 0px; margin: 0px;">
                <tr>
                  <td>Yes</td>
                  <td><input name="fangated" value="Yes" type="radio" id="fangated" <?php echo $fangated;?>/></td>
                  <td>No</td>
                  <td><input name="fangated" value="No" type="radio" id="notfangated" <?php echo $nofangated;?>/></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /clearfix -->
          <div id='fangateddiv' style='<?php echo $fangateddiv ?>' >
            <div class="clearfix">
              <label for="fileInput">Fangated Image</label>
              <div class="input">
                <input name="fangatedimage" id="fangatedimage" accept="image/x-png, image/gif, image/jpeg"   class="two" type="file"  />
              </div>
              <div class="clearfix" style="<?php echo $imagestyle;?>">
                <label for="fileInput">Current Image</label>
                <div class="input"> <img src="images/fangatedimage/<?php echo $fangatedimage;?>" width="100"> </div>
              </div>
              <!-- /clearfix --> 
            </div>
            <!-- /clearfix --> 
            <div class="clearfix">
            <label for="xlInput">Fangate Text</label>
            <div class="input">
              <input name="liketext" class="xlarge" type="text" value="<?php echo $liketext;?>" />
            </div>
          </div>
          <!-- /clearfix -->
          </div>
          <div class="clearfix">
            <label for="xlInput">App Id</label>
            <div class="input">
              <input name="appid" class="xlarge validate[required,custom[integer]]" type="text" value="<?php echo $appid;?>" />
            </div>
          </div>
          <!-- /clearfix -->
          <div class="clearfix">
            <label for="xlInput">App Secret</label>
            <div class="input">
              <input name="appsecret" class="xlarge validate[required]" type="text" value="<?php echo $appsecret;?>" />
            </div>
          </div>
          <!-- /clearfix -->
        </fieldset>
        <fieldset>
          <legend>Auto responder Settings</legend>
          <label for="normalSelect">Auto responder type:</label>
          <div class="input">
            <select  name="autorespondertype" id="autorespondertype" onchange="showappid('type');" >
              <option value="">Select Auto responder type</option>
              <option value="Mailchimp" <?php if($autorespondertype == "Mailchimp"){echo "selected";}?>>Mailchimp</option>
              <option value="Aweber" <?php if($autorespondertype == "Aweber"){echo "selected";}?>>Aweber</option>
              <option value="getresponse" <?php if($autorespondertype == "getresponse"){echo "selected";}?>>Get Response</option>
            </select>
          </div>
          <!--this div is used for the aweber-->
          <div id="aweberstyle" style="<?php echo $aweberstyle;?>">
            <div class="clearfix">
              <label for="xlInput">Aweber Id:</label>
              <div class="input">
                <input name="aweberid"   class="xlarge" type="text"  value="<?php echo $aweberid;?>" />
              </div>
            </div>
            <!-- /clearfix --> 
          </div>
          <div id="getresponsestyle" style="<?php echo $getresponsestyle;?>" >
            <div class="clearfix">
              <label for="xlInput">Get response apikey:</label>
              <div class="input">
                <input name="getresponseapi"   class="xlarge" type="text"  value="<?php echo $getresponseapi;?>" />
              </div>
            </div>
            <!-- /clearfix -->
            <div class="clearfix">
              <label for="xlInput">CampaignName:</label>
              <div class="input">
                <input name="campaignname"   class="xlarge" type="text"  value="<?php echo $campaignname;?>" />
              </div>
            </div>
            <!-- /clearfix --> 
            
          </div>
          
          <!--this is used for the maailchimp-->
          <div  id="mailchimpstyle" style="<?php echo $mailchimpstyle;?>">
            <div class="clearfix">
              <label for="xlInput">Mailchimp List ID:</label>
              <div class="input">
                <input name="mailchimplist"  class="two" type="text"  value="<?php echo $mailchimplist;?>" />
              </div>
            </div>
            <!-- /clearfix -->
            
            <div class="clearfix">
              <label for="xlInput">Mailchimp Api-key:</label>
              <div class="input">
                <input name="mailchipapikey"  class="two" type="text"  value="<?php echo $mailchimpapikey;?>" />
              </div>
            </div>
            <!-- /clearfix --> 
          </div>
        </fieldset>
        <fieldset>
          <legend>Other Settings</legend>
		  <div class="clearfix">
            <label for="textarea">Tracking code</label>
            <div class="input">
              <textarea class="xxlarge" id="5" name="tracking_code" rows="3" style="width:350px;"><?php echo $tracking_code; ?></textarea>
            </div>
          </div>
          <!-- /clearfix -->
          <div class="clearfix">
            <label for="textarea">Terms</label>
            <div class="input">
              <textarea class="xxlarge" id="textarea2" name="terms" rows="3"><?php echo $terms;?></textarea>
            </div>
          </div>
          <!-- /clearfix -->
          
          <div class="clearfix">
            <label for="textarea">Privacy</label>
            <div class="input">
              <textarea  rows="3" class="xxlarge" id="textarea3" name="privacy"/><?php echo $privacy;?></textarea>
            </div>
          </div>
          <!-- /clearfix -->

		  <div class="clearfix">
            <label for="textarea">Main Content</label>
            <div class="input">
              <textarea  rows="3" class="xxlarge" id="textarea4" name="content"/><?php echo $content;?></textarea>
            </div>
          </div>
          <!-- /clearfix -->

		  <div class="clearfix">
              <label for="xlInput">Expiry message:</label>
              <div class="input">
                <input name="custom_message"  class="two" type="text"  value="<?php echo $custom_message;?>" />
              </div>
            </div>
            <!-- /clearfix --> 

		<div class="clearfix">
              <label for="xlInput">Expiry link:</label>
              <div class="input">
                <input name="customlink"  class="two" type="text"  value="<?php echo $customlink;?>" />
              </div>
            </div>
            <!-- /clearfix --> 

		<div class="clearfix">
              <label for="xlInput">Expiry Link Title:</label>
              <div class="input">
                <input name="click_here_text"  class="two" type="text"  value="<?php echo $click_here_text;?>" />
              </div>
            </div>
            <!-- /clearfix -->
          
        </fieldset>
		<fieldset>
          <legend>Language Settings</legend>
          <label for="normalSelect">Localization:</label>
          <div class="input">
            <select  name="language" id="language">
              <option value="lang1" <?php if($language == "lang1"){echo "selected";}?>>Use built in language</option>
			  <option value="lang2" <?php if($language == "lang2"){echo "selected";}?>>Use custom language</option>
            </select>
          </div>
<div class="clearfix"></div>
          <!--this div is used for the aweber-->
		  <div id="langnone"></div>
		  <div id="lang1"></div>
          <div id="lang2">
		  <p style="margin-left:150px;">MENU TEXT</p>
            <div class="clearfix">
              <label for="xlInput">Invite Friends:</label>
              <div class="input">
                <input name="invite_friends" id="invite_friends" class="xlarge" type="text" value="<?php if($invite_friends ==''){echo 'Invite Friends';}else{echo $invite_friends;}?>" />
              </div>
            </div>
			<div class="clearfix">
              <label for="xlInput">Terms & Conditions:</label>
              <div class="input">
                <input name="terms_conditions" id="terms_conditions" class="xlarge" type="text" value="<?php if($terms_conditions ==''){echo 'Terms & Conditions';}else{echo $terms_conditions;}?>" />
              </div>
            </div>
			<div class="clearfix">
              <label for="xlInput">Privacy Policy:</label>
              <div class="input">
                <input name="privacy_policy" id="privacy_policy" class="xlarge" type="text" value="<?php if($privacy_policy ==''){echo 'Privacy Policy';}else{echo $privacy_policy;}?>" />
              </div>
            </div>
			 <p style="margin-left:150px;">OFFER BOX</p>
			 <div class="clearfix">
              <label for="xlInput">Buy Now:</label>
              <div class="input">
                <input name="buy_now_text" id="buy_now_text" class="xlarge" type="text" value="<?php if($buy_now_text ==''){echo 'BUY NOW';}else{echo $buy_now_text;}?>" />
              </div>
            </div>
            <div class="clearfix">
              <label for="xlInput">Price:</label>
              <div class="input">
                <input name="price_text" id="price_text" class="xlarge" type="text" value="<?php if($price_text ==''){echo 'Price:';}else{echo $price_text;}?>" />
              </div>
            </div>
			<div class="clearfix">
              <label for="xlInput">Normal Price:</label>
              <div class="input">
                <input name="normal_price_text" id="normal_price_text" class="xlarge" type="text" value="<?php if($normal_price_text ==''){echo 'NORMAL PRICE';}else{echo $normal_price_text;}?>" />
              </div>
            </div>
			<div class="clearfix">
              <label for="xlInput">Discount:</label>
              <div class="input">
                <input name="discount_text" id="discount_text" class="xlarge" type="text" value="<?php if($discount_text ==''){echo 'DISCOUNT';}else{echo $discount_text;}?>" />
              </div>
            </div>
			<div class="clearfix">
              <label for="xlInput">Offer Price:</label>
              <div class="input">
                <input name="offer_price_text" id="offer_price_text" class="xlarge" type="text" value="<?php if($offer_price_text ==''){echo 'OFFER PRICE';}else{echo $offer_price_text;}?>" />
              </div>
            </div>
			<div class="clearfix">
              <label for="xlInput">Days:</label>
              <div class="input">
                <input name="days_text" id="days_text" class="xlarge" type="text" value="<?php if($days_text ==''){echo 'Days';}else{echo $days_text;}?>" />
              </div>
            </div>
			<div class="clearfix">
              <label for="xlInput">Hours:</label>
              <div class="input">
                <input name="hours_text" id="hours_text" class="xlarge" type="text" value="<?php if($hours_text ==''){echo 'Hours';}else{echo $hours_text;}?>" />
              </div>
            </div>
			<div class="clearfix">
              <label for="xlInput">Minutes:</label>
              <div class="input">
                <input name="minutes_text" id="minutes_text" class="xlarge" type="text" value="<?php if($minutes_text ==''){echo 'Minutes';}else{echo $minutes_text;}?>" />
              </div>
            </div>
			<div class="clearfix">
              <label for="xlInput">Seconds:</label>
              <div class="input">
                <input name="seconds_text" id="seconds_text" class="xlarge" type="text" value="<?php if($seconds_text ==''){echo 'Seconds';}else{echo $seconds_text;}?>" />
              </div>
            </div>
		  </div>
		</fieldset>
        
        <!-- input hidden for getting the preivious images naame-->
        <input type="hidden" value="<?php echo $headerimage;?>"  name='image1'/>
        <input type="hidden" value="<?php echo $dealimage;?>"  name='image2'/>
        <input type="hidden" value="<?php echo $fangatedimage;?>"  name='image3'/>
        <input type="hidden" value="<?php echo $buttonimage;?>"  name='image4'/>
        <input type="hidden" value="<?php echo $wallimage;?>"  name='image5'/>
        <input type="hidden" value="<?php echo $backgroundimage;?>"  name='image6'/>
        <input type="submit" name="save" class="btn primary" value="Save changes">
      </div>
    </form>
  </div>
</div>
</div>

<script>
$ = jQuery;
$("#customlightcolor").blur(function () {
   refreshGradient();
});

$("#customdarkcolor").blur(function () {
   refreshGradient();
});

$("#textcollor").blur(function () {
   refreshCSS();
});

$("#buy_now_button_color").blur(function () {
   refreshCSS();
});

$("#buy_now_text_color").blur(function () {
   refreshCSS();
});

$("#pricetag_color").blur(function () {
   refreshCSS();
});


function refreshGradient() {
  var gradientBody = 'linear-gradient(top, ' + $("#customlightcolor").val() + ', ' + $("#customdarkcolor").val() + ')';
  $.each(['', '-o-', '-moz-', '-webkit-', '-ms-'], function() {
    $("#colorscheme_preview").css({ 'background-image': this + gradientBody });
  });
}

function refreshCSS() {

  		var preview_text = $('#textcollor').val();
		$(".preview_text").css("color", preview_text );
		$(".preview_text a").css("color", preview_text );

		var preview_buy_button = $('#buy_now_button_color').val();
		$(".preview_buy_button").css("background-color", preview_buy_button );

		var buy_now_text_color = $('#buy_now_text_color').val();
		$(".preview_buy_button a").css("color", buy_now_text_color );

		var pricetag_color = $('#pricetag_color').val();
		$(".preview_pricetag").css("color", pricetag_color );


 
}


$ = jQuery;
$(function() {
	$ = jQuery;
	aID = $('select[name=colorscheme]').val();
	changeArea(aID);
	$('select[name=colorscheme]').change(function() {
		changeArea($(this).val());
	});
	function changeArea(id) {
		function hideAll(e) { 
			$('#color1, #color2, #color3, #color4, #color5, #color6, #color7, #color8, #color9, #color10, #colorcustom, #colornone').hide(); 
			$('#'+e).show(); 
		}
		if(!id) hideAll('colornone');
		else hideAll(id);

	if (id === 'color1') {

		$('#customlightcolor').val('#e7205f');
		$('#customdarkcolor').val('#b80425');
		$('#textcollor').val('#000000');
		$('#buy_now_button_color').val('#000000');
		$('#buy_now_text_color').val('#dedede');
		$('#pricetag_color').val('#dedede');
		var preview_text = $('#textcollor').val();
		$(".preview_text").css("color", preview_text );
		$(".preview_text a").css("color", preview_text );
		var preview_buy_button = $('#buy_now_button_color').val();
		$(".preview_buy_button").css("background-color", preview_buy_button );
		var buy_now_text_color = $('#buy_now_text_color').val();
		$(".preview_buy_button a").css("color", buy_now_text_color );
		var pricetag_color = $('#pricetag_color').val();
		$(".preview_pricetag").css("color", pricetag_color );
    }

	if (id === 'color2') {
		$('#customlightcolor').val('#2fbef2');
		$('#customdarkcolor').val('#00aff0');
		$('#textcollor').val('#000000');
		$('#buy_now_button_color').val('#000000');
		$('#buy_now_text_color').val('#dedede');
		$('#pricetag_color').val('#dedede');
		var preview_text = $('#textcollor').val();
		$(".preview_text").css("color", preview_text );
		$(".preview_text a").css("color", preview_text );
		var preview_buy_button = $('#buy_now_button_color').val();
		$(".preview_buy_button").css("background-color", preview_buy_button );
		var buy_now_text_color = $('#buy_now_text_color').val();
		$(".preview_buy_button a").css("color", buy_now_text_color );
		var pricetag_color = $('#pricetag_color').val();
		$(".preview_pricetag").css("color", pricetag_color );
    }

	if (id === 'color3') {
		$('#customlightcolor').val('#87cb0f');
		$('#customdarkcolor').val('#46ba2f');
		$('#textcollor').val('#000000');
		$('#buy_now_button_color').val('#000000');
		$('#buy_now_text_color').val('#dedede');
		$('#pricetag_color').val('#dedede');
		var preview_text = $('#textcollor').val();
		$(".preview_text").css("color", preview_text );
		$(".preview_text a").css("color", preview_text );
		var preview_buy_button = $('#buy_now_button_color').val();
		$(".preview_buy_button").css("background-color", preview_buy_button );
		var buy_now_text_color = $('#buy_now_text_color').val();
		$(".preview_buy_button a").css("color", buy_now_text_color );
		var pricetag_color = $('#pricetag_color').val();
		$(".preview_pricetag").css("color", pricetag_color );
    }

	if (id === 'color4') {
		$('#customlightcolor').val('#838383');
		$('#customdarkcolor').val('#333333');
		$('#textcollor').val('#000000');
		$('#buy_now_button_color').val('#000000');
		$('#buy_now_text_color').val('#dedede');
		$('#pricetag_color').val('#dedede');
		var preview_text = $('#textcollor').val();
		$(".preview_text").css("color", preview_text );
		$(".preview_text a").css("color", preview_text );
		var preview_buy_button = $('#buy_now_button_color').val();
		$(".preview_buy_button").css("background-color", preview_buy_button );
		var buy_now_text_color = $('#buy_now_text_color').val();
		$(".preview_buy_button a").css("color", buy_now_text_color );
		var pricetag_color = $('#pricetag_color').val();
		$(".preview_pricetag").css("color", pricetag_color );
    }

	if (id === 'color5') {
		$('#customlightcolor').val('#fc893d');
		$('#customdarkcolor').val('#dc5600');
		$('#textcollor').val('#000000');
		$('#buy_now_button_color').val('#000000');
		$('#buy_now_text_color').val('#dedede');
		$('#pricetag_color').val('#dedede');
		var preview_text = $('#textcollor').val();
		$(".preview_text").css("color", preview_text );
		$(".preview_text a").css("color", preview_text );
		var preview_buy_button = $('#buy_now_button_color').val();
		$(".preview_buy_button").css("background-color", preview_buy_button );
		var buy_now_text_color = $('#buy_now_text_color').val();
		$(".preview_buy_button a").css("color", buy_now_text_color );
		var pricetag_color = $('#pricetag_color').val();
		$(".preview_pricetag").css("color", pricetag_color );
    }

	if (id === 'color6') {
		$('#customlightcolor').val('#8ca5c2');
		$('#customdarkcolor').val('#293b4f');
		$('#textcollor').val('#000000');
		$('#buy_now_button_color').val('#000000');
		$('#buy_now_text_color').val('#dedede');
		$('#pricetag_color').val('#dedede');
		var preview_text = $('#textcollor').val();
		$(".preview_text").css("color", preview_text );
		$(".preview_text a").css("color", preview_text );
		var preview_buy_button = $('#buy_now_button_color').val();
		$(".preview_buy_button").css("background-color", preview_buy_button );
		var buy_now_text_color = $('#buy_now_text_color').val();
		$(".preview_buy_button a").css("color", buy_now_text_color );
		var pricetag_color = $('#pricetag_color').val();
		$(".preview_pricetag").css("color", pricetag_color );
    }

	if (id === 'color7') {
		$('#customlightcolor').val('#3b5998');
		$('#customdarkcolor').val('#293E6A');
		$('#textcollor').val('#000000');
		$('#buy_now_button_color').val('#000000');
		$('#buy_now_text_color').val('#dedede');
		$('#pricetag_color').val('#dedede');
		var preview_text = $('#textcollor').val();
		$(".preview_text").css("color", preview_text );
		$(".preview_text a").css("color", preview_text );
		var preview_buy_button = $('#buy_now_button_color').val();
		$(".preview_buy_button").css("background-color", preview_buy_button );
		var buy_now_text_color = $('#buy_now_text_color').val();
		$(".preview_buy_button a").css("color", buy_now_text_color );
		var pricetag_color = $('#pricetag_color').val();
		$(".preview_pricetag").css("color", pricetag_color );
    }

	if (id === 'color8') {
		$('#customlightcolor').val('#d40909');
		$('#customdarkcolor').val('#8d0606');
		$('#textcollor').val('#000000');
		$('#buy_now_button_color').val('#000000');
		$('#buy_now_text_color').val('#dedede');
		$('#pricetag_color').val('#dedede');
		var preview_text = $('#textcollor').val();
		$(".preview_text").css("color", preview_text );
		$(".preview_text a").css("color", preview_text );
		var preview_buy_button = $('#buy_now_button_color').val();
		$(".preview_buy_button").css("background-color", preview_buy_button );
		var buy_now_text_color = $('#buy_now_text_color').val();
		$(".preview_buy_button a").css("color", buy_now_text_color );
		var pricetag_color = $('#pricetag_color').val();
		$(".preview_pricetag").css("color", pricetag_color );
    }

	if (id === 'color9') {
		$('#customlightcolor').val('#cb85ef');
		$('#customdarkcolor').val('#7728bd');
		$('#textcollor').val('#000000');
		$('#buy_now_button_color').val('#000000');
		$('#buy_now_text_color').val('#dedede');
		$('#pricetag_color').val('#dedede');
		var preview_text = $('#textcollor').val();
		$(".preview_text").css("color", preview_text );
		$(".preview_text a").css("color", preview_text );
		var preview_buy_button = $('#buy_now_button_color').val();
		$(".preview_buy_button").css("background-color", preview_buy_button );
		var buy_now_text_color = $('#buy_now_text_color').val();
		$(".preview_buy_button a").css("color", buy_now_text_color );
		var pricetag_color = $('#pricetag_color').val();
		$(".preview_pricetag").css("color", pricetag_color );
    }

	if (id === 'color10') {
		$('#customlightcolor').val('#00853e');
		$('#customdarkcolor').val('#00602D');
		$('#textcollor').val('#000000');
		$('#buy_now_button_color').val('#000000');
		$('#buy_now_text_color').val('#dedede');
		$('#pricetag_color').val('#dedede');
		var preview_text = $('#textcollor').val();
		$(".preview_text").css("color", preview_text );
		$(".preview_text a").css("color", preview_text );
		var preview_buy_button = $('#buy_now_button_color').val();
		$(".preview_buy_button").css("background-color", preview_buy_button );
		var buy_now_text_color = $('#buy_now_text_color').val();
		$(".preview_buy_button a").css("color", buy_now_text_color );
		var pricetag_color = $('#pricetag_color').val();
		$(".preview_pricetag").css("color", pricetag_color );
    }

	if (id === 'color11') {
		$('#customlightcolor').val('#ffe632');
		$('#customdarkcolor').val('#ffc218');
		$('#textcollor').val('#685b2e');
		$('#buy_now_button_color').val('#d12315');
		$('#buy_now_text_color').val('#ffffff');
		$('#pricetag_color').val('#d31010');
		var preview_text = $('#textcollor').val();
		$(".preview_text").css("color", preview_text );
		$(".preview_text a").css("color", preview_text );
		var preview_buy_button = $('#buy_now_button_color').val();
		$(".preview_buy_button").css("background-color", preview_buy_button );
		var buy_now_text_color = $('#buy_now_text_color').val();
		$(".preview_buy_button a").css("color", buy_now_text_color );
		var pricetag_color = $('#pricetag_color').val();
		$(".preview_pricetag").css("color", pricetag_color );
    }

	/*if (id === 'colorcustom') {
		$('#customlightcolor').val('');
		$('#customdarkcolor').val('');
    }*/
  refreshGradient();
	}
})	


		$(function(){
/*
    $('#customlightcolor').colorpicker().on('changeColor', function(refreshGradient){
    refreshGradient();
    });
*/
			$('#customlightcolor').colorpicker({
				format: 'hex'
			});

			$('#customdarkcolor').colorpicker({
				format: 'hex'
			});

			$('#textcollor').colorpicker({
				format: 'hex'
			});

			$('#buy_now_button_color').colorpicker({
				format: 'hex'
			});

			$('#buy_now_text_color').colorpicker({
				format: 'hex'
			});

			$('#pricetag_color').colorpicker({
				format: 'hex'
			});

		});

$ = jQuery;
$(function() {
	$ = jQuery;
	aID = $('select[name=language]').val();
	changeArea(aID);
	$('select[name=language]').change(function() {
		changeArea($(this).val());
	});
	function changeArea(id) {
		function hideAll(e) { 
			$('#lang1, #lang2, #langnone').hide(); 
			$('#'+e).show(); 
		}
		if(!id) hideAll('none');
		else hideAll(id);
		
	if (id === 'lang1') {
		$('#invite_friends').val('Invite Friends');
		$('#terms_conditions').val('Terms & Conditions');
		$('#privacy_policy').val('Privacy Policy');
		$('#price_text').val('Price:');
		$('#normal_price_text').val('NORMAL PRICE');
		$('#discount_text').val('DISCOUNT');
		$('#offer_price_text').val('OFFER PRICE');
		$('#days_text').val('Days');
		$('#hours_text').val('Hours');
		$('#minutes_text').val('Minutes');
		$('#seconds_text').val('Seconds');
		$('#buy_now_text').val('BUY NOW');
    }

	}
})	


tinyMCE.init({
		// General options
		force_p_newlines: false,
		mode : "exact",
		elements : "dealdescription",
		theme : "advanced",
		width : "300",
		plugins : "autolink,lists,spellchecker,pagebreak,style,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking",

        // Theme options
        theme_advanced_buttons1 : "fontselect,fontsizeselect,|,bold,italic,underline,|,link,unlink,anchor,image",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
//		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "js/tinymce/lists/template_list.js",
		external_link_list_url : "js/tinymce/lists/link_list.js",
		external_image_list_url : "js/tinymce/lists/image_list.js",
		media_external_list_url : "js/tinymce/lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});

	tinyMCE.init({
		// General options
		force_p_newlines: false,
		mode : "exact",
		elements : "terms",
		theme : "advanced",
		width : "300",
		plugins : "autolink,lists,spellchecker,pagebreak,style,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking",

        // Theme options
        theme_advanced_buttons1 : "fontselect,fontsizeselect,|,bold,italic,underline,|,link,unlink,anchor,image",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
//		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "js/tinymce/lists/template_list.js",
		external_link_list_url : "js/tinymce/lists/link_list.js",
		external_image_list_url : "js/tinymce/lists/image_list.js",
		media_external_list_url : "js/tinymce/lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});

	tinyMCE.init({
		// General options
		force_p_newlines: false,
		mode : "exact",
		elements : "privacy",
		theme : "advanced",
		width : "300",
		plugins : "autolink,lists,spellchecker,pagebreak,style,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking",

        // Theme options
        theme_advanced_buttons1 : "fontselect,fontsizeselect,|,bold,italic,underline,|,link,unlink,anchor,image",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
//		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "js/tinymce/lists/template_list.js",
		external_link_list_url : "js/tinymce/lists/link_list.js",
		external_image_list_url : "js/tinymce/lists/image_list.js",
		media_external_list_url : "js/tinymce/lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});

	tinyMCE.init({
		// General options
		force_p_newlines: false,
		mode : "exact",
		elements : "content",
		theme : "advanced",
		width : "300",
		plugins : "autolink,lists,spellchecker,pagebreak,style,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking",

        // Theme options
        theme_advanced_buttons1 : "fontselect,fontsizeselect,|,bold,italic,underline,|,link,unlink,anchor,image",
        theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,code,|,insertdate,inserttime,preview,|,media,advhr,|,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
//		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "js/tinymce/lists/template_list.js",
		external_link_list_url : "js/tinymce/lists/link_list.js",
		external_image_list_url : "js/tinymce/lists/image_list.js",
		media_external_list_url : "js/tinymce/lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});

$('input[name=dealimage]').change(function() {
	var texts = document.getElementById('dealimage').value;
	var re = /(?:\.([^.]+))?$/;
	var ext = re.exec(texts)[1];
		if (ext!='png'){if (ext!='PNG'){if (ext!='jpg'){if (ext!='JPG'){if (ext!='jpeg'){if (ext!='JPEG'){if (ext!='gif'){if (ext!='GIF'){if (ext!='bmp'){if (ext!='BMP'){
			alert("Wrong file type defined for Deal Image. Please use one of the following formats: PNG, JPG, JPEG, BMP, GIF");
			document.getElementById('dealimage').value='';
		}}}}}}}}}}
});

$('input[name=headerimage]').change(function() {
	var texts = document.getElementById('headerimage').value;
	var re = /(?:\.([^.]+))?$/;
	var ext = re.exec(texts)[1];
		if (ext!='png'){if (ext!='PNG'){if (ext!='jpg'){if (ext!='JPG'){if (ext!='jpeg'){if (ext!='JPEG'){if (ext!='gif'){if (ext!='GIF'){if (ext!='bmp'){if (ext!='BMP'){
			alert("Wrong file type defined for Header Image. Please use one of the following formats: PNG, JPG, JPEG, BMP, GIF");
			document.getElementById('headerimage').value='';
		}}}}}}}}}}
});

$('input[name=backgroundimage]').change(function() {
	var texts = document.getElementById('backgroundimage').value;
	var re = /(?:\.([^.]+))?$/;
	var ext = re.exec(texts)[1];
		if (ext!='png'){if (ext!='PNG'){if (ext!='jpg'){if (ext!='JPG'){if (ext!='jpeg'){if (ext!='JPEG'){if (ext!='gif'){if (ext!='GIF'){if (ext!='bmp'){if (ext!='BMP'){
			alert("Wrong file type defined for Background Image. Please use one of the following formats: PNG, JPG, JPEG, BMP, GIF");
			document.getElementById('backgroundimage').value='';
		}}}}}}}}}}
});

$('input[name=wallimage]').change(function() {
	var texts = document.getElementById('wallimage').value;
	var re = /(?:\.([^.]+))?$/;
	var ext = re.exec(texts)[1];
		if (ext!='png'){if (ext!='PNG'){if (ext!='jpg'){if (ext!='JPG'){if (ext!='jpeg'){if (ext!='JPEG'){if (ext!='gif'){if (ext!='GIF'){if (ext!='bmp'){if (ext!='BMP'){
			alert("Wrong file type defined for Wall Image. Please use one of the following formats: PNG, JPG, JPEG, BMP, GIF");
			document.getElementById('wallimage').value='';
		}}}}}}}}}}
});

$('input[name=fangatedimage]').change(function() {
	var texts = document.getElementById('fangatedimage').value;
	var re = /(?:\.([^.]+))?$/;
	var ext = re.exec(texts)[1];
		if (ext!='png'){if (ext!='PNG'){if (ext!='jpg'){if (ext!='JPG'){if (ext!='jpeg'){if (ext!='JPEG'){if (ext!='gif'){if (ext!='GIF'){if (ext!='bmp'){if (ext!='BMP'){
			alert("Wrong file type defined for Fangate Image. Please use one of the following formats: PNG, JPG, JPEG, BMP, GIF");
			document.getElementById('fangatedimage').value='';
		}}}}}}}}}}
});

	
</script>
</body>
</html>
