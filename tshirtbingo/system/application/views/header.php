<?php header ('Cache-Control: max-age=1800, must-revalidate'); ?>

<html>
<head>

<META NAME="ROBOTS" CONTENT="ALL"> 
<META NAME="ROBOTS" CONTENT="INDEX,NOFOLLOW"> 
<META NAME="KEYWORDS" CONTENT="tshirt, bingo, t-shirt, t-shirt bingo, games, meatspace, geek">
<META NAME="DESCRIPTION" CONTENT="T-Shirt Bingo is a meatspace game that combines awesome t-shirts with bingo.  Play with friends, at concerts, at conventions, or anywhere geeks gather!">
<META NAME="COPYRIGHT" CONTENT="&copy; T-Shirt Bingo">
<META HTTP-EQUIV="CONTENT-LANGUAGE" CONTENT="en-US">
<META NAME="AUTHOR" CONTENT="T-Shirt Bingo">

<title>T-Shirt Bingo</title>

<LINK href="http://www.tshirtbingo.com/style.css" rel="stylesheet" type="text/css" media="screen">
<link href="http://www.tshirtbingo.com/print.css" rel="stylesheet" type="text/css" media="print"> 
<link rel="stylesheet" href="http://www.tshirtbingo.com/css/lightbox.css" type="text/css" media="screen" />

<script type="text/javascript" src="http://www.tshirtbingo.com/js/prototype.js"></script>
<script type="text/javascript" src="http://www.tshirtbingo.com/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="http://www.tshirtbingo.com/js/lightbox.js"></script>

</head>
<body>
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
				<a href="http://tshirtbingo.com/">Home</a> | About The Game | About Us | Contact Us | <a href="http://twitter.com/tshirtbingo" target="_new">Twitter</a> | <a href="http://zazzle.com/tshirtbingo" target="_new">Store</a>
			</td>
		</tr>
	</table>
	<table width = "800" class="printOnly">
		<tr class="printOnly">
			<td align="right" valign = "bottom" class="printOnly">
				<img src="http://www.racoindustries.com/barcodegenerator/2d/barcode-image.axd?S=QRCode&BM=0.12&C=<?php echo 'http://tshirtbingo.com/front/card/'.$card_id;?>&IFMT=Jpeg&QRE=Auto&QREC=H&QRV=Auto&QZ=0.12&TM=0.12&MS=0.03" width="50" height="50" align="right"/><br/>Get back to this card: <nobr>http://www.tshirtbingo.com/front/card/<?php echo $card_id;?></nobr>
			</td>
		</tr>
	</table>
</div>
<br/>