<?php

class About extends Controller {

	function About()
	{
		parent::Controller();	
	}
	
	function index()
	{
		redirect('/about/thegame/', 'refresh');
	}
	
	function us()
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
			
			$header_data['card_id'] = $card_id;
			$this->load->view('header',$header_data);
			$this->load->view('about_us');
			$this->load->view('footer');
		}
		else
		{
			$header_data['card_id'] = get_cookie('cardid');
			$this->load->view('header',$header_data);
			$this->load->view('about_us');
			$this->load->view('footer');
		}
	}
	
	function thegame()
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
			
			$header_data['card_id'] = $card_id;
			$this->load->view('header',$header_data);
			$this->load->view('card', $card_data);
			$this->load->view('footer');
		}
		else
		{
			$header_data['card_id'] = get_cookie('cardid');
			$this->load->view('header',$header_data);
			$this->load->view('about_thegame');
			$this->load->view('footer');
		}
	}
}