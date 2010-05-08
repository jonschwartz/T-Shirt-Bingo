<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();	
	}

	function index()
	{
		$this->load->model('admindata');
		
		$this->load->helper(array('form', 'url'));		
		$this->load->library('validation');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin_login');
		}
		else
		{
			$this->load->view('admin');
		}
		
	}
	
	function new_admin()
	{
	
		$this->load->model('admindata');
		
		$this->load->helper(array('form', 'url'));		
		$this->load->library('validation');
	
		if ($_SERVER['REMOTE_ADDR'] == '76.118.63.23')
		{			

			if (!(isset($_REQUEST['username'])))
			{
				$this->load->view('admin_new');
			}
			else
			{
				$admin_data['username'] = $_POST['username'];
				$admin_data['password'] = $this->encrypt->encode($_POST['password']);
				$admin_data['active'] = 1;
				
				$this->admindata->new_admin($admin_data);
				redirect('/admin/', 'refresh');
			}
		}
		else
		{
			redirect('/front/', 'refresh');
		}
	}
}
?>