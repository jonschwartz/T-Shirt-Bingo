<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();	
	}

	function index()
	{
		$this->load->model('admindata');
		$this->load->model('shirt');
		
		$this->load->helper(array('form', 'url'));		
		$this->load->library('validation');
		if (($_SERVER['REMOTE_ADDR'] == '76.118.63.23') or ($_SERVER['REMOTE_ADDR'] == '98.11.8.15.61'))
		{
		//if ($this->form_validation->run() == FALSE)
		//{
		//	$this->load->view('admin_login');
		//}
		//else
		//{
			$shirt_data['shirt_data'] = $this->shirt->show_all_shirts();
			$this->load->view('admin',$shirt_data);
		}
		
	}
	
	function new_admin()
	{
		if ($_SERVER['REMOTE_ADDR'] == '76.118.63.23')
		{
	
			$this->load->model('admindata');
			
			//$this->load->helper(array('form', 'url'));
			
			//$this->load->library('form_validation');
				
			//$this->form_validation->set_rules('username', 'username', 'required');
			//$this->form_validation->set_rules('password', 'password', 'required');			

			$this->load->view('admin');
			
			/*if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin_new');
			}
			else
			{
				$admin_data['username'] =  set_value('username');
				$admin_data['password'] = $this->encrypt->encode(set_value('password'));
				$admin_data['active'] = 1;
				
				$this->admindata->new_admin($admin_data);
				redirect('/admin/', 'refresh');
			}*/
		}
		else
		{
			redirect('/front/', 'refresh');
		}
		
	}
	
	function toggle($shirt_id)
	{
		$this->load->model('shirt');
		$this->shirt->toggle_active($shirt_id);
		redirect('/admin#'.$shirt_id, 'refresh');
		
	}
	
	function shirts()
	{
	}
}
?>