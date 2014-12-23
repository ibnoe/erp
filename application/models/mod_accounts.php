<?php
class Mod_accounts extends CI_Model {


function get_all_accounts() { 

	$this->db->select('id,account_name');
	$this->db->from('cane_accounts');
			
	$getData = $this->db->get('');
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
}
		

function bank(){
	
	$bank_name=trim($this->input->post('bank_name'));
	$account_name=trim($this->input->post('account_name'));
	$account_number=trim($this->input->post('account_number'));
	$op_balance=trim($this->input->post('op_balance'));
					
	$query = $this->db->query("SELECT bank_id FROM cane_bank WHERE TRIM(account_name)='$account_name' AND TRIM(account_number)='$account_number'");			
							
	if ($query->num_rows() > 0){
				
			return "2";
					
	} 
				
	else	{	
				$data = array(              
								
					'bank_id'=>'',
					'bank_name'=>$bank_name,
					'account_name'=>$account_name,
					'account_number'=>$account_number,																		 						
				);                  
			
				$results=$this->db->insert('cane_bank', $data);
				
				$autovalue= $this->db->insert_id();
				
				$data = array(              
								
					'id'=>'',
					'account_name'=>$bank_name."-".$account_name,
					'op_balance'=>$op_balance,
					'op_balance_dc'=>'D',
					'parent_id'=>$autovalue,
					'acc_type'=>'2'// Bank
																 						
				);                  
			
				$results=$this->db->insert('cane_accounts', $data);
													
				return "1";
			}
} 
	  

function bank_list() { 
	
			$this->db->select('*');
			$this->db->from('cane_bank');
			$this->db->order_by('bank_name','ASC');
			$getData = $this->db->get('');
			if($getData->num_rows() > 0)
			return $getData->result_array();
			else
			return null;
		}
		
function get_bank_info($id){
	
			$this->db->select('*');
			$this->db->from('cane_bank');
			$this->db->where('bank_id', $id); 	
			$getData = $this->db->get('');
			if($getData->num_rows() > 0)
			return $getData->result_array();
			else
			return null;
	
}	

function bank_updated(){

		$bank_name=trim($this->input->post('bank_name'));
		$account_name=trim($this->input->post('account_name'));
		$account_number=trim($this->input->post('account_number'));
		$bank_id=trim($this->input->post('bank_id'));
		
		
	$query = $this->db->query("SELECT bank_id FROM cane_bank WHERE TRIM(account_name)='$account_name' AND TRIM(account_number)='$account_number' AND bank_id!='$bank_id' ");			
							
	if ($query->num_rows() > 0){
				
			return "2";
					
	} 
				
	else	{		
					
				$data = array(
					'bank_name'=>$bank_name,
					'account_name'=>$account_name,
					'account_number'=>$account_number
				);          
				$this->db->where('bank_id', $bank_id);
				$this->db->update('cane_bank', $data);

				$data = array(
					'account_name'=>$bank_name."-".$account_name
				);        
				$this->db->where('parent_id', $bank_id);
				$this->db->where('acc_type', '2'); // Bank
				$this->db->update('cane_accounts', $data);
													
		return "1";
	
	}
						
								
}								
																								 						

function delete_bank($id){

	
	
	$query = $this->db->query("SELECT id FROM cane_accounts WHERE parent_id='$id' AND acc_type='2'"); //2 means bank account
	
					foreach ($query->result() as $row) {
						
						  $bank_account = $row->id;
						 					   					   
					}
	
	$query = $this->db->query("SELECT id FROM cane_entries WHERE dr_side='$bank_account' OR cr_side='$bank_account'");
	
	
	if ($query->num_rows() > 0){
	
			 return 3; 
	} else{
				$this->db->delete('cane_bank', array('bank_id' => $id)); 			
				$this->db->delete('cane_accounts', array('id' => $bank_account)); 
				
				if($this->db->affected_rows() > 0){ return "1"; } else { return $v=2;}	
		}
		
		
	}
								
// ---------------------------------- Expense Accounts--------------------------------------------

	function expense(){
	
			$expense_name=trim($this->input->post('expense_name'));
			
					
			$query = $this->db->query("SELECT id FROM cane_accounts WHERE account_name='$expense_name' ");			
							
				if ($query->num_rows() > 0){
				
					return "2";
					
				} 
				
				else	{		
					
					
					
					$data = array(              
								
								'id'=>'',
								'account_name'=>$expense_name,
								'op_balance'=>NULL,
								'op_balance_dc'=>'D',
								'parent_id'=>NULL,
								'acc_type'=>'7' //7 is for Expense Accounts
																 						
								);                  
								$results=$this->db->insert('cane_accounts', $data);
													
				return "1";
				
				
				
				}
		
	
	}   

function expense_list() { 
	
			$this->db->select('*');
			$this->db->from('cane_accounts');
			$this->db->where('acc_type', '7'); //7 is for Expense Accounts	
			$this->db->order_by('account_name','ASC');
			$getData = $this->db->get('');
			if($getData->num_rows() > 0)
			return $getData->result_array();
			else
			return null;
	}
		
function get_expense_info($id){
	
			$this->db->select('account_name,id');
			$this->db->from('cane_accounts');
			$this->db->where('id', $id); 	
			$getData = $this->db->get('');
			if($getData->num_rows() > 0)
			return $getData->result_array();
			else
			return null;
	
}	

function expense_updated(){
	
		$expense_name=trim($this->input->post('expense_name'));
		$id=trim($this->input->post('id'));
			
					
			$query = $this->db->query("SELECT id FROM cane_accounts WHERE account_name='$expense_name' AND id!='$id'");			
							
				if ($query->num_rows() > 0){
				
					return "2";
					
				} 
				
				else	{		
					
					
					
					$data = array(
						'account_name'=>$expense_name, 
						
						);          
						$this->db->where('id', $id);
						$this->db->update('cane_accounts', $data);	
													
					return "1";
				
				
				
				}
			
								
}								
																								 						

function delete_expense($id){

	$query = $this->db->query("SELECT id FROM cane_entries WHERE dr_side='$id' OR cr_side='$id'");
	
	
	if ($query->num_rows() > 0){
	
			 return 3; 
	} else{
							
				$query= $this->db->delete('cane_accounts', array('id' => $id)); 
				
				if($query){ return $v=1; } else { return $v=2;}	
		}
		
		
	}
								
				
		
		


	
	

	
}	