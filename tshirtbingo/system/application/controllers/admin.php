<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();	
	}

	function index()
	{
		$this->load->model('admin');
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin_login');
		}
		else
		{
			
			$this->load->view('admin');
		}
		
		$this->load->library('pagination');

		$config['base_url'] = 'http://example.com/index.php/test/page/';
		$config['total_rows'] = '200';
		$config['per_page'] = '20'; 

		$this->pagination->initialize($config); 

		echo $this->pagination->create_links();
	}
}
?>