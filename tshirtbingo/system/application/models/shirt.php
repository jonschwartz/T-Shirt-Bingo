<?php
class Shirt extends Model {

    function Shirt()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	function included($url)
	{
		return false;
	}
	
	function insert($shirt_info)
	{
	}
}
?>