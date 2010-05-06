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
		$query = $this->db->get_where('shirts', array('enabled' => 1));
		
		$shirt_data = "<table>";
		
		$count = 0;
		
		foreach ($query->result() as $row)
		{
			
			if ($count == 5)
			{
				$count = 0;
				$shirt_data .= '</tr>';
			}
			if ($count == 0)
			{
				$shirt_data .= '<tr>';
			}
			$shirt_data .= '<td>';
			
			$count++;
		}
		
		$shirt_data .= '</table>';
		
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
			$ratio++;
		}
		
		$shirt_update_data['ratio'] = $ratio;
		
		$this->db->where('shirt_id', $shirt_id);
		$this->db->update('shirts',$shirt_update_data);
	}
}
?>