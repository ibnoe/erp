<?php
class Report extends CI_Controller{


function __construct()
    {
        parent::__construct();
        
       include 'parent_construct.php';
        
    }
 
//------------------------------------------------------- Ledger --------------------    
    
   function ledger_date(){
    	
   $user_info = $this->authex->get_userdata();
   if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
          	 
   } else {	
    	
    $data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->model('dropdown_items');
	$data['getall_accounts']= $this->dropdown_items->getall_accounts();
	
	$this->load->view('report/view_ledger_date',$data);	

    }
	
}
    
 function party_ledger_date(){
 	
   $user_info = $this->authex->get_userdata();
   if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
          	 
    	 } else {
 	
 	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->model('dropdown_items');
	$data['party_acc']= $this->dropdown_items->party_acc();
	
	$this->load->view('report/view_party_ledger_date',$data);

    }
    
}


function ledger(){
	
  $user_info = $this->authex->get_userdata();
   if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
          	 
    } else {
    	
 	$daterange1=$this->input->post('daterange1');
    $daterange2=$this->input->post('daterange2');
	$account_id=$this->input->post('account_id');
    	
    if(empty($daterange1)) {
    	
    	redirect('report/ledger_date');
    }	else {

	$daterange1=date("Y-m-d", strtotime($daterange1));
    $daterange2=date("Y-m-d", strtotime($daterange2));	
		

    $data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	
	$this->load->model('mod_report');
	$data['records']= $this->mod_report->ledger($daterange1,$daterange2,$account_id);
	
	$this->load->model('mod_report');
	$info= $this->mod_report->ledger_begining_bal($daterange1,$daterange2,$account_id);
	$data['op_balance']= $info['op_balance']; 
	$data['account_name']= $info['account_name'];

	$data['daterange1']=date("d-m-Y", strtotime($daterange1));
	
	if($info['side']=='D'){
		
		$this->load->view('report/view_ledger_dbalance',$data);	
		
	} else {
		
		$this->load->view('report/view_ledger_cbalance',$data);
		
	}
	
	
    }

    }
	
}

//------------------------------------------------------- End of Ledger --------------------    


//------------------------------------------------------- Income Statement-------------------- 

function income_daterange(){
	
   $user_info = $this->authex->get_userdata();
   if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
          	 
    } else {
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	
	$this->load->view('report/view_income_statement_date',$data);	

    }
	
}

function income_statement(){
		
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
		
	    
	// Sales		
	$this->load->model('mod_report');
	$debit = $this->mod_report->get_balance_dr($daterange1,$daterange2,'2');
	$this->load->model('mod_report');
	$credit = $this->mod_report->get_balance_cr($daterange1,$daterange2,'2');
	
	$data['sales']= $credit-$debit ;
	
	//Marketing Rebate
	$this->load->model('mod_report');
	$debit = $this->mod_report->get_balance_dr($daterange1,$daterange2,'18');
	$this->load->model('mod_report');
	$credit = $this->mod_report->get_balance_cr($daterange1,$daterange2,'18');
	
	$data['rebate']= $debit-$credit ;

	//Sales Return
	$this->load->model('mod_report');
	$debit = $this->mod_report->get_balance_dr($daterange1,$daterange2,'5');
	$this->load->model('mod_report');
	$credit = $this->mod_report->get_balance_cr($daterange1,$daterange2,'5');
	
	$data['sales_return']= $debit-$credit ;
	
	//COGS
	$this->load->model('mod_report');
	$debit = $this->mod_report->get_balance_dr($daterange1,$daterange2,'4');
	$this->load->model('mod_report');
	$credit = $this->mod_report->get_balance_cr($daterange1,$daterange2,'4');
	
	$data['cogs']= $debit-$credit ;
	
	//Expenses
	$this->load->model('mod_report');
	$data['expenses']= $this->mod_report->get_expenses($daterange1,$daterange2);
	
	//Income From Other Sources
	$this->load->model('mod_report');
	$debit = $this->mod_report->get_balance_dr($daterange1,$daterange2,'12');
	$this->load->model('mod_report');
	$credit = $this->mod_report->get_balance_cr($daterange1,$daterange2,'12');
	
	$data['income_frm_other_src']= $credit-$debit ;
	
	$data['daterange1']= date("d-m-Y", strtotime($daterange1));
	$data['daterange2']= date("d-m-Y", strtotime($daterange2));
	
		
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->view('report/view_income_statement',$data);	
	
    }
	
}
	
	
	
//-------------------------------------------------------  End of Income Statement--------------------     
 


function currentbl_sl_account(){
	
	$user_info = $this->authex->get_userdata();
   if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
          	 
    } else {
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->model('dropdown_items');
	$data['getall_accounts']= $this->dropdown_items->getall_accounts();
	
	$this->load->view('report/view_cur_bl_sl_account',$data);

    }
	
}

function check_current_balance(){
	
   $user_info = $this->authex->get_userdata();
   if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
          	 
    } else {
	
	$daterange2=date("Y-m-d");
	$account_id=$this->input->post('account_id');
	
	if(empty($account_id)){
		
		redirect('report/currentbl_sl_account');
		
	} else { 
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	
	
	$this->load->model('mod_report');
	$info= $this->mod_report->check_account_type($account_id);
	$data['account_name']=$info['account_name'];
	
	$this->load->model('mod_report');
	$debit = $this->mod_report->cur_balance_dr($daterange2,$account_id);
	$this->load->model('mod_report');
	$credit = $this->mod_report->cur_balance_cr($daterange2,$account_id);
	$this->load->model('mod_report');
	$begining_balance = $this->mod_report->curr_beg_balance($daterange2,$account_id);
	
	if($info['side']=='C'){
		
	$data['balance']= ($begining_balance+$credit)-$debit ;
	
	} else {
	$data['balance']= ($begining_balance+$debit)-$credit ;	
		
	}
	$this->load->view('report/view_current_balance',$data);	
	
	
	}
	
    }
	
}


//------ Total Cash Collected -----------

function cash_collected(){
	
   $user_info = $this->authex->get_userdata();
   if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
          	 
    } else {
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->model('dropdown_items');
	$data['software_users']= $this->dropdown_items->software_users();
	
	$this->load->view('report/view_cash_collected',$data);	
	
    }
	
}

function cash_collection_fetch(){
	
   $user_info = $this->authex->get_userdata();
   if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
          	 
    } else {
	
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
		
	$this->load->model('mod_report');
	$balance= $this->mod_report->cash_collected();
	echo "Collected Amount: ". number_format($balance) ;
	
    }
	
}


function accounts_rec_pay(){
	
$user_info = $this->authex->get_userdata();
   if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
          	 
    } else {
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
			
	$this->load->view('report/view_accounts_rec_pay',$data);	
	
    }
	
}


function accounts_rec_pay_fetch(){
	
   $user_info = $this->authex->get_userdata();
   if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
          	 
    } else {
	
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
		
	$this->load->model('mod_report');
	$balance= $this->mod_report->accounts_rec_pay();
	echo "Amount: " . number_format($balance) ;
	
    }
	
}


    
}    