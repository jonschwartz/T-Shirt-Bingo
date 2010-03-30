<?php

class Front extends Controller {

	function Front()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('header');
		$this->load->view('card');
		$this->load->view('footer');
	}
	
	function card($card_id)
	{
	}
}
?>