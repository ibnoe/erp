<?php
class Journal extends CI_Controller{

function __construct()
    {
        parent::__construct();
        
       include 'parent_construct.php';
        
    }
    
//---------------------------------------------- Journal Entry------------------------------ 
   
function add(){
    	
    	$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
          	 
    	 } else {
    	
		    	$data['user_name']=$this->authex->get_user_name();
				$user_info = $this->authex->get_userdata();
				$data['level']=$user_info->level;
											
				$this->load->model('dropdown_items');
				$data['getall_accounts']= $this->dropdown_items->getall_accounts();
					
					
				$this->load->view('journal/view_add_journal',$data);	
    	
    	 }
    	
}
    
function journal_added(){
		
		$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
		
				$user_id= $this->authex->get_user_id();
				$this->load->model('mod_journal');
				$data= $this->mod_journal->add_journal($user_id);
				
				echo $data;
		
    	 }
		
}
	
function journal_select_date(){
		
		$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
		
				$data['user_name']=$this->authex->get_user_name();
				$user_info = $this->authex->get_userdata();
				$data['level']=$user_info->level;
				
				$this->load->view('journal/view_journal_daterange',$data);

    	 }
}
	
		
function journal_list(){
		
		$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
	
				$daterange1=$this->input->post('daterange1');
				$daterange2=$this->input->post('daterange2');
				
						
				if(strlen($daterange1) > 0){
				
				   $this->session->set_userdata('daterange1',$daterange1);
				   $this->session->set_userdata('daterange2',$daterange2);
				   
								  
				}
			    	$daterange1 = $this->session->userdata('daterange1'); 
					$daterange2 = $this->session->userdata('daterange2');
										
				
				
				$data['user_name']=$this->authex->get_user_name();
				$user_info = $this->authex->get_userdata();
				$data['level']=$user_info->level;
				
				$this->load->model('mod_journal');
				$data['records']= $this->mod_journal->journal_list($daterange1,$daterange2);
				
				$this->load->model('mod_journal');
				$data['accounts']= $this->mod_journal->get_all_accounts();
				
				$this->load->view('journal/view_journal_list',$data);	

    	 }
	
}



//---------------------------------------------- Payment Entry------------------------------

function payment() {
		
	$user_info = $this->authex->get_userdata();
	 if(($user_info->level > 1)){
    				
   	 redirect("error/"); 
   	 } else {
			
			$data['user_name']=$this->authex->get_user_name();
			$user_info = $this->authex->get_userdata();
			$data['level']=$user_info->level;
										
			$this->load->model('dropdown_items');
			$data['party_acc']= $this->dropdown_items->party_acc();
			
			$this->load->model('dropdown_items');
			$data['cash_bank_accounts']= $this->dropdown_items->cash_bank_accounts();
				
			$this->load->view('journal/view_add_payment',$data);	
    }		
}
	
function add_payment(){
	
	$user_info = $this->authex->get_userdata();
    if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    } else {
    	 	
    	 
			$user_id= $this->authex->get_user_id();
			$this->load->model('mod_journal');
			$data= $this->mod_journal->add_payment($user_id);
				
			echo $data;
			
    }		
	
}	
	

function payment_list_date(){
	
	$user_info = $this->authex->get_userdata();
    if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    } else {	
	
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;

		$this->load->model('dropdown_items');
		$data['party_acc']= $this->dropdown_items->party_acc();
							
		$this->load->view('journal/view_payment_list_date',$data);	
		
    }
}	

function payment_list(){
	
	$user_info = $this->authex->get_userdata();
    if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    } else {	
	
		$daterange1=$this->input->post('daterange1');
		$daterange2=$this->input->post('daterange2');
		$party_id=$this->input->post('party_id');
		
				
		if(strlen($daterange1) > 0){
		
		   $this->session->set_userdata('daterange1',$daterange1);
		   $this->session->set_userdata('daterange2',$daterange2);
		   $this->session->set_userdata('party_id',$party_id);
		   
						  
		}
	    	$daterange1 = $this->session->userdata('daterange1'); 
			$daterange2 = $this->session->userdata('daterange2');
			$party_id = $this->session->userdata('party_id');
			
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;

		$this->load->model('mod_journal');
		$data['records']= $this->mod_journal->payment_list($daterange1,$daterange2,$party_id);
		
		$this->load->model('mod_journal');
		$data['accounts']= $this->mod_journal->get_all_accounts();
							
		$this->load->view('journal/view_payment_list',$data);		
	
    }
    
}



//---------------------------------------------- Receipt Entry------------------------------
	
function receipt() {
			
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
									
		$this->load->model('dropdown_items');
		$data['cash_bank_accounts']= $this->dropdown_items->cash_bank__cheque_accounts();
		
		$this->load->model('dropdown_items');
		$data['party_acc']= $this->dropdown_items->party_acc();
			
		$this->load->view('journal/view_add_receipt',$data);	

}
	
function add_receipt(){
	
	$user_id= $this->authex->get_user_id();
	$this->load->model('mod_journal');
	$id= $this->mod_journal->add_receipt($user_id);
		
	$this->load->model('mod_journal');
	$data['accounts']= $this->mod_journal->get_all_accounts();		
		
	$this->load->model('mod_journal');
	$data['records']=$this->mod_journal->print_receipt_invoice($id);
	
	$data['back_link']="journal/receipt";
	$this->load->view('print/print_receipt_copy',$data);		
				
}			
		
	


