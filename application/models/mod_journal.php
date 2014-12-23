<?php
class Mod_journal extends CI_Model {
	
//-------------------------------------- Journal ---------------------------------	
	
	function add_journal($user_id){
		
		$debit=trim($this->input->post('debit'));
		$credit=trim($this->input->post('credit'));
		$amount=str_replace(',', '', trim($this->input->post('amount')));
		$narration=trim($this->input->post('narration'));
		$trans_date=date("Y-m-d", strtotime($this->input->post('date')));
		
		$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>'Journal',
				 		'narration' =>$narration, 
						'trans_date' => $trans_date, 
				 		'entry_by' => $user_id,
													   
				);
				$this->db->insert('cane_voucher', $data); 
		
				$autovalue= $this->db->insert_id();
					
				
			$data = array(
					  	'id' => '',
			 		  	'amount' => $amount,
				 		'dr_side' => $debit, 
						'cr_side' => $credit, 
				 		'parent_voucher' =>$autovalue,
														   
				);
			$this->db->insert('cane_entries', $data); 
				
				
		if($this->db->affected_rows() > 0) {return 1;}else {return 2;}	
				
		
		
			
	}//function ends

	

function journal_list($daterange1,$daterange2) { 
	
	$daterange1=date("Y-m-d", strtotime($daterange1));
	$daterange2=date("Y-m-d", strtotime($daterange2));
	
	
	$getData = $this->db->query("
	
	SELECT amount,dr_side,cr_side,voucher_number,narration,trans_date FROM cane_entries 
	
	LEFT JOIN cane_voucher ON cane_entries.parent_voucher=cane_voucher.voucher_id
	LEFT JOIN cane_cheques ON  cane_cheques.top_journal=cane_entries.id
	WHERE trans_date>='$daterange1' AND trans_date<='$daterange2'
	GROUP BY cane_entries.id 
			
	");	
	
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
}	
		
		
//--------------------------------------------------------- Payment-------------------------------------------
	
function add_payment($user_id){
		
		$debit=trim($this->input->post('debit'));
		$credit=trim($this->input->post('credit'));
		$amount=str_replace(',', '', trim($this->input->post('amount')));
		$narration=trim($this->input->post('narration'));
		$entry_type=trim($this->input->post('entry_type'));
		$issue_date=date("Y-m-d", strtotime($this->input->post('date')));
		$cheque_number=trim($this->input->post('cheque_number'));
		$cheque_date=date("Y-m-d", strtotime($this->input->post('cheque_date')));
		$deduct_date=date("Y-m-d", strtotime($this->input->post('deduct_date')));		

		
	$invoiceid=$this->get_payment_invoice_number();
	$invoice_number=sprintf("%06s", $invoiceid) ;
	
	if($credit=='1'){ $payment_type='1'; } else {$payment_type='2'; }
			
	$year=date("Y"); $current_invoice='PMT-PC-'.$year.'-'.$invoice_number;
		
			$data = array(
						'payment_id' => '',
						'payment_invoice' =>$current_invoice,
						'payment_num' => $invoiceid, 
						'payment_date' => $issue_date,  
						'payment_type_id' =>$payment_type,
						);
			 $query=$this->db->insert('cane_payment', $data);			 								
		
	 // Journal Entry				
			
	// if payment was made with cheque 
	if(!empty($cheque_number)){
				
				$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>$current_invoice,
				 		'narration' =>$narration, 
						'trans_date' =>$issue_date, 
				 		'entry_by' => $user_id,
														   
				);
				$this->db->insert('cane_voucher', $data);
		
		$autovalue= $this->db->insert_id();
				
				$data = array(
					  	'id' => '',
			 		  	'amount' => $amount,
				 		'dr_side' =>$debit, 
						'cr_side' => '13', // 13= Paid with Cheque
				 		'parent_voucher' =>$autovalue									   
				);
				$this->db->insert('cane_entries', $data); 
				
				$top_journal = $this->db->insert_id();
				
				
				$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>'Journal',
				 		'narration' =>'Transfered Balance From Bank to Paid with Cheque Account', 
						'trans_date' =>$deduct_date, 
				 		'entry_by' => $user_id,
														   
				);
				$this->db->insert('cane_voucher', $data);
		
				$second_autovalue= $this->db->insert_id();
				
				$data = array(
					  	'id' => '',
			 		  	'amount' => $amount,
				 		'dr_side' =>'13', 
						'cr_side' => $credit, 
				 		'parent_voucher' =>$second_autovalue									   
				);
				$this->db->insert('cane_entries', $data); 
				
				$bottom_journal = $this->db->insert_id();
			
			// Entrying the cheque information	
				$data = array(
					  	'cheque_id' => '',
			 		  	'cheque_number' => $cheque_number,
						'cheque_date' => $cheque_date,
						'bank_name' => $credit, // keeping the bank name
						'top_journal' =>$top_journal,
						'bottom_journal' =>$bottom_journal, //:: this is for cheque schedule only
						'cheque_type' => '2', //Payment
						'status' => '1' 				
				);
				$this->db->insert('cane_cheques', $data);				
					
	} else { 	

				$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>$current_invoice,
				 		'narration' =>$narration, 
						'trans_date' =>$issue_date, 
				 		'entry_by' => $user_id,
														   
				);
				$this->db->insert('cane_voucher', $data);
				
				$autovalue= $this->db->insert_id();
											
				$data = array(
					  	'id' => '',
			 		  	'amount' => $amount,
				 		'dr_side' => $debit, 
						'cr_side' => $credit, 
				 		'parent_voucher' =>$autovalue									   
				);
				$this->db->insert('cane_entries', $data);
	}			
				
	return 1;			
				
}//function ends

