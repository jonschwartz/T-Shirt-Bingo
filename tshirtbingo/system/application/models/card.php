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
		
		$shirts = array();
		
		if ($difficulty == 1)
		{
			$this->db->select('shirt_id');
			$this->db->where('ratio >', 65);
			$query = $this->db->get('shirts');
		
			foreach ($query->result() as $row)
			{
				array_push($shirts, $row->shirt_id);
				
				// Update, set shirt ratio down 1 if it would end up being > 0
				
			}
			shuffle($shirts);
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
			
			shuffle($shirts);
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
			
			shuffle($shirts);
			$rand_shirts = array_rand($shirts, 25);
		}
		
		$rand_shirts = array_rand($rand_shirts, 25);
		
		$shirt_string = $shirts[$rand_shirts[0]];
		array_shift($rand_shirts);
		
		foreach ($rand_shirts as $shirt)
		{
			
			$shirt_string .= ','.$shirts[$shirt];
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
		
		//$this->db->select('shirts','checked');
		$this->db->where('card_id', $card_id);
		$query = $this->db->get('cards');
		
		$col_count = 0;
		$row_count = 0;
		
		$checked = "";
		
		foreach ($query->result() as $row)
		{
			$shirts = $row->shirts;
			$checked = $row->checked;
			
			$shirt_ids = explode(',',$shirts);
			$checked_shirts = explode(',',$checked);
			
			
			for($count = 0; $count <= 24; $count++)
			{
				
				$shirt_id = $shirt_ids[$count];
				
				$shirt_detail_query = $this->db->get_where('shirts', array('shirt_id' => $shirt_id));
				
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
					$shirt_is_checked = 0;
					foreach ($checked_shirts as $checked_shirt)
					{
						if ($checked_shirt == $shirt_id)
						{
							$shirt_is_checked = 1;
						}
					}
					$card_data .='<td><center><div class="shirt';
					if ($shirt_is_checked == 1)
					{
						if ($big != "")
						{
							$card_data .= ' checked_div_big';
						}
						else
						{
							$card_data .= ' checked_div';
						}
					}
					$card_data .= '">';
					
					$card_data .= '<div class="inner_shirt';
					if ($shirt_is_checked == 1)
					{
						if ($big != "")
						{
							$card_data .= ' checked_inner_big';
						}
						else
						{
							$card_data .= ' checked_inner';
						}
					}
					$card_data .= '">';
					
					if ($shirt_is_checked == 1)
					{
						$card_data .= '<img src="http://www.tshirtbingo.com/checked.png" class ="checked" width="150" height="150"/>';
					}
					$card_data .='<a href="'.$url.'" target="_new"><img src="'.$image_url.'" border=0';
					if ($shirt_is_checked == 1)
					{
						$card_data .= ' class="checked_shirt" ';
					}
					$card_data .='/><br/>'.$title.'</a>';
					if ($shirt_is_checked == 0)
					{
						$card_data .='<br/><input type="button" value = "Saw it!" onClick="location.href=\'http://www.tshirtbingo.com/index.php/saw/by/'.$card_id.'/'.$shirt_id.'\'" class="noPrint"/>';
					}
					$card_data .='</center></div></div></td>'."\n";
				}
				if ($col_count < 4)
				{
					$card_data .= '<td><span style="border-right: solid 1px black; height:200px;"><br/><br/><br/><br/></span></td>'."\n";
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
		
		$card_data .= '</table>'."\n".'<br/>'."\n".'<span class="printOnly">Get back to this card: http://www.tshirtbingo.com/front/card/'.$card_id.'</span><table class="noPrint">'."\n".'<tr><td><a href="http://www.tshirtbingo.com/front/card/'.$card_id.'/big">Bigger Shirt Images</a></td><td>|</td><td><a href="http://www.tshirtbingo.com/front/easy">Easier Shirt Images</a></td><td>|</td><td><a href="http://www.tshirtbingo.com/front/medium">Medium Shirt Images</a></td><td>|</td><td><a href="http://www.tshirtbingo.com/front/hard">Harder Shirt Images</a></td><td>|</td><td><a href="http://www.tshirtbingo.com/front/card/'.$card_id.'/">Get this Card Again</a></td></tr>'."\n".'</table>'."\n".'<br/>'."\n".'<div class="card box_round box_shadow">'."\n".'<h3 align="left">Bonus Points</h3>'."\n".'<table cellpadding = 1>'."\n".'<tr><th></th><th>Guys</th><th>Girls</th><th></th></tr>'."\n".'<tr><td><input type="checkbox"/></td><td>That guy wearing the shirt from the show to the show.</td><td>That girl wearing the shirt from the show to the show.</td><td><input type="checkbox"/></td></tr>'."\n".'<tr><td><input type="checkbox"/></td><td>That guy wearing the shirt from the show which he just bought, and he\'s wearing it over the shirt he wore here.</td><td>That girl wearing the shirt from the show which she just bought, and she\'s wearing it over the shirt she wore here.</td><td><input type="checkbox"/></td></tr>'."\n".'<tr><td><input type="checkbox"/></td><td>That guy wearing the shirt from the show over the clothes he obviously wore to work that day.</td><td>That girl wearing the shirt from the show over the clothes she obviously wore to work that day.</td><td><input type="checkbox"/></td></tr>'."\n".'</table>'."\n".'</div>';
		return ($card_data);
	}
	
	function check($shirt_data)
	{
		// add card_id and shirt_id to saw table, allows it to be crossed off on board
		
		$query = $this->db->get_where('cards', array('card_id' => $shirt_data['card_id']));
		
		foreach ($query->result() as $row)
		{
			$checked = $row->checked;
		}
		
		if (($checked != "") and (isset($checked)))
		{
			$checked .= ','.$shirt_data['shirt_id'];
		}
		else
		{
			$checked .= $shirt_data['shirt_id'];
		}
		
		$shirt_update_data = array (
			'checked' => $checked
		);
		
		$this->db->where('card_id', $shirt_data['card_id']);
		$this->db->update('cards',$shirt_update_data);
	}
}
?>