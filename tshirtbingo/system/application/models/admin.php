<?php
class Admin extends Model {

    function Admin()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	function new_admin($admin_data)
	{
		$this->db->insert('admins', $admin_data);
	}
	
	function validate($admin_data)
	{
		$this->db->select('admins');
		$this->db->where($admin_data);
		$this->db->where('active =', 1);
		
		$query = $this->db->get();
		
		foreach ($query->result() as $row)
		{
			return true;
		}
		return false;
	}
}
?>