<?php

class Getjinx extends Controller {

	function Getjinx()
	{
		parent::Controller();	
	}
	
	function index()
	{
	
		$shirt_collection_urls = array(
			'http://www.jinx.com/men?&data=%26ps%3d20%26pn%3d1%26sort%3dselling%26tcid%3d1&ps=all'
		);
	
		$large_image_directory = '/home/jonandje/public_html/tshirtbingo/shirts/large/';
		$small_image_directory = '/home/jonandje/public_html/tshirtbingo/shirts/small/';
	
		foreach ($shirt_collection_urls as $shirt_collection_url)
		{
			$unisex_tshirts = file_get_contents($shirt_collection_url);

			//http://www.thinkgeek.com/images/products/front/tqualizer_anim.gif
			//http://www.thinkgeek.com/images/products/thumb/largesquare/tqualizer_anim.gif

			$product_block_split = explode('<div class="listingProductGroup">',$unisex_tshirts);
			$product_block_rough = $product_block_split[1];

			$product_block_split = explode('<div id="pagenav-footer">',$product_block_rough);
			$product_block = $product_block_split[0];

			$product_block = str_replace('/Content/Product/','http://www.jinx.com/Content/Product/',$product_block);
			
			//$product_block = str_replace('/tshirts-apparel/','http://www.thinkgeek.com/tshirts-apparel/',$product_block);

			$shirts = explode('<div class="product', $product_block);

			array_shift($shirts);
			
			foreach ($shirts as $shirt)
			{
				$shirt_parts = explode('<a href="',$shirt);
				$url_and_img = explode('"><img src="',$shirt_parts[1]);
				$url = 'http://www.kqzyfj.com/click-3879724-10356324?url='.urlencode($url_and_img[0].'?ref=c');
				$image_and_title = explode('"',$url_and_img[1]);
				$img = $image_and_title[0];
				
				$url_parts = explode('/',$img);
				$image_name = end($url_parts);
				
				$image_name_parts = explode('_',$image_name);
				
				$big_image = $image_name_parts[0].'_'.$image_name_parts[1];
				
				if (stristr($image_name,'ZoomM')!=false)
				{
					$big_image .= '_ZoomB.jpg';
				}
				else
				{
					$big_image .= '_1B.jpg';
				}
				
				$title = $image_and_title[3];
				
				if ($this->shirt->included($url) == false)
				{				
					$small_shirt_image = file_get_contents($img);
					
					$big_shirt_image = file_get_contents($big_image);
					
					file_put_contents($small_image_directory.$image_name,$small_shirt_image,FILE_BINARY);
					file_put_contents($large_image_directory.$image_name,$big_shirt_image,FILE_BINARY);
					
					$shirt_info['url'] = $url;
					$shirt_info['title'] = $title;
					$shirt_info['image'] = $image_name;
					$shirt_info['ratio'] = 50;
					$shirt_info['company'] = 'jinx';
					$shirt_info['enabled'] = true;
					
					$this->shirt->insert($shirt_info);
				}
			}
			//$this->load->view('header');
		}
	}
}
?>