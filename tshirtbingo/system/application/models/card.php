<?php
class Card extends Model {

    function Card()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	function generate_card($difficulty)
	{
		// 1 = easy 2= medium 3=hard
		
		if ($difficulty == 1)
		{
			$this->db->select('shirt_id');
			$this->db->where('ratio >', 65);
			$query = $this->db->get('shirts');
		
			$shirts = array();
			foreach ($query->result() as $row)
			{
				array_push($shirts, $row->shirt_id);
			}
			
			$rand_shirts = array_rand($shirts, 25);
		}
		elseif ($difficulty == 2)
		{
			$this->db->select('shirt_id');
			$this->db->where('ratio <=', 65);
			$this->db->where('ratio >', 35);
			$query = $this->db->get('shirts');
		
			foreach ($query->result() as $row)
			{
				array_push($shirts, $row->shirt_id);
			}
			
			$rand_shirts = array_rand($shirts, 25);
		}
		elseif ($difficulty == 3)
		{
			$this->db->select('shirt_id');
			$this->db->where('ratio <=', 35);
			$query = $this->db->get('shirts');
		
			foreach ($query->result() as $row)
			{
				array_push($shirts, $row->shirt_id);
			}
			
			$rand_shirts = array_rand($shirts, 25);
		}
		
		$shirt_string = $rand_shirts[0];
		array_shift($rand_shirts);
		
		foreach ($rand_shirts as $shirt)
		{
			$shirt_string .= ','.$shirt;
		}
		
		$this->db->flush_cache();
		
		$card_data = array(
               'shirts' => $shirt_string
            );

		$this->db->insert('cards', $card_data); 
		
		$this->db->flush_cache();
		
		$this->db->select('card_id');
		$this->db->where('shirts', $shirt_string);
		$query = $this->db->get('cards');
		foreach ($query->result() as $row)
		{
			$card_id = $row->card_id;
		}
		return ($card_id);
	}
	
	function show_card($card_id,$big)
	{
		
		$card_data = '<table style="border:1px solid black;" class="card box_round box_shadow">'."\n".'<tr><th>S</th><th></th><th>H</th><th></th><th>I</th><th></th><th>R</th><th></th><th>T</th></tr>'."\n".'<tr><td colspan="9"><hr width="95%"/></td></tr>'."\n".'';
		
		if ($big != "")
		{
			$image_base_url = 'http://tshirtbingo.com/shirts/large/';
		}
		else
		{
			$image_base_url = 'http://tshirtbingo.com/shirts/small/';
		}
		
		$this->db->select('shirts');
		$this->db->where('card_id', $card_id);
		$query = $this->db->get('cards');
		
		$col_count = 0;
		$row_count = 0;
		
		foreach ($query->result() as $row)
		{
			$shirts = $row->shirts;
			
			$shirt_ids = explode(',',$shirts);
			
			$card_data .= $shirt_ids;
			
			for($count = 0; $count <= 24; $count++)
			{
				
				$shirt_id = $shirt_ids[$count];
				
				$shirt_detail_query = $this->db->get_where('shirts', array('shirt_id' => $shirt_id));
				$card_data .= 'shirt_id '.$shirt_id."\n";
				//$card_data .= var_dump($shirt_detail_query);
				foreach ($shirt_detail_query->result() as $shirt_detail_row)
				{
					$image_url = $image_base_url.$shirt_detail_row->image;
					$title = $shirt_detail_row->title;
					$url = $shirt_detail_row->url;
				}
				
				
				if ($col_count == 0)
				{
					$card_data .= '<tr>';
				}
				if (($row_count == 2) and ($col_count == 2))
				{
					$card_data .= '<td><center><h3>Your Shirt</h3></center></td>'."\n";
				}
				else
				{
					$card_data .='<td><center><a href="'.$url.'" target="_new"><img src="'.$image_url.'" border=0/><br/>'.$title.'</a></center></td>'."\n";
				}
				if ($col_count < 4)
				{
					$card_data .= '<td><span style="border-right: solid 1px black;"><br/><br/><br/><br/></span></td>'."\n";
				}
				if ($col_count == 4)
				{
					$card_data .= '</tr>';
					$col_count = 0;
					$row_count++;
				}
				else
				{
					$col_count++;
				}
			}
		}
		
		$card_data .= '</table>'."\n".'<br/>'."\n".'<table>'."\n".'<tr><td><a href="http://www.tshirtbingo.com/index.php/card/'.$card_id.'/big">Bigger Shirt Images</a></td><td>|</td><td><a href="http://www.tshirtbingo.com/index.php/easy">Easier Shirt Images</a></td><td>|</td><td><a href="http://www.tshirtbingo.com/index.php/medium">Medium Shirt Images</a></td><td>|</td><td><a href="http://www.tshirtbingo.com/index.php/medium">Harder Shirt Images</a></td></tr>'."\n".'</table>'."\n".'<br/>'."\n".'<div class="card box_round box_shadow">'."\n".'<h3 align="left">Bonus Points</h3>'."\n".'<table cellpadding = 1>'."\n".'<tr><th></th><th>Guys</th><th>Girls</th><th></th></tr>'."\n".'<tr><td><input type="checkbox"/></td><td>That guy wearing the shirt from the show to the show.</td><td>That girl wearing the shirt from the show to the show.</td><td><input type="checkbox"/></td></tr>'."\n".'<tr><td><input type="checkbox"/></td><td>That guy wearing the shirt from the show which he just bought, and he\'s wearing it over the shirt he wore here.</td><td>That girl wearing the shirt from the show which she just bought, and she\'s wearing it over the shirt she wore here.</td><td><input type="checkbox"/></td></tr>'."\n".'<tr><td><input type="checkbox"/></td><td>That guy wearing the shirt from the show over the clothes he obviously wore to work that day.</td><td>That girl wearing the shirt from the show over the clothes she obviously wore to work that day.</td><td><input type="checkbox"/></td></tr>'."\n".'</table>'."\n".'</div>';
		return ($card_data);
	}
}
?>