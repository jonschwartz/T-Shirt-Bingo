<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();	
	}

	function index()
	{
		$this->load->library('pagination');

		$config['base_url'] = 'http://example.com/index.php/test/page/';
		$config['total_rows'] = '200';
		$config['per_page'] = '20'; 

		$this->pagination->initialize($config); 

		echo $this->pagination->create_links();
	}
}
?>