function get_payment_invoice_number(){
	
	$year = date("Y");	
	
	$query = $this->db->query("SELECT max(payment_num) AS MAXNUM FROM cane_payment WHERE year(payment_date)='$year'");

					foreach ($query->result() as $row)
					{
					   $value1= $row->MAXNUM;
					   					   
					}
						
						
			$strLen = strlen($value1);
			$value  = (((int) $value1) + 1);
			
		return	 str_pad($value, $strLen, '0', STR_PAD_LEFT);
}


function payment_list($daterange1,$daterange2,$party_id) {

	$daterange1=date("Y-m-d", strtotime($daterange1));
	$daterange2=date("Y-m-d", strtotime($daterange2));

	if($party_id=='all'){$query_more='';} else {$query_more="AND dr_side='$party_id'";}
	
		
	$getData = $this->db->query("
	
	SELECT 
	voucher_number,amount,narration,dr_side,cr_side,cheque_number,cheque_date,payment_date,trans_date,bank_name
	

	FROM cane_payment
	LEFT JOIN
	(
			SELECT 
			voucher_id,
			voucher_number,
			amount,
			narration,
			dr_side,
			cr_side,
			cheque_number,
			cheque_date, 
			trans_date,
			bank_name
			FROM cane_entries  
			LEFT JOIN cane_voucher ON cane_entries.parent_voucher=cane_voucher.voucher_id
			LEFT JOIN cane_cheques ON  cane_cheques.top_journal=cane_entries.id
			GROUP BY cane_entries.id

	) e ON cane_payment.payment_invoice=e.voucher_number
	WHERE payment_date >='$daterange1' AND payment_date <='$daterange2'
	$query_more
		
	");	
	
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
	
}

//------------------------------------------------------Receipt----------------------------------------
	
function add_receipt($user_id){
		
		$debit=trim($this->input->post('debit'));
		$credit=trim($this->input->post('credit'));
		
		$amount=str_replace(',', '', trim($this->input->post('amount')));
		$narration=trim($this->input->post('bill_against'));
		$entry_type=trim($this->input->post('entry_type'));
		$issue_date=date("Y-m-d", strtotime($this->input->post('date')));
		$cheque_number=trim($this->input->post('cheque_number'));
		$bank_name=trim($this->input->post('bank_name'));
		$cheque_date=date("Y-m-d", strtotime($this->input->post('cheque_date')));
				
	
	
	if($debit=='1'){ //cash

		$receipt_type='1'; //cash 
	}	
	
	elseif($debit=='9'){ // Received with cheque

		$receipt_type='2'; //cheque
	}
	
	else {
			
		$receipt_type='3'; // in bank account			

	}	
	
	$year=date("Y");
	$invoiceid=$this->gen_invoice_number();
	$invoice_number=sprintf("%06s", $invoiceid) ;
	$current_invoice= 'RPT-PC-'.$year.'-'.$invoice_number;
	
				$data = array(
						'receipt_id' => '',
						'receipt_invoice' =>$current_invoice,
						'receipt_num' => $invoiceid, 
						'receipt_date' => $issue_date,  
						'receipt_type_id' =>$receipt_type,
						
						 								
						);
		 $query=$this->db->insert('cane_receipt', $data);		
		
		$autovalue= $this->db->insert_id();		
						
				$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>$current_invoice,
				 		'narration' =>$narration, 
						'trans_date' =>$issue_date, 
				 		'entry_by' => $user_id,
														   
				);
				$this->db->insert('cane_voucher', $data);
				
				$parent_voucher=$this->db->insert_id();		
				
				$data = array(
					  	'id' => '',
			 		  	'amount' => $amount,
				 		'dr_side' => $debit, 
						'cr_side' => $credit, 
				 		'parent_voucher' =>$parent_voucher
									   
				);
				$this->db->insert('cane_entries', $data); 
			
				// if payment was made with cheque 					
				if(!empty($cheque_number)){
											
						$journal_entry_id= $this->db->insert_id();	
										
							$data = array(
							  	'cheque_id' => '',
					 		  	'cheque_number' => $cheque_number,
								'cheque_date' => $cheque_date,
								'bank_name' => $bank_name,
								'top_journal' =>$journal_entry_id,
								'bottom_journal' =>NULL,
								'cheque_type' => '1', //Receive
								'status' => '2' 
																	   
						);
						$this->db->insert('cane_cheques', $data);
				}							
				
	return $current_invoice; //invoice id		 
}//function ends		
			


	
function gen_invoice_number(){
	
	$year = date("Y");	
	
	$query = $this->db->query("SELECT max(receipt_num) AS MAXNUM FROM cane_receipt WHERE year(receipt_date)='$year'");

					foreach ($query->result() as $row)
					{
					   $value1= $row->MAXNUM;
					   					   
					}
						
						
			$strLen = strlen($value1);
			$value  = (((int) $value1) + 1);
			
		return	 str_pad($value, $strLen, '0', STR_PAD_LEFT);
}


