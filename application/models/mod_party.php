<?php
class Mod_party extends CI_Model {
	

function add(){
		
	$party_name=trim($this->input->post('party_name'));
	$party_contact=trim($this->input->post('party_contact'));
	$begining_bal=trim($this->input->post('begining_bal'));
	$op_date=date("Y-m-d", strtotime(trim($this->input->post('op_date'))));
	
		
		
	if(!empty($party_name)){
		
		$query = $this->db->query("SELECT party_id FROM cane_party WHERE party_name='$party_name'");
	                                  
		if ($query->num_rows() > 0){
		
					return "2";
					
		} else	{
						$data = array(
									'party_id' => '',
									'party_name' => $party_name,
								 	'party_contact' => $party_contact,
									
						);
						
						$this->db->insert('cane_party', $data); 
								
								
					$autovalue=mysql_insert_id();// last auto incremented id

					
								$data = array(
									'id' => '',
									'account_name ' => $party_name,
									'op_balance' => $begining_bal,
								 	'op_balance_dc' => 'D',
									'op_date' => $op_date,
									'parent_id' => $autovalue,
									'acc_type' => '3' //Party account
								);
								$this->db->insert('cane_accounts', $data);
								
													
													
						if($query) {return "1";}
						
					
				}	
		
		}//if not empty
			
}//function ends
	
	
	
function party_list() { 
			
	$query = $this->db->query("SELECT * FROM cane_party");

		if($query->num_rows() > 0) 
		return $query->result_array();
		else
		return null;
			
}			
			
	
function grab_party_info($party_id) { 
			
		$this->db->select('*');
		$this->db->from('cane_party');
		$this->db->where('party_id',$party_id);
			
		$getData = $this->db->get('');
		if($getData->num_rows() > 0)
		return $getData->result_array();
		else
		return null;
}
	//End 
	
		
function party_updated(){
	
	$party_name=trim($this->input->post('party_name'));
	$party_id=trim($this->input->post('party_id'));
	$party_contact=trim($this->input->post('party_contact'));
			
		if(!empty($party_name)){
		
		$query = $this->db->query("SELECT party_id FROM cane_party WHERE party_name='$party_name' AND party_id!='$party_id' ");
                                  
		if ($query->num_rows() > 0){

			return "2";
			
		} else	{
												
				
				$data = array(
					
				 	'party_name' => $party_name,
					'party_contact' => $party_contact,
								   
				);
				$this->db->where('party_id', $party_id);
				$this->db->update('cane_party', $data); 
				
				// Update in Accounts
				$data = array(
					
				 	'account_name' => $party_name,
					
								   
				);
				$this->db->where('parent_id', $party_id);
				$this->db->where('acc_type', '3'); //Party Account
				$this->db->update('cane_accounts', $data); 
				 
				
				return "1";
				
			}	
}//if not empty				
				
}//function ends 				
			
		
		
			
				
		

function delete_party($id){
	
		
	$query = $this->db->query("SELECT id FROM cane_accounts WHERE parent_id='$id' AND acc_type='3'"); // 3 party account
	foreach ($query->result() as $row){$party_id= $row->id;}
				
									   
		      
				$query1 = $this->db->query("SELECT id FROM cane_entries WHERE dr_side='$party_id'");
				$query2 = $this->db->query("SELECT id FROM  cane_entries WHERE cr_side='$party_id'");					      
				$query3 = $this->db->query("SELECT purchase_id FROM  cane_purchase WHERE party_id='$id'");
				$query4 = $this->db->query("SELECT p_return_id FROM cane_purchase_return WHERE party_id='$id'");
	
				$value1= $query1->num_rows(); $value2= $query2->num_rows(); $value3= $query3->num_rows(); $value4= $query4->num_rows();
				$value= $value1+$value2+$value3+$value4;
				
	if ($value > 0){
		
			 return 2;
			  
		} else {	
																					
				$this->db->delete('cane_party', array('party_id ' => $id)); 
				$this->db->delete('cane_accounts', array('id' =>$party_id)); 
				
				if($this->db->affected_rows() > 0){return 1;} else {return 3;}
				
		}
		
		
}



}