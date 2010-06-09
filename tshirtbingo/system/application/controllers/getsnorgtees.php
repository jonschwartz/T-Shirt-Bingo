<?php

class Getsnorgtees extends Controller {

	function Getsnorgtees()
	{
		parent::Controller();	
	}
	
	function index()
	{
	
		$shirt_collection_urls = array(
			'http://www.snorgtees.com/index.php'
		);
	
		$large_image_directory = '/home/jonandje/public_html/tshirtbingo/shirts/large/';
		$small_image_directory = '/home/jonandje/public_html/tshirtbingo/shirts/small/';
	
		foreach ($shirt_collection_urls as $shirt_collection_url)
		{
			$unisex_tshirts = file_get_contents($shirt_collection_url);

			//http://www.thinkgeek.com/images/products/front/tqualizer_anim.gif
			//http://www.thinkgeek.com/images/products/thumb/largesquare/tqualizer_anim.gif

			$product_block_split = explode('<table border="0" width="100%" cellspacing="0" cellpadding="4" class="infoBoxContents">',$unisex_tshirts);
			$product_block_rough = $product_block_split[1];

			$product_block_split = explode('</table>',$product_block_rough);
			$product_block = $product_block_split[0];

			$product_block = str_replace('images/','http://www.snorgtees.com/images/',$product_block);

			$shirts = explode('<td align="center" class="smallText" width="25%" valign="top">', $product_block);

			array_shift($shirts);
			
			foreach ($shirts as $shirt)
			{
				$shirt_parts = explode('<a href="',$shirt);
				$url_and_img = explode('"><img src="',$shirt_parts[1]);
				$url = 'http://www.shareasale.com/r.cfm?u=429689&b=175316&m=5993&afftrack=&urllink='.urlencode($url_and_img[0].'?ref=c');
				$image_and_title = explode('"',$url_and_img[1]);
				$img = $image_and_title[0];
				
				$url_parts = explode('/',$img);
				$image_name = end($url_parts);
				
				$title = $image_and_title[4];
				
				if ($this->shirt->included($url) == false)
				{				
					$small_shirt_image = file_get_contents($img);
					
					$big_image = $img;
					$big_image = str_replace('/images/products/thumb/largesquare/','/images/products/front/',$big_image);
					$big_shirt_image = file_get_contents($big_image);
					
					file_put_contents($small_image_directory.$image_name,$small_shirt_image,FILE_BINARY);
					file_put_contents($large_image_directory.$image_name,$big_shirt_image,FILE_BINARY);
					
					$shirt_info['url'] = $url;
					$shirt_info['title'] = $title;
					$shirt_info['image'] = $image_name;
					$shirt_info['ratio'] = 50;
					$shirt_info['company'] = 'snorgtees';
					$shirt_info['enabled'] = true;
					
					$this->shirt->insert($shirt_info);
				}
			}
			//$this->load->view('header');
		}
	}
}
?>