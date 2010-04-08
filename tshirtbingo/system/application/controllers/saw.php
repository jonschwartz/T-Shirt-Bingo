<?php

class Saw extends Controller {

	function Saw()
	{
		parent::Controller();	
	}

	function index()
	{
		//forward to main page
	}
	
	function by($card_id, $shirt_id)
	{
		$shirt_data['card_id'] = $card_id;
		$shirt_data['shirt_id'] = $shirt_id;
		$this->card->check($shirt_data);
	}
}
?>