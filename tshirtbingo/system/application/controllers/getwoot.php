<?php

class Getwoot extends Controller {

	function Getwoot()
	{
		parent::Controller();	
	}
	
	function index()
	{
	
		$shirt_collection_urls = array(
			'http://shirtwhat.com/archive_s.php'
		);
	
		$large_image_directory = '/home/jonandje/public_html/tshirtbingo/shirts/large/';
		$small_image_directory = '/home/jonandje/public_html/tshirtbingo/shirts/small/';
	
		foreach ($shirt_collection_urls as $shirt_collection_url)
		{
			$unisex_tshirts = file_get_contents($shirt_collection_url);

			//http://www.thinkgeek.com/images/products/front/tqualizer_anim.gif
			//http://www.thinkgeek.com/images/products/thumb/largesquare/tqualizer_anim.gif

			$product_block_split = explode('<tr><td align="center">',$unisex_tshirts);
			$product_block_rough = $product_block_split[1];

			$product_block_split = explode('<div id="pagenav-footer">',$product_block_rough);
			$product_block = $product_block_split[0];

			//$product_block = str_replace('/Content/Product/','http://www.jinx.com/Content/Product/',$product_block);
			
			//$product_block = str_replace('/tshirts-apparel/','http://www.thinkgeek.com/tshirts-apparel/',$product_block);

			//<a href="http://shirt.woot.com/Friends.aspx?k=9200" title="Rock Paper Scissors"><img height="95" width="125" src="http://sale.images.woot.com/Rock_Paper_Scissorshg9Thumbnail.png" alt="Rock Paper Scissors" border="0"></a> 
			
			
			$shirts = explode('<a href="', $product_block);

			array_shift($shirts);
			array_pop($shirts);
			
			foreach ($shirts as $shirt)
			{
				//$shirt_parts = explode('<a href="',$shirt);
				$url_and_img = explode('"><img height="95" width="125" src="',$shirt);
				
				$url_and_title = explode('" title="',$url_and_img[0]);
				
				$url = $url_and_title[0];
				$title = $url_and_title[1];
				
				$image_and_junk = explode('" alt="',$url_and_img[1]);
				
				$img = $image_and_junk[0];
				
				$url_parts = explode('/',$img);
				$image_name = end($url_parts);
				
				$image_name_parts = explode('Thumbnail',$image_name);
				
				$big_image = '';
				
				foreach ($url_parts as $part)
				{
					if ($part != $image_name)
					{
						$big_image .= $part.'/';
					}
				}
				
				//$big_image .= $image_name_parts[0].'Detail'.$image_name_parts[1];
				
				if ($this->shirt->included($url) == false)
				{				
					$small_shirt_image = file_get_contents($img);
					
					//$big_shirt_image = file_get_contents($big_image);
					
					file_put_contents($small_image_directory.$image_name,$small_shirt_image,FILE_BINARY);
					//file_put_contents($large_image_directory.$image_name,$big_shirt_image,FILE_BINARY);
					
					$shirt_info['url'] = $url;
					$shirt_info['title'] = $title;
					$shirt_info['image'] = $image_name;
					$shirt_info['ratio'] = 50;
					$shirt_info['company'] = 'woot';
					$shirt_info['enabled'] = true;
					$shirt_info['frame'] = true;
					
					$this->shirt->insert($shirt_info);
				}
			}
			//$this->load->view('header');
		}
	}
}
?>