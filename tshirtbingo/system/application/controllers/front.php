<?php

class Front extends Controller {

	function Front()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('header');
		$card_id = $this->card->generate_card(1); // generates a random easy card
		$card_data['card_data'] = $this->card->show_card($card_id);
		$this->load->view('card', $card_data);
		$this->load->view('footer');
		//echo "hello";
	}
	/*
	function card($card_id,$big='')
	{
		$this->load->view('header');
		$card_data['card_data'] = $this->card->show_card($card_id,$big);
		$this->load->view('card', $card_data);
		$this->load->view('footer');
	}
	
	function easy($big='')
	{
		$this->load->view('header');
		$card_id = $this->card->generate_card(1); // generates a random easy card
		$card_data['card_data'] = $this->card->show_card($card_id,$big);
		$this->load->view('card', $card_data);
		$this->load->view('footer');
	}
	
	function medium($big='')
	{
		$this->load->view('header');
		$card_id = $this->card->generate_card(2); // generates a random medium card
		$card_data['card_data'] = $this->card->show_card($card_id,$big);
		$this->load->view('card', $card_data);
		$this->load->view('footer');
	}
	
	function hard($big='')
	{
		$this->load->view('header');
		$card_id = $this->card->generate_card(3); // generates a random hard card
		$card_data['card_data'] = $this->card->show_card($card_id,$big);
		$this->load->view('card', $card_data);
		$this->load->view('footer');
	}
	*/
}
?>