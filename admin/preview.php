<?php
//connect to the datbase
require_once ('config.php');
$id = $_REQUEST['id'];
$db = mysql_connect($hostname, $hostacessname, $hostpassword);
mysql_select_db($databasename, $db) or die(mysql_error());
$selectquery = 'select * from deals where appid="' . $id . '"';
$selectexe = mysql_query($selectquery) or die(mysql_error());
//get the content of the deal
while ($row = mysql_fetch_array($selectexe))
{
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
  $layouttype = $row['layouttype'];
  $dealdescription = $row['dealdescription'];
//this for the getting the month date and year seprately
  //this for the getting the month date and year seprately
  $dateresulttime = explode(" ", $date);
  $dateresult = explode("-", $dateresulttime[0] );
  $month = $dateresult[1];
  $day = $dateresult[0];
  $year = $dateresult[2];
  $timeresult = explode(":", $dateresulttime[1] );
  $hour=$timeresult[0];
  $minute=$timeresult[1];
  $second=$timeresult[2];
  $contentheadline=$row['contentheadline'];

}
if ($layouttype == 'Yes')
{
$headerimages = './images/headerimage/' . $headerimage;
  $dealbuttons = './images/buttonimage/' . $buttonimage;
    $backgroundimages = '../themes/' . $style . '/images/x_01.png';
  $css = '../themes/' . $style . '/style.css';
}
else
{
  $headerimages = './images/headerimage/' . $headerimage;
  $dealbuttons = './images/buttonimage/' . $buttonimage;
  $backgroundimages = '../themes/' . $style . '/images/x_01.png';
  $css = '../themes/' . $style . '/style.css';
}
mysql_close();
?>


<html>
<head>
<title>Deal Site</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel = "stylesheet" type="text/css" href="<?php echo $css;?>" >
<link rel = "stylesheet" type="text/css" href="css/header.css" >
<script>

//define the date variable of date on which date you want to start count down
// var iid='count3';
  var yr='<?php print_r($year);?>';
      var m ='<?php print_r($month);?>';
      var d='<?php print_r($day);?>';

      var min='<?php print_r($minute); ?>';
      var sec='<?php print_r($second); ?>';
      var hr='<?php print_r($hour); ?>';
dateFuture1 = new Date(yr,(m-1),d,hr,min,sec);
//nothing beyond this point
function GetCount(ddate,iid){
     var current="Deal Has Been Expired";
	dateNow = new Date();	//grab current date
	amount = ddate.getTime() - dateNow.getTime();	//calc milliseconds between dates
	delete dateNow;

	// if time is already past
	if(amount < 0){
document.getElementById(iid).innerHTML=current;

document.getElementById('light3').style.display='block';document.getElementById('fade3').style.display='block';

	}
	// else date is still good
	else{
		years=0;days=0;hours=0;mins=0;secs=0;out="";

		amount = Math.floor(amount/1000);//kill the "milliseconds" so just secs

		years=Math.floor(amount/31536000);//years (no leapyear support)
		amount=amount%31536000;

		days=Math.floor(amount/86400);//days
		amount=amount%86400;

		hours=Math.floor(amount/3600);//hours
		amount=amount%3600;

		mins=Math.floor(amount/60);//minutes
		amount=amount%60;

		secs=Math.floor(amount);//seconds

		if(years != 0){out += years +" "+((years==1)?"year":"years")+", ";}
		if(days != 0){out += days +" "+((days==1)?"day":"days")+", ";}
		if(hours != 0){out += hours +" "+((hours==1)?"hour":"hours")+", ";}
		out += mins +" "+((mins==1)?"min":"mins")+", ";
		out += secs +" "+((secs==1)?"sec":"secs")+", ";
		out = out.substr(0,out.length-2);
		document.getElementById(iid).innerHTML=out;
        	setTimeout(function(){GetCount(ddate,iid)}, 1000);
	}
}

</script>
   	<style>
		.black_overlay{
			display: none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
			background-color: black;
			z-index:1001;
			-moz-opacity: 0.8;
			opacity:.80;
			filter: alpha(opacity=80);
		}
        .deal_overlay{
			display: none;
			position: absolute;
			top: 36%;
			left: 42%;
			width: 421px;
			height: 420px;
			background-color: black;
			z-index:1001;
			-moz-opacity: 0.8;
			opacity:.80;
			filter: alpha(opacity=75);
		}
		.white_content {
			display: none;
			position: absolute;
			top: 15%;
			left: 15%;
			width: 70%;
			height: auto;
			padding: 16px;
            background-color: white;
			z-index:1002;
			overflow: auto;
            background-color: #DCDCDC;
		}


        	.deal_content {
			display: none;
			position: absolute;
			top: 49%;
			left: 45%;
			width: 40%;
			height: auto;
			padding: 16px;
            background-color: white;
			z-index:1002;
			overflow: auto;
            background-color: #DCDCDC;
		}
	</style>


</head>

<body bgcolor=#ffffff leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
 <a href="viewdeal.php" style="text-decoration:none"><span style="background-color:#DFDFDF; color:#444; border:solid 1px #666; border-radius:5px; -moz-border-radius:5px;webkit-border-radius:5px;  padding:10px; margin-top:20px;float:left; ">Back</span></a>
	<div style="background:url(<?php echo $backgroundimages;?>) top repeat-x;">
