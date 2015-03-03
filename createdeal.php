<?php
ob_start();
session_start();
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
if (isset ($_REQUEST['id']))
{
  $validation = "";
  $containerstyle = "container1";
//action to be performed
  $action = "updateinfo.php?id=" . $_REQUEST['id'];
  $imagestyle = "";
  $id = $_REQUEST['id'];
//to select the data from data base call get function and where for the id condition
$selectquery = 'select * from deals where id="' . $id . '"';
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
  $buttonimage = $row['buttonimage'];
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
  $themename=$style;
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
<script src="http://code.jquery.com/jquery-latest.min.js "></script>
<script src="js/bootstrap-dropdown.js"></script>
<script language="JavaScript" src="js/ts_picker.js">
//Script by Denis Gritcyuk: tspicker@yahoo.com
</script>
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
<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
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
              <input type="text" name="realprice" id="realprice" class="small validate[required,custom[integer]]" value="<?php echo $realprice;?>" />
            </div>
          </div>
          <!-- /clearfix -->
          <div class="clearfix">
            <label for="xlInput">Discount Price</label>
            <div class="input">
              <input type="text" name="ourprice" id="ourprice" class="small validate[required,custom[integer]]" value="<?php echo $ourprice;?>" />
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
              <input name="date" readonly class="xlarge" type="text" id="txtdate" onclick="show_calendar('document.create.date', document.create.date.value);" value="<?php echo $date;?>" /><br>
              <?php echo "(System time: ".date("j-n-Y H:i:s", mktime(date("H"), date("i"), date("s"), date("n"), date("j"), date("Y"))).")";?>
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
              <label for="normalSelect">Choose layout theme:</label>
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
          
          <!--Buy button image-->
          <div class="clearfix">
            <label for="fileInput">Buy Button Image</label>
            <div class="input">
              <input name="buttonimage" id="buttonimage" accept="image/x-png, image/gif, image/jpeg"   class="input-file" type="file"  />
            </div>
            <div class="clearfix" style="<?php echo $imagestyle;?>">
              <label for="fileInput">Current Image</label>
              <div class="input"> <img src="images/buttonimage/<?php echo $buttonimage;?>" width="100"> </div>
            </div>
            <!-- /clearfix --> 
          </div>
          <!-- /clearfix -->
          <div class="fld1" style='display:none'>
            <div class="fld1txt">Button Text</div>
            <div class="fld1container">
              <input name="dealbuttontext"  class="two" type="text"  value="<?php print_r($results[0]['dealbuttontext']);?>" />
            </div>
          </div>
          <div class="fld1"  style='display:none;'>
            <div class="fld1txt">Background Image</div>
            <div class="fld1container">
              <input name="backgroundimage" id="backgroundimage" accept="image/x-png, image/gif, image/jpeg"   class="two" type="file"  />
            </div>
            <div class="fld1" style="<?php echo $imagestyle;?>">
              <div class="fld1txt"></div>
              <div class="fld1container" id="preview1"><img src="images/backgroundimage/<?php echo $backgroundimage;?>" width="100" height="100"></div>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend>Facebook Settings</legend>
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
                <textarea  rows="3" class="xxlarge" id="textarea2" name="wallmessage"/>
                <?php echo $wallmessage;?>
                </textarea>
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
            <select  name="autorespondertype" id="autorespondertype" class="validate[required]" onchange="showappid('type');" >
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
          <div  id="mailchimpstyle"  style="<?php echo $mailchimpstyle;?>">
            <div class="clearfix">
              <label for="xlInput">Mailchimp List:</label>
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
            <label for="textarea">Terms</label>
            <div class="input">
              <textarea class="xxlarge" id="textarea2" name="terms" rows="3"><?php echo $terms;?></textarea>
            </div>
          </div>
          <!-- /clearfix -->
          
          <div class="clearfix">
            <label for="textarea">Privacy</label>
            <div class="input">
              <textarea  rows="3" class="xxlarge" id="textarea2" name="privacy"/>
              <?php echo $privacy;?>
              </textarea>
            </div>
          </div>
          <!-- /clearfix -->
          
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
</body>
</html>
