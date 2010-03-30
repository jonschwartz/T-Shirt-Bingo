<?php

class Getthinkgeek extends Controller {

	function Getthinkgeek()
	{
		parent::Controller();	
	}
	
	function index()
	{
	
		$large_image_directory = '/public_html/tshirtbingo/shirts/large/';
		$small_image_directory = '/public_html/tshirtbingo/shirts/small/';
	
		$unisex_tshirts = file_get_contents('http://www.thinkgeek.com/tshirts-apparel/unisex/feature/desc/0/all');

		//http://www.thinkgeek.com/images/products/front/tqualizer_anim.gif
		//http://www.thinkgeek.com/images/products/thumb/largesquare/tqualizer_anim.gif

		$product_block_split = explode('<!-- BEGIN PRODUCTS -->	',$unisex_tshirts);
		$product_block_rough = $product_block_split[1];

		$product_block_split = explode('<!-- END PRODUCT GRID --> ',$product_block_rough);
		$product_block = $product_block_split[0];

		$product_block = str_replace('/images/products/thumb/largesquare/','http://www.thinkgeek.com/images/products/thumb/largesquare/',$product_block);
		
		$product_block = str_replace('/tshirts-apparel/','http://www.thinkgeek.com/tshirts-apparel/',$product_block);

		$shirts = explode('<div class="product">', $product_block);

		array_shift($shirts);
		
		foreach ($shirts as $shirt)
		{
			$shirt_parts = explode('<a href="',$shirt);
			$url_and_img = explode('"><img src="',$shirt_parts[1]);
			$url = 'http://www.kqzyfj.com/click-3879724-10356324?url='.urlencode($url_and_img[0].'?ref=c');
			$image_and_title = explode('"',$url_and_img[1]);
			$img = $image_and_title[0];
			
			$url_parts = explode('/',$img);
			$image_name = $url_parts[-1];
			
			$title = $image_and_title[4];
			
			if ($this->shirt->included($url) == false)
			{				
				$small_shirt_image = file_get_contents($img);
				
				$big_image = $img;
				$big_image = str_replace('/images/products/thumb/largesquare/','/images/products/front/',$big_image);
				$big_shirt_image = file_get_contents($big_img);
				
				file_put_contents($small_image_directory.$image_name,$small_shirt_image);
				file_put_contents($large_image_directory.$image_name,$big_shirt_image);
				
				$shirt_info['url'] = $url;
				$shirt_info['title'] = $title;
				$shirt_info['image'] = $image_name;
				$shirt_info['ratio'] = 50;
				$shirt_info['company'] = 'thinkgeek';
				$shirt_info['enabled'] = true;
				
				$this->shirt->insert($shirt_info);
			}
		}
	}
}
?>