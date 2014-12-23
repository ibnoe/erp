<?php
class Mod_common extends CI_Model {

	
	function get_party()
	{
		
		$party_name = trim($this->input->post('search'));

		$this->db->select('party_id,party_name');
	    $this->db->from('cane_party');
	    $this->db->like('party_name', $party_name, 'after');	   
	    $query = $this->db->get();
	
		$office_array = array();
		foreach ($query->result() as $row) 
		{
			$office_array['id'] = $row->party_id;
	    	$office_array['label'] = $row->party_name;    	
		}	
	    return $office_array;	
	}
	
	function check_if_party_exists(){
	
		$id=$this->input->post('party_id');
		
		 $sql = "SELECT party_name FROM cane_party WHERE party_id  = ?" ;
         $getData = $this->db->query($sql,array( $id  ));
		                                 
			if ($getData->num_rows() > 0)
			{ 
				return true;
			} 
			else 
			{ 
				echo false; 
			} 	 
	}
	
	

}
