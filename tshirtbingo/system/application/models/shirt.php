<?php
class Shirt extends Model {

    function Shirt()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	function included($url)
	{
		// true/false whether or not the shirt is already in the database
		
		$query = $this->db->get_where('shirts', array('url' => $url));
		if ($query->num_rows() > 0)
		{
			return true;
		}
		return false;
	}
	
	function insert($shirt_info)
	{
		// 	insert the shirt into the database, parameter is an 
		// array with each field mapped exactly as they are in 
		// the shirts table
		
		$this->db->insert('shirts', $shirt_info); 
	}
	
	function get_url($shirt_id)
	{
		$query = $this->db->get_where('shirts', array('shirt_id' => $shirt_id));
		foreach ($query->result() as $row)
		{
			return $row->url;
		}
	}
	
	function get_title($shirt_id)
	{
		$query = $this->db->get_where('shirts', array('shirt_id' => $shirt_id));
		foreach ($query->result() as $row)
		{
			return $row->title;
		}
	}
	
	function get_image($shirt_id)
	{
		$query = $this->db->get_where('shirts', array('shirt_id' => $shirt_id));
		foreach ($query->result() as $row)
		{
			return $row->image;
		}
	}
	
	function get_enabled($shirt_id)
	{
		$query = $this->db->get_where('shirts', array('shirt_id' => $shirt_id));
		foreach ($query->result() as $row)
		{
			return $row->enabled;
		}
	}
	
	function show_all_shirts()
	{
		$query = $this->db->get('shirts');
		
		$image_base_url = 'http://tshirtbingo.com/shirts/small/';
		
		$count = 0;
		
		$shirt_data = '';
		
		foreach ($query->result() as $row)
		{
			
/*			if ($count == 5)
			{
				$count = 0;
				$shirt_data .= '</tr>';
			}
			elseif ($count == 0)
			{
				$shirt_data .= '<tr>';
			}*/
			
			$shirt_data .= '<tr>';
			$shirt_data .= '<td><a name="'.$row->shirt_id.'"></a>';
			$shirt_data .= $row->shirt_id;
			$shirt_data .= '</td>';

			$shirt_data .= '<td>';
			$shirt_data .= $row->title;
			$shirt_data .= '</td>';

			$shirt_data .= '<td>';
			$shirt_data .= '<a href="'.$row->url.'" target="new">Click to open in a new window.</a>';
			$shirt_data .= '</td>';
			
			$shirt_data .= '<td>';
			$shirt_data .= '<a href="http://www.tshirtbingo.com/admin/toggle/'.$row->shirt_id.'"><img src="'.$image_base_url.$row->image.'" border=0/></a>';
			$shirt_data .= '</td>';
			
			$shirt_data .= '<td>';
			$shirt_data .= $row->company;
			$shirt_data .= '</td>';
			
			$shirt_data .= '<td>';
			$shirt_data .= '<input type="checkbox" value = "1" name="'.$row->shirt_id.'active" ';
			if ($row->enabled == 1)
			{
				$shirt_data .= 'checked ';
			}
			$shirt_data .= 'onChange ="jQuery.post(\'http://www.tshirtbingo.com/admin/shirt\', { shirtid: \''.$row->shirt_id.'\', enabled: '.$row->shirt_id.'active.value } );"/>';
			
			$shirt_data .= '<td>';
			$shirt_data .= '<input type="checkbox" value = "1" name="'.$row->shirt_id.'frame"';
			if ($row->frame == 1)
			{
				$shirt_data .= ' checked';
			}
			$shirt_data .= '/>';
			
			$shirt_data .= '</td>';
			$shirt_data .= '</tr>';
			//$count++;
		}
		
		return $shirt_data;
	}
	
	function saw($shirt_data)
	{
		$shirt_id = $shirt_data['shirt_id'];

		$this->db->select('ratio');
		$this->db->where('shirt_id =', $shirt_id);
		$query = $this->db->get('shirts');
		foreach ($query->result() as $row)
		{
			$ratio = $row->ratio;
			if ($ratio < 100)
			{
				$ratio = $ratio + 0.01;
			}
		}
		
		$shirt_update_data['ratio'] = $ratio;
		
		$this->db->where('shirt_id', $shirt_id);
		$this->db->update('shirts',$shirt_update_data);
	}
	
	function get_five_random_shirts()
	{
		$this->db->where('frame =', '0');
		$this->db->where('enabled =', '1');
		$this->db->limit(5);
		$this->db->order_by('shirt_id','random');
		$query = $this->db->get('shirts');
		
		$other_shirts = '<center><table class="card box_round box_shadow"><tr><td colspan = "5"><h3>Other Fine Shirts</h3><br/></td></tr><tr>';
		
		
		
		foreach ($query->result() as $row)
		{
			$other_shirts .= '<td><a href="'.$row->url.'" target= "new"><img src="http://www.tshirtbingo.com/shirts/small/'.$row->image.'" alt="'.$row->title.'" border=0 /></a></td>';
		}
		
		$other_shirts .= '</tr></table></center><br/><br/>';
		
		return ($other_shirts);
	}
	
	function toggle_frame($shirt_id)
	{
	}
	
	function toggle_active($shirt_id)
	{
		if ($this->get_enabled($shirt_id) == 0)
		{
			$this->db->where('shirt_id', $shirt_id);
			$shirt_data['enabled'] = 1;
			$this->db->update('shirts', $shirt_data);
		}
		else if ($this->get_enabled($shirt_id) == 1)
		{
			$this->db->where('shirt_id', $shirt_id);
			$shirt_data['enabled'] = 0;
			$this->db->update('shirts', $shirt_data);
		}
	}
	
	function get_tracking_cards($shirt_id)
	{
		$this->db->where('shirt_id', $shirt_id);
		$query = $this->db->get('tracking');
		foreach ($query->result() as $row)
		{
			return $row->card_ids;
		}
		return false;
	}
	
	function get_tracking_clicks($shirt_id)
	{
		$this->db->where('shirt_id', $shirt_id);
		$query = $this->db->get('tracking');
		foreach ($query->result() as $row)
		{
			return $row->clicks;
		}
		return false;
	}
	
	function tracking($shirt_id,$card_id)
	{
		$card_ids = $this->get_tracking_cards($shirt_id);
		if ($card_ids != false)
		{
			$clicks = $this->get_tracking_clicks($shirt_id) + 1;
			$this->db->where('shirt_id', $shirt_id);
			$card_ids .= $card_id.",";
			$tracking_data['card_ids'] = $card_ids;
			$tracking_data['clicks'] = $clicks;
			$this->db->update('tracking',$card_data);
		}
		else
		{
			$clicks = 1;
			$card_ids = $card_id.",";
			$tracking_data['shirt_id'] = $shirt_id;
			$tracking_data['card_ids'] = $card_ids;
			$tracking_data['clicks'] = $clicks;
			$this->db->insert('tracking',$tracking_data);
		}
	}
}
?>