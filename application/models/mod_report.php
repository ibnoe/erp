<?php
class Mod_report extends CI_Model {
	
	function ledger($daterange1,$daterange2,$account_id){
		
		$getData = $this->db->query("
			SELECT *
			FROM (	
		
			SELECT
			cane_entries.id,amount AS balance,cr_side,account_name,trans_date,narration,entry_by,cheque_number,voucher_number FROM cane_entries
			LEFT JOIN cane_accounts ON cane_accounts.id=cane_entries.cr_side
			LEFT JOIN cane_cheques ON cane_cheques.top_journal=cane_entries.id
			LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher
			WHERE dr_side='$account_id' AND trans_date between '$daterange1' AND '$daterange2'
			GROUP BY cane_entries.id
			   
			UNION ALL
			
			SELECT 
			cane_entries.id,amount*-1 AS balance,dr_side,account_name,trans_date,narration,entry_by,cheque_number,voucher_number FROM cane_entries
			LEFT JOIN cane_accounts ON cane_accounts.id=cane_entries.dr_side
			LEFT JOIN cane_cheques ON cane_cheques.top_journal=cane_entries.id
			LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher
			WHERE cr_side='$account_id' AND trans_date between '$daterange1' and '$daterange2'
			GROUP BY cane_entries.id
			) a 
			ORDER BY trans_date ASC,id ASC
				
			");		
			if($getData->num_rows() > 0)
			return $getData->result_array();
			else
			return null;
		
		
	}	
	
	
	function ledger_begining_bal($daterange1,$daterange2,$account_id){

	$query = $this->db->query("SELECT op_balance_dc,account_name,op_balance FROM cane_accounts WHERE id='$account_id'");
							
				foreach ($query->result() as $row)
					{
					    $side= $row->op_balance_dc;
					    $op_balance = $row->op_balance;
					   
					   	$data['account_name']=$row->account_name;   
					}		
			
		   
		
	$query = $this->db->query("
			SELECT SUM(amount) AS debit_balance FROM cane_entries 
			LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher
			WHERE dr_side='$account_id' AND trans_date <'$daterange1'");
							
				foreach ($query->result() as $row)
					{
					   $debit_balance= $row->debit_balance;
					   		   
					}	
		
		
	$query = $this->db->query("
				SELECT SUM(amount) AS credit_balance FROM cane_entries
				LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher 
				WHERE cr_side='$account_id' AND trans_date<'$daterange1'");
							
				foreach ($query->result() as $row)
					{
					   $credit_balance= $row->credit_balance;
					   		   
					}
					
	if($side=='D'){$data['op_balance']=($debit_balance-$credit_balance)+$op_balance;} else {$data['op_balance']=($credit_balance-$debit_balance)+$op_balance ;}
					
	$data['side']= $side;
	
	return $data;
		
	}



// ---------------------------------------------------------------INCOME STATEMENT STUFF-----------

	
function get_balance_dr($daterange1,$daterange2,$account_id){
	
	$daterange1=date("Y-m-d", strtotime($daterange1));
    $daterange2=date("Y-m-d", strtotime($daterange2));
	
	$query = $this->db->query("
			
			SELECT SUM(amount) AS AMOUNT FROM cane_entries
			LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher 
			WHERE dr_side='$account_id' AND trans_date between '$daterange1' AND '$daterange2' 
							
			");		
		
		foreach ($query->result() as $row) {
									   
		     $dr_amount= $row->AMOUNT;
									      
		}	
		return $dr_amount;						 
}

function get_balance_cr($daterange1,$daterange2,$account_id){
	 
	$daterange1=date("Y-m-d", strtotime($daterange1));
	$daterange2=date("Y-m-d", strtotime($daterange2));
	
	$query = $this->db->query("SELECT SUM(amount) AS AMOUNT FROM cane_entries 
	LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher 
	WHERE cr_side='$account_id' AND trans_date between '$daterange1' AND '$daterange2'");	
						
						
		foreach ($query->result() as $row) {
									   
		     $cr_amount= $row->AMOUNT;
									      
		}	

		return $cr_amount;	
}

function get_beg_balance($daterange2,$account_id){
	
	$daterange2=date("Y-m-d", strtotime($daterange2));
	
	$query = $this->db->query("SELECT op_balance FROM cane_accounts WHERE id='$account_id' AND op_date <= '$daterange2'");
							
				foreach ($query->result() as $row)
					{
					   $op_balance= $row->op_balance;
					   
					   		   
					}		
	
				if(empty($op_balance)){$op_balance=0;}
			
	
	return $op_balance; 
	
	
}

function check_account_type($account_id){
	
	$query = $this->db->query("SELECT op_balance_dc,account_name FROM cane_accounts WHERE id='$account_id'");
							
				foreach ($query->result() as $row)
					{
					  $data['side']=$row->op_balance_dc;
					  $data['account_name']= $row->account_name;
					   
					   		   
					}		
		
	
	return $data; 
	
	
}
function get_expenses($daterange1,$daterange2){
	
	$daterange1=date("Y-m-d", strtotime($daterange1));
    $daterange2=date("Y-m-d", strtotime($daterange2));
	
	$getData = $this->db->query("
	
			SELECT account_name, SUM(Amount) AS expense_amount FROM (
			
			SELECT cane_accounts.id,account_name, SUM(cane_entries.amount) AS Amount FROM cane_accounts 
			LEFT JOIN 
			(
			SELECT trans_date,id,dr_side,cr_side,amount FROM cane_entries
			LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher
			) cane_entries ON cane_entries.dr_side=cane_accounts.id
			WHERE acc_type='7' AND trans_date between '$daterange1' AND '$daterange2' GROUP BY cane_accounts.id
			
			UNION ALL
			
			SELECT cane_accounts.id,account_name, SUM(cane_entries.amount)*-1 AS Amount FROM cane_accounts 
			LEFT JOIN 
			(
			SELECT trans_date,id,dr_side,cr_side,amount FROM cane_entries
			LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher
			) cane_entries ON cane_entries.dr_side=cane_accounts.id
			
			WHERE acc_type='7' AND trans_date between '$daterange1' AND '$daterange2' GROUP BY cane_accounts.id
			) as e
			GROUP BY e.id
				
			");		
			if($getData->num_rows() > 0)
			return $getData->result_array();
			else
			return null;
	
	
}
	
// ---------------------------------------------------------------End of INCOME STATEMENT STUFF-----------	


// ---------------------------------------------------------------Current Balance Check-----------

function cur_balance_dr($daterange2,$account_id){
	
	
    $daterange2=date("Y-m-d", strtotime($daterange2));
	
	$query = $this->db->query("
			
			SELECT SUM(amount) AS AMOUNT FROM cane_entries
			LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher
			WHERE dr_side='$account_id' AND trans_date <= '$daterange2' 
							
			");		
		
		foreach ($query->result() as $row) {
									   
		     $dr_amount= $row->AMOUNT;
									      
		}	
		return $dr_amount;						 
}

function cur_balance_cr($daterange2,$account_id){
	 
	
	$daterange2=date("Y-m-d", strtotime($daterange2));
	
	$query = $this->db->query("
	SELECT SUM(amount) AS AMOUNT FROM cane_entries
	LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher 
	WHERE cr_side='$account_id' AND trans_date <= '$daterange2'");	
						
						
		foreach ($query->result() as $row) {
									   
		     $cr_amount= $row->AMOUNT;
									      
		}	

		return $cr_amount;	
}

function curr_beg_balance($daterange2,$account_id){
	
	$daterange2=date("Y-m-d", strtotime($daterange2));
	
	$query = $this->db->query("SELECT op_balance FROM cane_accounts WHERE id='$account_id' AND op_date <= '$daterange2'");
							
				foreach ($query->result() as $row)
					{
					   $op_balance= $row->op_balance;
					   
					   		   
					}		
	
				if(empty($op_balance)){$op_balance=0;}
			
	
	return $op_balance; 
	
	
}



function cash_collected(){
		
	$user_id=$this->input->post('user_id');
	if($user_id=='all'){$extra_query="";} else {$extra_query="AND entry_by='$user_id'";}	
	$daterange1=date("Y-m-d", strtotime($this->input->post('daterange1')));
   	
	$getData = $this->db->query("
	
	SELECT ((ifnull(DR_AMOUNT_cash,0)+ifnull(DR_AMOUNT_cheque,0))-(ifnull(CR_AMOUNT_cash,0)+ifnull(CR_AMOUNT_cheque,0))) AS balance FROM
		(
			SELECT SUM(amount) AS DR_AMOUNT_cash FROM cane_entries
			LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher
			WHERE dr_side='1' AND trans_date='$daterange1' $extra_query
		) as j,
		(
			SELECT SUM(amount) AS CR_AMOUNT_cash FROM cane_entries
			LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher
			WHERE cr_side='1' AND trans_date='$daterange1' $extra_query
		) as k,	
		
		(
			SELECT SUM(amount) AS DR_AMOUNT_cheque FROM cane_entries
			LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher
			WHERE dr_side='9' AND trans_date='$daterange1' $extra_query
		) as l,
		(
			SELECT SUM(amount) AS CR_AMOUNT_cheque FROM cane_entries
			LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher
			WHERE cr_side='9' AND trans_date='$daterange1' $extra_query
		) as m	
				
	");		
	
	foreach ($getData->result() as $row)
	{
	   $balance= $row->balance;
	}	

	return $balance;
	
	
}		

function accounts_rec_pay(){
		
	$type=$this->input->post('type');
	
	$daterange1=date("Y-m-d", strtotime($this->input->post('daterange1')));
   	
	$getData = $this->db->query("
	
	SELECT SUM(amount) AS AMOUNT FROM cane_entries
	LEFT JOIN cane_voucher ON cane_voucher.voucher_id=cane_entries.parent_voucher
	WHERE $type IN (SELECT id FROM cane_accounts WHERE acc_type='3') AND trans_date<= '$daterange1'
				
	");		
	
	foreach ($getData->result() as $row)
	{
	   $balance= $row->AMOUNT;
	}	

	return $balance;
	
	
}		
		
	
	
}