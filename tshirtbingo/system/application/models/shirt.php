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
}
?>