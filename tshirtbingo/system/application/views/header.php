<?php //header ('ExpiresDefault "access plus 30 days"'); ?>

<html>
<head>

<META NAME="ROBOTS" CONTENT="ALL"> 
<META NAME="ROBOTS" CONTENT="INDEX,FOLLOW"> 
<META NAME="KEYWORDS" CONTENT="tshirt, bingo, t-shirt, t-shirt bingo, games, meatspace, geek">
<META NAME="DESCRIPTION" CONTENT="T-Shirt Bingo is a meatspace game that combines awesome t-shirts with bingo.  Play with friends, at concerts, at conventions, or anywhere geeks gather!">
<META NAME="COPYRIGHT" CONTENT="&copy; T-Shirt Bingo">
<META HTTP-EQUIV="CONTENT-LANGUAGE" CONTENT="en-US">
<META NAME="AUTHOR" CONTENT="T-Shirt Bingo">

<link rel="shortcut icon" type="image/x-icon" href="http://www.tshirtbingo.com/favicon.ico" /> 
<link rel="icon" type="image/x-icon" href="http://www.tshirtbingo.com/favicon.ico" />

<title>T-Shirt Bingo</title>

<LINK href="http://www.tshirtbingo.com/style.css" rel="stylesheet" type="text/css" media="screen">
<link href="http://www.tshirtbingo.com/print.css" rel="stylesheet" type="text/css" media="print"> 
<link rel="stylesheet" href="http://www.tshirtbingo.com/css/lightbox.css" type="text/css" media="screen" />

<script src="http://www.tshirtbingo.com/js/jquery.js"></script>
<script>
     var $j = jQuery.noConflict();
     
     // Use jQuery via $j(...)
     $j(document).ready(function(){
       //$j("div").hide();
     });
     
     // Use Prototype with $(...), etc.
     $('someid').hide();
   </script>
</head>
<?php flush(); ?>
<body>
<script type="text/javascript" charset="utf-8">
  var is_ssl = ("https:" == document.location.protocol);
  var asset_host = is_ssl ? "https://s3.amazonaws.com/getsatisfaction.com/" : "http://s3.amazonaws.com/getsatisfaction.com/";
  document.write(unescape("%3Cscript src='" + asset_host + "javascripts/feedback-v2.js' type='text/javascript'%3E%3C/script%3E"));
</script>

<script type="text/javascript" charset="utf-8">
  var feedback_widget_options = {};

  feedback_widget_options.display = "overlay";  
  feedback_widget_options.company = "tshirt_bingo";
  feedback_widget_options.placement = "left";
  feedback_widget_options.color = "#222";
  feedback_widget_options.style = "idea";

  var feedback_widget = new GSFN.feedback_widget(feedback_widget_options);
</script>
<script type="text/javascript" charset="utf-8">
document.getElementById( 'fdbk_tab' ).setAttribute("class", "fdbk_tab_left noPrint"); //For Most Browsers
document.getElementById( 'fdbk_tab' ).setAttribute("className", "fdbk_tab_left noPrint");
</script>
<center>
<div class="header">
	<table width="800">
		<tr>
			<td width="100">
				<a href="http://www.zazzle.com/t_shirt_bingo_shirt-235897325349749482" target="_new">
					<img src="http://www.tshirtbingo.com/shirt.png" alt="t-shirt bingo click here to buy this shirt!" border=0 width="100" height="94"/>
				</a>
			</td>
			<td align="left">
				<span>T-Shirt Bingo</span>
			</td>
			<td align="right" valign="top" class="topnav noPrint">
				<a href="http://tshirtbingo.com/">Home</a> | <a href="http://www.tshirtbingo.com/front/easy">Get a New Card</a> | <a href="http://www.tshirtbingo.com/about/thegame">About The Game</a> | <a href="http://www.tshirtbingo.com/about/us">About Us</a> | <a href="http://twitter.com/tshirtbingo" target="_new">Twitter</a> | <a href="http://zazzle.com/tshirtbingo" target="_new">Store</a>
			</td>
		</tr>
	</table>
	<table width = "800" class="printOnly">
		<tr class="printOnly">
			<td align="right" valign = "bottom" class="printOnly">
				<img src="http://www.racoindustries.com/barcodegenerator/2d/barcode-image.axd?S=QRCode&BM=0.12&C=<?php echo 'http://tshirtbingo.com/front/card/'.$card_id;?>&IFMT=Jpeg&QRE=Auto&QREC=H&QRV=Auto&QZ=0.12&TM=0.12&MS=0.03" width="100" height="100" align="right"/><br/>Get back to this card: <nobr>http://www.tshirtbingo.com/front/card/<?php echo $card_id;?></nobr>
			</td>
		</tr>
	</table>
</div>
<br/>