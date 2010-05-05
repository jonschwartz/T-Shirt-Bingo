<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();	
	}

	function index()
	{
		$this->load->model('admindata');
		
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
		
	}
}
?>