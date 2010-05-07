<?php

class Saw extends Controller {

	function Saw()
	{
		parent::Controller();	
	}

	function index()
	{
		//forward to main page
		redirect('/front/', 'refresh');
	}
	
	function by($card_id, $shirt_id)
	{
		$shirt_data['card_id'] = $card_id;
		$shirt_data['shirt_id'] = $shirt_id;
		$this->card->check($shirt_data);
		$this->shirt->saw($shirt_data);
		
		redirect('/front/card/'.$card_id.'/', 'refresh');
	}
	
	function checkbox($card_id,$checkbox)
	{
		$check_data['card_id'] = $card_id;
		$check_data['checkbox'] = $checkbox;
		
		$this->card->checkbox($check_data);
	}
}
?>