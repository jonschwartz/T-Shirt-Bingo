<?php

class Framer extends Controller {

	function Framer()
	{
		parent::Controller();	
	}
	
	function index()
	{
		redirect('/front/', 'refresh');
	}
	
	function get($shirt_id)
	{
		$this->load->model('shirt');
		$card_id = get_cookie('cardid');
		$header_data['card_id'] = $card_id;
		$shirt_data['shirt_url'] = $this->shirt->get_url($shirt_id);
		$shirt_data['other_shirts'] = $this->shirt->get_five_random_shirts();
		$this->load->view('header',$header_data);
		$this->load->view('frame',$shirt_data);
		$this->load->view('footer');
	}
}
?>