<div style="background:url(images/p_13.jpg) bottom repeat-x;">

<center>

<table border="0" cellpadding="0" cellspacing="0" width=757>
	<tr>
		<td><img src="<?php echo $headerimages;?>" width='757' height='186' alt=""></td>
	</tr>
	<tr>
		<td background="images/x_04.png" width=757 height=51>

			<table border=0>
				<tr>
					<td width=400>

			<div class=menu-top><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'" style="display:none;">details</a>       <a href="">buy now</a>       <a href="">invite friends</a></div>

					</td>
					<td width=320 align=right>

			<div class=menu-top2><a href="" style="display: none;">How It Works</a>     <a href="" style="display:none;">About Us</a>
            <a href = "javascript:void(0)" onclick = "document.getElementById('light5').style.display='block';document.getElementById('fade5').style.display='block'">Terms and conditions</a>
               <a href = "javascript:void(0)" onclick = "document.getElementById('light1').style.display='block';document.getElementById('fade1').style.display='block'">Privacy Policy</a></div>

					</td>
				</tr>
			</table>

		</td>
	</tr>
	<tr>
	  <td>


<div style="padding:0px 4px; padding-top:0px; ">

<div class=headline><?php echo $dealtitle;?></div>


<center>
	<table style="margin:4px;margin-top:15px;">
		<tr>
			<td valign=top><img src="./images/dealimage/<?php echo $dealimage;?>" width='275' height='276'></td>
			<td width=20></td>
			<td valign=top>
		 <center>
		 <table border=0 cellspacing=0 cellpadding=0 width=419>
		 <tr>
		 <td background="images/x_10.png" width=250 height=52>
		 <div style="font-size:17px;font-family:arial;color:#7c7c7c;font-weight:Bold;padding-left:20px;">Price: <span style="color:#d31010;">$<?php echo $ourprice;?></span></div>

		 </td>
		 <td><a href="buynow"><img src="<?php echo $dealbuttons;?>" width='169' height='52' border=0></a></td>
		 </tr>
		 <tr>
		 <td colspan=2 background="images/x_12.png" width=419 valign=top>
		 <div class=head44><?php echo $contentheadline;?></div>
		 <div class=head43><?php echo $dealdescription;?></div>
				</td>
						</tr>
						<tr>
							<td background="images/x_15.png" width=419 height=50 colspan=2>
								<center>
									<table width=319 cellspacing=0 cellpadding=0 border=0>
										<tr>
											<td width=100>
											<div class=value>Normal Price</div>
<div class=price>$<?php echo $realprice;?></div>
											</td>

											<td width=100>
											<div class=value>Discount</div>
<div class=price>$<?php echo $realprice - $ourprice;?></div>
											</td>

											<td width=100>
											<div class=value>Offer Price</div>
<div class=price>$<?php echo $ourprice;?></div>
											</td>
										</tr>
									</table>
								</center>
							</td>
						</tr>

						<tr>
							<td colspan=2 align=center background="images/x_12.png" width=419><div class=gone>5 bought, Deal is on!</div></td>
						</tr>
						<tr>
							<td colspan=2 background="images/x_17.png" width=419 height=69>

<div class=left>Time left to buy:</div>
<div class=left2 id='count3'></div>


							</td>
						</tr>
					</table>
				</center>
			</td>
		</tr>
	</table>
</center>


<BR><BR><BR>

<div style="padding-left:160px; display: none;">
<div  class=footer>

	<a href="#">Contact</a> - <a href="#">Privacy Policy</a> - <a href="#">Terms Of Use</a> - <a href="#">Earnings Disclaimer</a> - <a href="#">Affiliates</a>
<BR><BR>
Copyright 2012, DealSite.com. All Rights Reserved.

</div>

  </div>
 </div>
 </div>
<div id="light3" class="deal_content">
 <br /><br />“Sorry! Looks like this deal has expired. You can still pick it up here:<a href='#'> BUY BUTTON</a>”  <br /><br /> </div>
 <div id="light" class="white_content">
 <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'" style='float:right;'>Close</a>
 <br /><br /><?php echo $dealdescription; ?> </div>
<!-- div for  the deal policy-->
 <div id="fade1" class="black_overlay"></div>
 <div id="fade" class="black_overlay"></div>

 <div id="light1" class="white_content">
  <a href = "javascript:void(0)" onclick = "document.getElementById('light1').style.display='none';document.getElementById('fade1').style.display='none'" style='float:right;'>Close</a>
 <br /><br /><?php echo $privacy; ?>
</div>
 <div id="fade5" class="black_overlay"></div>
<div id="light5" class="white_content">
  <a href = "javascript:void(0)" onclick = "document.getElementById('light5').style.display='none';document.getElementById('fade5').style.display='none'" style='float:right;'>Close</a>
 <br /><br /><?php echo $terms; ?>
</div>

<!-- div for  the deal terms-->
 <div id="fade2" class="black_overlay"></div>
 <div id="light2" class="white_content"><a href = "javascript:void(0)" style='float:right;' onclick = "document.getElementById('light2').style.display='none';document.getElementById('fade2').style.display='none'">Close</a><br /><br /><?php echo $terms; ?> </div>
</div>
</td>
	</tr>

</table>


</div>
<script>


     window.onload=function(){
       GetCount(dateFuture1, 'count3');
};

</script>




</body>
</html>