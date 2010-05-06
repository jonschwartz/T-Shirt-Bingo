<?php

class Framer extends Controller {

	function Framer()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->model('shirt');
		$card_id = get_cookie('cardid');
		$header_data['card_id'] = $card_id;
		$shirt_data['shirt_url'] = $this->shirt->get_url(120);
		$this->load->view('header',$header_data);
		$this->load->view('frame',$shirt_data);
		$this->load->view('footer');
	}
}
?>