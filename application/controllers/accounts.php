<?php
class Accounts extends CI_Controller{

	function __construct()
	{
		parent::__construct();

		include 'parent_construct.php';

    }

// ---------------------------------- Bank Accounts---------------------------------    

function bank(){
	
	$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
				
		
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
					
		$this->load->view('accounts/view_add_bank',$data);	
    }		
		
}
		
function bank_added(){
		
	$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
					
		
		$this->load->model('mod_accounts');
		$data= $this->mod_accounts->bank();
		
		echo $data;
		
    	  }	
		
}
	
function bank_list(){
	
	$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
	
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
		
		$this->load->model('mod_accounts');
		$data['records']= $this->mod_accounts->bank_list();
		
		$this->load->view('accounts/view_bank_list',$data);	
		
    }	
}
	
function edit_bank($id){
	
	$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
	
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
		
		$this->load->model('mod_accounts');
		$data['records']= $this->mod_accounts->get_bank_info($id);
		
		$this->load->view('accounts/view_edit_bank',$data);	
		
    	 }
		
}	
	
function bank_updated(){
	
	$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
	
			$this->load->model('mod_accounts');
			$data= $this->mod_accounts->bank_updated();
				
			echo $data;
    }		
	
}	

function delete_bank(){
	
	$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
	
		$id = mysql_real_escape_string($_POST['id']);
		
		$this->load->model('mod_accounts');
		$data= $this->mod_accounts->delete_bank($id);
		
		echo $data;		
		
    }	
} 
    


// ------------------------------ Expense Account--------------

function expense(){
	
	$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
		
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
					
		$this->load->view('accounts/view_add_expense',$data);

    	 }
	
}
		
function expense_added(){
	
	$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
		
		$this->load->model('mod_accounts');
		$data= $this->mod_accounts->expense();
		
		echo $data;
		
    }
}
	
function expense_list(){
	
	$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
	
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
		
		$this->load->model('mod_accounts');
		$data['records']= $this->mod_accounts->expense_list();
		
		$this->load->view('accounts/view_expense_list',$data);	
		
    	 }
}
	
function edit_expense($id){
	
	$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
	
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
		
		$this->load->model('mod_accounts');
		$data['records']= $this->mod_accounts->get_expense_info($id);
		
		$this->load->view('accounts/view_edit_expense',$data);	
		
   	 }	
}	
	
function expense_updated(){
	
	$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
	
			$this->load->model('mod_accounts');
			$data= $this->mod_accounts->expense_updated();
				
			echo $data;
			
    }		
	
}	

function delete_expense(){
	
	$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    	 } else {
	
		$id = mysql_real_escape_string($_POST['id']);
		
		$this->load->model('mod_accounts');
		$data= $this->mod_accounts->delete_expense($id);
		
		echo $data;	

    }	
    
    
}


    
}

