<?php
// Grab images and links
//	by Jon Schwartz
//		3/29/2010

$unisex_tshirts = file_get_contents('http://www.thinkgeek.com/tshirts-apparel/unisex/feature/desc/0/all');

//http://www.thinkgeek.com/images/products/front/tqualizer_anim.gif
//http://www.thinkgeek.com/images/products/thumb/largesquare/tqualizer_anim.gif

$product_block_split = explode('<!-- BEGIN PRODUCTS -->	',$unisex_tshirts);
$product_block_rough = $product_block_split[1];

$product_block_split = explode('<!-- END PRODUCT GRID --> ',$product_block_rough);
$product_block = $product_block_split[0];

$url_parts = explode('/',$_SERVER['PHP_SELF']);

if (in_array('big',$url_parts))
{
$product_block = str_replace('/images/products/thumb/largesquare/','http://www.thinkgeek.com/images/products/front/',$product_block);
}
else
{
$product_block = str_replace('/images/products/thumb/largesquare/','http://www.thinkgeek.com/images/products/thumb/largesquare/',$product_block);
}

$product_block = str_replace('/tshirts-apparel/','http://www.thinkgeek.com/tshirts-apparel/',$product_block);

$shirts = explode('<div class="product">', $product_block);

array_shift($shirts);


?>
<html>
<head>
<title>T-Shirt Bingo</title>
<style type="text/css">
@page {
  size: Letter portrait;
}
</style>
<LINK href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<center>
<div class="header"><nobr><img src="shirt.png" alt="t-shirt bingo"/><br/><span>T-Shirt Bingo</span></nobr></div>
<br/>
<table style="border:1px solid black;" class="card box_round box_shadow">
<tr><th>S</th><th></th><th>H</th><th></th><th>I</th><th></th><th>R</th><th></th><th>T</th></tr>
<tr><td colspan="9"><hr width="95%"/></td></tr>
<?php

$col_count = 0;
$row_count = 0;

if (in_array('easy',$url_parts))
{
	$rand_shirts = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24);
}
else
{
	$rand_shirts = array_rand($shirts, 25);
}

for($count = 0; $count <= 24; $count++)
{
	$shirt_parts = explode('<a href="',$shirts[$rand_shirts[$count]]);
	$url_and_img = explode('"><img src="',$shirt_parts[1]);
	$url = 'http://www.kqzyfj.com/click-3879724-10356324?url='.urlencode($url_and_img[0].'?ref=c');
	$image_and_title = explode('"',$url_and_img[1]);
	$img = $image_and_title[0];
	$title = $image_and_title[4];
	if ($col_count == 0)
	{
		echo '<tr>';
	}
	if (($row_count == 2) and ($col_count == 2))
	{
	?>
	<td><center><h3>Your Shirt</h3></center></td>
	<?php
	}
	else
	{
	?>
	<td><center><a href="<?php echo $url;?>" target="_new"><img src="<?php echo $img;?>" border=0/><br/><?php echo $title;?></a></center></td>
	<?php
	}
	if ($col_count < 4)
	{
	?>
	<td><span style="border-right: solid 1px black;"><br/><br/><br/><br/></span></td>
	<?php
	}
	if ($col_count == 4)
	{
		echo '</tr>';
		$col_count = 0;
		$row_count++;
	}
	else
	{
		$col_count++;
	}
}
?>
</table>
<br/>
<table>
<tr><td><a href="http://www.tshirtbingo.com/index.php/big">Bigger Shirt Images</a></td><td>|</td><td><a href="http://www.tshirtbingo.com/index.php/easy">Easier Shirt Images</a></td><td>|</td><td><a href="http://www.tshirtbingo.com/index.php/big/easy">Bigger & Easier Shirt Images</a></td></tr>
</table>
<br/>
<div class="card box_round box_shadow">
<h3 align="left">Bonus Points</h3>
<table cellpadding = 1>
<tr><th></th><th>Guys</th><th>Girls</th><th></th></tr>
<tr><td><input type="checkbox"/></td><td>That guy wearing the shirt from the show to the show.</td><td>That girl wearing the shirt from the show to the show.</td><td><input type="checkbox"/></td></tr>
<tr><td><input type="checkbox"/></td><td>That guy wearing the shirt from the show which he just bought, and he's wearing it over the shirt he wore here.</td><td>That girl wearing the shirt from the show which she just bought, and she's wearing it over the shirt she wore here.</td><td><input type="checkbox"/></td></tr>
<tr><td><input type="checkbox"/></td><td>That guy wearing the shirt from the show over the clothes he obviously wore to work that day.</td><td>That girl wearing the shirt from the show over the clothes she obviously wore to work that day.</td><td><input type="checkbox"/></td></tr>
</table>
</div>
<hr width= "80%"/>
&copy; 2010 T-Shirt Bingo.  http://www.tshirtbingo.com  All rights reserved.  Shirt designs are &copy; their rights holders.  For more information, please see shirt site.
</center>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-15564171-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>