function print_receipt_invoice($id){
	
	
	$getData = $this->db->query("
	
	SELECT 
	voucher_number,amount,narration,dr_side,party_name,party_contact,cheque_number,cheque_date,receipt_date,receipt_type_id,admin_name,bank_name
	
	FROM 
	(		
			SELECT 
			voucher_number,amount,narration,dr_side,cr_side,cheque_number,cheque_date,receipt_date,receipt_type_id,entry_by,bank_name
			FROM cane_receipt
			LEFT JOIN
			(
					SELECT 
					voucher_number,
					amount,
					narration,
					dr_side,
					cr_side,
					cheque_number,
					cheque_date, 
					entry_by,
					bank_name
					FROM cane_entries  
					LEFT JOIN cane_voucher ON cane_entries.parent_voucher=cane_voucher.voucher_id
					LEFT JOIN cane_cheques ON  cane_cheques.top_journal=cane_entries.id
					WHERE voucher_number='$id'
		
			) e ON cane_receipt.receipt_invoice=e.voucher_number
	
	) a		
			
	LEFT JOIN (
	
		SELECT id,party_name,party_contact FROM cane_accounts
		LEFT JOIN cane_party ON cane_party.party_id=cane_accounts.parent_id
		WHERE acc_type='3'
	) f ON f.id=a.cr_side
	
	LEFT JOIN cane_admin ON cane_admin.admin_id=a.entry_by
	
	");
	
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
	
	
}

function receipt_list($daterange1,$daterange2){
	
	
	$daterange1=date("Y-m-d", strtotime($daterange1));
	$daterange2=date("Y-m-d", strtotime($daterange2));
	
	$getData = $this->db->query("
	
		SELECT 
	voucher_number,amount,narration,dr_side,cr_side,cheque_number,cheque_date,receipt_date,trans_date,bank_name
	

	FROM cane_receipt
	LEFT JOIN
	(
			SELECT 
			voucher_id,
			voucher_number,
			amount,
			narration,
			dr_side,
			cr_side,
			cheque_number,
			cheque_date, 
			trans_date,
			bank_name
			FROM cane_entries  
			LEFT JOIN cane_voucher ON cane_entries.parent_voucher=cane_voucher.voucher_id
			LEFT JOIN cane_cheques ON  cane_cheques.top_journal=cane_entries.id
			GROUP BY cane_entries.id

	) e ON cane_receipt.receipt_invoice=e.voucher_number
	WHERE receipt_date >='$daterange1' AND receipt_date <='$daterange2'
	
			");
						
			
			if($getData->num_rows() > 0)
			return $getData->result_array();
			else
			return null;
			
	
}

		
		
		

//---------------------------------------------------cheque----------------------------

function paid_cheque_schedule($daterange1,$daterange2,$cheque_type) { 
	
	$daterange1=date("Y-m-d", strtotime($daterange1));
	$daterange2=date("Y-m-d", strtotime($daterange2));
	
	$getData = $this->db->query("
	
		SELECT cane_cheques.cheque_id,cheque_number,cheque_date,bank_name,dr_side,status,amount,trans_date,eff_voucher FROM cane_cheques
		LEFT JOIN cane_entries ON cane_entries.id=cane_cheques.top_journal
		LEFT JOIN 
		(
			SELECT trans_date,cheque_id, parent_voucher AS eff_voucher FROM (
			
			SELECT parent_voucher,cheque_id FROM cane_cheques
			LEFT JOIN cane_entries ON cane_entries.id=cane_cheques.bottom_journal
			WHERE status='1' AND cheque_type='$cheque_type' AND cheque_date >='$daterange1' AND cheque_date <='$daterange2'
			
			) as k 
			LEFT JOIN cane_voucher ON cane_voucher.voucher_id=k.parent_voucher
		
		) j ON j.cheque_id=cane_cheques.cheque_id
		
		
		WHERE status='1' AND cheque_type='$cheque_type' AND cheque_date >='$daterange1' AND cheque_date <='$daterange2' 
		ORDER BY cheque_date ASC,id ASC 
	
	");
	
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
			
			
}

function updated_payment_effect_date(){
	
	$voucher_id=trim($this->input->post('voucher_id'));
	$date=date("Y-m-d", strtotime(trim($this->input->post('daterange1'))));
	
	
	$data = array(
					  	'trans_date' => $date,
			 		  															   
				);
				$this->db->where('voucher_id', $voucher_id);
				$this->db->update('cane_voucher', $data);
				
	
}

function change_paid_cheque_status($user_id){
	
	$id=($_POST['id']);
	$cheque=($_POST['cheque']);
	$cheque_date=($_POST['cheque_date']);
	$bank_name=($_POST['bank_name']);


for($i = 0; $i < count($id); $i++){
			
	$query = $this->db->query("SELECT dr_side,cr_side,amount FROM cane_cheques
							LEFT JOIN cane_entries ON cane_entries.id=cane_cheques.top_journal WHERE cheque_id='$id[$i]'");
	
	
						foreach ($query->result() as $row)
						{
						  $dr_side_top= $row->dr_side;
						  $cr_side_top= $row->cr_side;
						   $amount_top= $row->amount;
						     
						}
						
	$query = $this->db->query("SELECT dr_side,cr_side,amount FROM cane_cheques
								LEFT JOIN cane_entries ON cane_entries.id=cane_cheques.bottom_journal
								WHERE cheque_id='$id[$i]'");
	
	
						foreach ($query->result() as $row)
						{
						  $dr_side_bottom= $row->dr_side;
						  $cr_side_bottom= $row->cr_side;
						   $amount_bottom= $row->amount;
						     
						}					
		
	// Reverse Journal Entry --------------------------------------------
			
			// Part 1
			if (isset($_POST['cancel'])) {
				
				$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>'Journal',
				 		'narration' =>'Canceled Paid Cheque', 
						'trans_date' =>date("Y-m-d"), 
				 		'entry_by' => $user_id,
														   
				);
				$this->db->insert('cane_voucher', $data);
		
			$autovalue = $this->db->insert_id();
				
				$data = array(
					  	'id' => '',
			 		  	'amount' => $amount_top,
				 		'dr_side' =>'14', // Canceled Paid Cheque 
						'cr_side' => $dr_side_top, // Party Account
				 		'parent_voucher' =>$autovalue									   
				);
				$this->db->insert('cane_entries', $data); 
				
				$top_journal = $this->db->insert_id();
				
				$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>'Journal',
				 		'narration' =>'Transfered Balance To Bank From Canceled Paid Cheque', 
						'trans_date' =>date("Y-m-d"), 
				 		'entry_by' => $user_id,
														   
				);
				$this->db->insert('cane_voucher', $data);				
				
				$second_autovalue = $this->db->insert_id();
				
				$data = array(
					  	'id' => '',
			 		  	'amount' => $amount_bottom,
				 		'dr_side' =>$cr_side_bottom, // Bank Account
						'cr_side' =>'14', // Canceled Paid Cheque 
				 		'parent_voucher' =>$second_autovalue									   
				);
				$this->db->insert('cane_entries', $data); 
				
				$bottom_journal= $this->db->insert_id();
				
				// Inserting cheque
				
				$data = array(
					  	'cheque_id' => '',
			 		  	'cheque_number' =>$cheque[$i],
				 		'cheque_date' =>$cheque_date[$i], // 
						'bank_name' =>$bank_name[$i], // 
				 		'top_journal' =>$top_journal,
						'bottom_journal' =>$bottom_journal,
						'cheque_type' =>'2', // Paid Cheque
						'status' =>'4', //cancelled									   
				);
				$this->db->insert('cane_cheques', $data); 
				
				
				
				// update previous cheque status
				
				$data = array(
						'status' =>'4', //cancelled									   
					);
				$this->db->where('cheque_id', $id[$i]); 
				$this->db->update('cane_cheques', $data); 
				
        // btnDelete
    } else {
        //assume btnSubmit
        
    		
    	$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>'Journal',
				 		'narration' =>'Paid Cheque Was Dishonored', 
						'trans_date' =>date("Y-m-d"), 
				 		'entry_by' => $user_id,
														   
				);
				$this->db->insert('cane_voucher', $data);
		
			$autovalue = $this->db->insert_id();
				
				$data = array(
					  	'id' => '',
			 		  	'amount' => $amount_top,
				 		'dr_side' =>'15', // Paid Cheque Dishonor 
						'cr_side' => $dr_side_top, // Party Account
				 		'parent_voucher' =>$autovalue									   
				);
				$this->db->insert('cane_entries', $data); 
				
				$top_journal = $this->db->insert_id();
				
				$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>'Journal',
				 		'narration' =>'Transfered Balance To Bank From Paid Cheque Dishonor', 
						'trans_date' =>date("Y-m-d"), 
				 		'entry_by' => $user_id,
														   
				);
				$this->db->insert('cane_voucher', $data);					
				
				$second_autovalue = $this->db->insert_id();
				
				$data = array(
					  	'id' => '',
			 		  	'amount' => $amount_bottom,
				 		'dr_side' =>$cr_side_bottom, // Bank Account
						'cr_side' =>'15', // Paid Cheque Dishonor
				 		'parent_voucher' =>$second_autovalue									   
				);
				$this->db->insert('cane_entries', $data); 
				
				$bottom_journal= $this->db->insert_id();
				
				// Inserting cheque
				
				$data = array(
					  	'cheque_id' => '',
			 		  	'cheque_number' =>$cheque[$i],
				 		'cheque_date' =>$cheque_date[$i], // 
						'bank_name' =>$bank_name[$i], //  
				 		'top_journal' =>$top_journal,
						'bottom_journal' =>$bottom_journal,
						'cheque_type' =>'2', // Paid Cheque
						'status' =>'3', //cancelled									   
				);
				$this->db->insert('cane_cheques', $data); 
				
				
				
				// update previous cheque status
				
				$data = array(
						'status' =>'3', //cancelled									   
					);
				$this->db->where('cheque_id', $id[$i]); 
				$this->db->update('cane_cheques', $data); 
    	
    	}
    	
    }//end for loop	
    	
    return 1;
		
								
	
	
 /*   Formula 
  ---------------------------------------Receipt--------
	RChque
  		 Party 

	Party 
     	Dishonere cheque

	dishonered cheque
         Recevied With cheque

-----------------------------------------Payment-------
	Party 
 		Bank 

	Dishonered
     	Party

	Bank
		  Dishonered 
    
  */	
	
}
	
//---------------------- Receipt Shcedule

function receipt_cheque_schedule($daterange1,$daterange2,$cheque_type) { 
	
	$daterange1=date("Y-m-d", strtotime($daterange1));
	$daterange2=date("Y-m-d", strtotime($daterange2));
	
	$getData = $this->db->query("
	
		SELECT cane_cheques.cheque_id,cheque_number,cheque_date,bank_name,cr_side,status,amount,trans_date,eff_voucher FROM cane_cheques
		LEFT JOIN cane_entries ON cane_entries.id=cane_cheques.top_journal
		LEFT JOIN 
		(
			SELECT trans_date,cheque_id, parent_voucher AS eff_voucher FROM (
			
			SELECT parent_voucher,cheque_id FROM cane_cheques
			LEFT JOIN cane_entries ON cane_entries.id=cane_cheques.top_journal
			WHERE status='2' AND cheque_type='$cheque_type' AND cheque_date >='$daterange1' AND cheque_date <='$daterange2'
			
			) as k 
			LEFT JOIN cane_voucher ON cane_voucher.voucher_id=k.parent_voucher
		
		) j ON j.cheque_id=cane_cheques.cheque_id
		
		
		WHERE status='2' AND cheque_type='$cheque_type' AND cheque_date >='$daterange1' AND cheque_date <='$daterange2' 
		ORDER BY cheque_date ASC,id DESC 
	
	");
	
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
			
			
}
	

function change_receipt_cheque_status($user_id){
	
	$id=($_POST['id']);
	$cheque=($_POST['cheque']);
	$cheque_date=($_POST['cheque_date']);
	$bank_name=($_POST['bank_name']);
	
	$amount=($_POST['amount']);
	$cr_side=($_POST['cr_side']);


for($i = 0; $i < count($id); $i++){
			
			
	// Reverse Journal Entry --------------------------------------------
			
// Part 1
if (isset($_POST['cancel'])) {
				
				$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>'Journal',
				 		'narration' =>'Canceled Received Cheque', 
						'trans_date' =>date("Y-m-d"), 
				 		'entry_by' => $user_id,
														   
				);
				$this->db->insert('cane_voucher', $data);
		
			$autovalue = $this->db->insert_id();
				
				$data = array(
					  	'id' => '',
			 		  	'amount' => $amount[$i],
				 		'dr_side' =>$cr_side[$i], // party account
						'cr_side' => '11', // Received Cheque Cancelled
				 		'parent_voucher' =>$autovalue									   
				);
				$this->db->insert('cane_entries', $data); 
				
				$top_journal = $this->db->insert_id();
				
				$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>'Journal',
				 		'narration' =>'Adjusted Balance- Received Cheque Cancelled and Received With Cheque', 
						'trans_date' =>date("Y-m-d"), 
				 		'entry_by' => $user_id,
														   
				);
				$this->db->insert('cane_voucher', $data);
				
				$second_value = $this->db->insert_id();
				
				$data = array(
					  	'id' => '',
			 		  	'amount' =>$amount[$i],
				 		'dr_side' =>'11', // Received Cheque Cancelled
						'cr_side' =>'9', // Received With Cheque
				 		'parent_voucher' =>$second_value									   
				);
				$this->db->insert('cane_entries', $data); 
				
				$bottom_journal= $this->db->insert_id();
				
				// Inserting cheque
				
				$data = array(
					  	'cheque_id' => '',
			 		  	'cheque_number' =>$cheque[$i],
				 		'cheque_date' =>$cheque_date[$i], // 
						'bank_name' =>$bank_name[$i], // 
				 		'top_journal' =>$top_journal,
						'bottom_journal' =>$bottom_journal,
						'cheque_type' =>'1', // Paid Cheque
						'status' =>'4', //cancelled									   
				);
				$this->db->insert('cane_cheques', $data); 
				
								
				// update previous cheque status
				
				$data = array(
						'status' =>'4', //cancelled									   
					);
				$this->db->where('cheque_id', $id[$i]); 
				$this->db->update('cane_cheques', $data); 
				
        // btnDelete
    } elseif (isset($_POST['dishonered'])) {
        //assume btnSubmit
        
    		
    	$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>'Journal',
				 		'narration' =>'Received Cheque Was Dishonred', 
						'trans_date' =>date("Y-m-d"), 
				 		'entry_by' => $user_id,
														   
				);
				$this->db->insert('cane_voucher', $data);
		
			$autovalue = $this->db->insert_id();
				
				$data = array(
					  	'id' => '',
			 		  	'amount' => $amount[$i],
				 		'dr_side' =>$cr_side[$i], // party account
						'cr_side' => '10', // Received Cheque Dishonor
				 		'parent_voucher' =>$autovalue									   
				);
				$this->db->insert('cane_entries', $data); 
				
				$top_journal = $this->db->insert_id();
				
				$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>'Journal',
				 		'narration' =>'Adjusted Balance- Received Cheque Dishonor and Received With Cheque', 
						'trans_date' =>date("Y-m-d"), 
				 		'entry_by' => $user_id,
														   
				);
				$this->db->insert('cane_voucher', $data);
				
				$second_value = $this->db->insert_id();
				
				
				$data = array(
					  	'id' => '',
			 		  	'amount' =>$amount[$i],
				 		'dr_side' =>'10', // Received Cheque Dishonor
						'cr_side' =>'9', // Received With Cheque
				 		'parent_voucher' =>$second_value									   
				);
				$this->db->insert('cane_entries', $data); 
				
				$bottom_journal= $this->db->insert_id();
				
				// Inserting cheque
				
				$data = array(
					  	'cheque_id' => '',
			 		  	'cheque_number' =>$cheque[$i],
				 		'cheque_date' =>$cheque_date[$i], // 
						'bank_name' =>$bank_name[$i], // 
				 		'top_journal' =>$top_journal,
						'bottom_journal' =>$bottom_journal,
						'cheque_type' =>'1', // Paid Cheque
						'status' =>'3', //dishonred									   
				);
				$this->db->insert('cane_cheques', $data); 
				
								
				// update previous cheque status
				
				$data = array(
						'status' =>'3', //dishonred									   
					);
				$this->db->where('cheque_id', $id[$i]); 
				$this->db->update('cane_cheques', $data); 
    	
    	}
    	
    	else {
    		
    		
    		// update cheque status
				
				$data = array(
						'status' =>'1', //cleared									   
					);
				$this->db->where('cheque_id', $id[$i]); 
				$this->db->update('cane_cheques', $data); 
    		
    		
    	}
    	
    }//end for loop	
    	
    return 1;
		
								

	
}


//-------------------------------- Helper------------------------------------------
function get_all_accounts() { 
			$this->db->select('id,account_name');
			$this->db->from('cane_accounts');
			
			$getData = $this->db->get('');
			if($getData->num_rows() > 0)
			return $getData->result_array();
			else
			return null;
		}
		
	// 
	

		
		
}
	