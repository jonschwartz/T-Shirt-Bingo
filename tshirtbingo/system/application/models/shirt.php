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
		if ($this->db->count_all_results() >= 1)
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
}
?>