function print_receipt($id){
	if(empty($id)){
		redirect("");
	} else {
		
	$this->load->model('mod_journal');
	$data['accounts']= $this->mod_journal->get_all_accounts();
		
	$this->load->model('mod_journal');
	$data['records']=$this->mod_journal->print_receipt_invoice($id);
	
	$data['back_link']="journal/receipt_list";		
	$this->load->view('print/print_receipt_copy',$data);
	}
}
	
function receipt_list_date(){
	
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
									
							
		$this->load->view('journal/view_receipt_list_date',$data);	
	
}

function receipt_list(){
	
		$daterange1=$this->input->post('daterange1');
		$daterange2=$this->input->post('daterange2');
		
				
		if(strlen($daterange1) > 0){
		
		   $this->session->set_userdata('daterange1',$daterange1);
		   $this->session->set_userdata('daterange2',$daterange2);
		   
						  
		}
	    	$daterange1 = $this->session->userdata('daterange1'); 
			$daterange2 = $this->session->userdata('daterange2');
			
			
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;

		$this->load->model('mod_journal');
		$data['records']= $this->mod_journal->receipt_list($daterange1,$daterange2);
		
		$this->load->model('mod_journal');
		$data['accounts']= $this->mod_journal->get_all_accounts();
							
		$this->load->view('journal/view_receipt_list',$data);		
	
	
}



//---------------------------------------------- Fund Transfer Entry------------------------------

function fund_transfer() {
		
	$user_info = $this->authex->get_userdata();
    if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    } else {	
	
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
									
		$this->load->model('dropdown_items');
		$data['deibt']= $this->dropdown_items->fund_transfer_accounts();
		
		$this->load->model('dropdown_items');
		$data['credit']= $this->dropdown_items->fund_transfer_accounts();
			
		$this->load->view('journal/view_add_fundtransfer',$data);	
    }
}

//---------------------------------------------- Cheque Schedule------------------------------


function cheque_sch_date(){
	
	$user_info = $this->authex->get_userdata();
    if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    } else {
	
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
									
							
		$this->load->view('journal/view_cheque_sch_date',$data);	
    }
	
}

function cheque_schedule(){
	
	
	$user_info = $this->authex->get_userdata();
    if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    } else {
	
		$daterange1=$this->input->post('daterange1');
		$daterange2=$this->input->post('daterange2');
		$cheque_type=$this->input->post('cheque_type');
		
				
		if(strlen($daterange1) > 0){
		
		   $this->session->set_userdata('daterange1',$daterange1);
		   $this->session->set_userdata('daterange2',$daterange2);
		    $this->session->set_userdata('cheque_type',$cheque_type);
		   
						  
		}
	    	$daterange1 = $this->session->userdata('daterange1'); 
			$daterange2 = $this->session->userdata('daterange2');
			$cheque_type = $this->session->userdata('cheque_type');
			
			
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
		
		$this->load->model('mod_journal');
		$data['accounts']= $this->mod_journal->get_all_accounts();
	
		if($cheque_type=='2') {
		
		$this->load->model('mod_journal');
		$data['records']= $this->mod_journal->paid_cheque_schedule($daterange1,$daterange2,$cheque_type);
												
		$this->load->view('journal/view_paid_cheque_schedule',$data);	
		
		}
		
		else {
			
			
		$this->load->model('mod_journal');
		$data['records']= $this->mod_journal->receipt_cheque_schedule($daterange1,$daterange2,$cheque_type);
										
		$this->load->view('journal/view_receipt_cheque_schedule',$data);	
			
			
			
		}
    }	
	
	
}



function change_payment_effect_date(){
	
	
$user_info = $this->authex->get_userdata();
    if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    } else {
    	
    	 $data['voucher_id'] = $this->uri->segment(3);	
    	 $data['date'] = $this->uri->segment(4);	
	
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;

								
		$this->load->view('journal/view_payment_effect_date',$data);	
		
    }
	
	
}

function updated_payment_effect_date(){
	
	$user_info = $this->authex->get_userdata();
    if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    } else {
	
			$this->load->model('mod_journal');
			$this->mod_journal->updated_payment_effect_date();
			
			redirect("journal/cheque_schedule");
	
    }
}


function change_paid_cheque_status(){
	
	$user_info = $this->authex->get_userdata();
    if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    } else {
	
	$user_id= $this->authex->get_user_id();
	
	$this->load->model('mod_journal');
	$data= $this->mod_journal->change_paid_cheque_status($user_id);
	
	redirect("journal/cheque_schedule");
	
    }
	
	
}

function change_receipt_cheque_status(){
	
	$user_info = $this->authex->get_userdata();
    if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    } else {
	
	$user_id= $this->authex->get_user_id();
	
	$this->load->model('mod_journal');
	$data= $this->mod_journal->change_receipt_cheque_status($user_id);
	
	redirect("journal/cheque_schedule");
	
    }
	
	
}
	
//------------------- Receipt Cheuqe



    
} 
    