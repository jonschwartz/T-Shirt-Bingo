<?php

class Front extends Controller {

	function Front()
	{
		parent::Controller();	
	}
	
	function index()
	{	
		if (!(get_cookie('cardid')))
		{
			$difficulty = 1;
			$card_id = $this->card->generate_card($difficulty); // generates a random easy card
			
			$cookie = array(
					   'name'   => 'cardid',
					   'value'  => $card_id,
					   'expire' => '3888000',
				   );

			set_cookie($cookie);
			
			$card_data['card_data'] = $this->card->show_card($card_id,"");
			$header_data['card_id'] = $card_id;
			$this->load->view('header',$header_data);
			$this->load->view('card', $card_data);
			$this->load->view('footer');
		}
		else
		{
			redirect('/front/card/'.get_cookie('cardid'), 'refresh');
		}
		
	}
	
	function card($card_id,$big='')
	{
		$header_data['card_id'] = $card_id;
		$this->load->view('header',$header_data);
		$card_data['card_data'] = $this->card->show_card($card_id,$big);
		$this->load->view('card', $card_data);
		$this->load->view('footer');
	}
	
	function easy($big='')
	{
		$card_id = $this->card->generate_card(1); // generates a random easy card
		$header_data['card_id'] = $card_id;
		$this->load->view('header',$header_data);
		$card_data['card_data'] = $this->card->show_card($card_id,$big);
		$this->load->view('card', $card_data);
		$this->load->view('footer');
		
		$cookie = array(
					   'name'   => 'cardid',
					   'value'  => $card_id,
					   'expire' => '3888000',
				   );

		set_cookie($cookie);
	}
	
	function medium($big='')
	{
		$card_id = $this->card->generate_card(2); // generates a random medium card
		$header_data['card_id'] = $card_id;
		$this->load->view('header',$header_data);
		$card_data['card_data'] = $this->card->show_card($card_id,$big);
		$this->load->view('card', $card_data);
		$this->load->view('footer');
		
		$cookie = array(
					   'name'   => 'cardid',
					   'value'  => $card_id,
					   'expire' => '3888000',
				   );

		set_cookie($cookie);
	}
	
	function hard($big='')
	{
		$card_id = $this->card->generate_card(3); // generates a random hard card
		$header_data['card_id'] = $card_id;
		$this->load->view('header',$header_data);
		$card_data['card_data'] = $this->card->show_card($card_id,$big);
		$this->load->view('card', $card_data);
		$this->load->view('footer');
		
		$cookie = array(
					   'name'   => 'cardid',
					   'value'  => $card_id,
					   'expire' => '3888000',
				   );

		set_cookie($cookie);
	}
	
}
?>