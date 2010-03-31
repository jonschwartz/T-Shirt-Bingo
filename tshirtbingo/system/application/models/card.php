<?php
class Card extends Model {

    function Card()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	function generate_card($difficulty)
	{
		// 1 = easy 2= medium 3=hard
		
		if ($difficulty == 1)
		{
			$this->db->select('shirt_id');
			$this->db->where('ratio >', 65);
			$query = $this->db->get('shirts');
		
			foreach ($query->result() as $row)
			{
				array_push($shirts, $row->shirt_id);
			}
			
			$rand_shirts = array_rand($shirts, 25);
		}
		elseif ($difficulty == 2)
		{
			$this->db->select('shirt_id');
			$this->db->where('ratio <=', 65);
			$this->db->where('ratio >', 35);
			$query = $this->db->get('shirts');
		
			foreach ($query->result() as $row)
			{
				array_push($shirts, $row->shirt_id);
			}
			
			$rand_shirts = array_rand($shirts, 25);
		}
		elseif ($difficulty == 3)
		{
			$this->db->select('shirt_id');
			$this->db->where('ratio <=', 35);
			$query = $this->db->get('shirts');
		
			foreach ($query->result() as $row)
			{
				array_push($shirts, $row->shirt_id);
			}
			
			$rand_shirts = array_rand($shirts, 25);
		}
		
		$this->db->flush_cache();
		
		$card_data = array(
               'shirts' => $rand_shirts
            );

		$this->db->insert('cards', $card_data); 
		
		$this->db->flush_cache();
		
		$this->db->select('card_id');
		$this->db->where('shirts', $rand_shirts);
		$query = $this->db->get('cards');
		foreach ($query->result() as $row)
		{
			$card_id = $row->card_id;
		}
		return ($card_id);
	}
	
	function show_card($card_id,$big)
	{
		if ($big != "")
		{
		}
		else
		{
		}
		return ($card_data);
	}
}
?>