<?php
class Search extends CI_Controller{

function __construct()
    {
        parent::__construct();
        
       include 'parent_construct.php';
        
    }


 // ------------------------ Product Search------------   
  function search_inventory(){
  	
  	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->view('search/view_search_inventory',$data);
  	
  }  
    

	
function search_inventory_result(){
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
		
	$this->load->model('mod_search');
	$data['records']= $this->mod_search->search_inventory();
		
	$this->load->view('search/inventory_helper',$data);	
		
}		

//-----------------------  Sales Invoice Search-------------

function search_invoice(){

	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->view('search/view_search_invoice',$data);
		
}
	
	
	
function search_invoice_result(){
	
	$user_info = $this->authex->get_userdata();

	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	
	$serial=trim($this->input->post('serial'));
	$search_by=trim($this->input->post('search_by'));
	
			if($search_by=='2') {
		
			$this->load->model('mod_search');
			$sales_id= $this->mod_search->get_invoice_num($serial);
						
			} else {
		
			$this->load->model('mod_search');
			$sales_id= $this->mod_search->getcheck_valid_invoice($serial);
			
			}		
			
			$this->load->model('mod_search');
			$data['records1']=$this->mod_search->get_invoice($sales_id);
						
			$this->load->model('mod_search');
			$data['records2']=$this->mod_search->get_products($sales_id);
	
			$this->load->view('search/view_invoice_helper',$data);
	
			
}// function ends


//-------------------------------- Search Credit Memo Invoice--------------------

function search_credit_memo(){

	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->view('search/view_search_credit_memo',$data);
		
}



function search_credit_memo_result(){
	
	$user_info = $this->authex->get_userdata();

	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
			
	$this->load->model('mod_search');
	$id=$this->mod_search->search_credit_memo();
	
	$this->load->model('mod_sales');
	$data['records1']=$this->mod_sales->sales_return_printing1($id);
				
	$this->load->model('mod_sales');
	$data['records2']=$this->mod_sales->sales_return_printing2($id);
	
	$this->load->view('search/credit_memo_helper',$data);
	
			
}// function ends


//-------------------------------- Search Purchase Voucher--------------------

function search_purchase_voucher(){
	
	$user_info = $this->authex->get_userdata();
    if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    } else {
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->view('search/view_search_purchase_voucher',$data);
	
    }
		
}

function search_purchase_voucher_result(){
	
	$user_info = $this->authex->get_userdata();
    if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
    } else {
	
	$user_info = $this->authex->get_userdata();

	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
			
	$this->load->model('mod_search');
	$data['records']=$this->mod_search->search_purchase_voucher();
	
	$this->load->view('search/purchase_voucher_helper',$data);
	
    }
	
			
}// function ends



//-------------------------------- Search Product By party--------------------

function search_product_byparty(){
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->model('dropdown_items');
	$data['dropdown_parties']= $this->dropdown_items->parties();
	
	$this->load->view('search/view_product_byparty_select',$data);
	
	
}

function search_product_byparty_result(){
	
	$party_id=trim($this->input->post('party_id'));
				
	if(strlen($party_id) > 0){
	
	   $this->session->set_userdata('party_id',$party_id);
	   					  
	}
    $party_id = $this->session->userdata('party_id'); 
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->model('mod_search');
	$data['records']= $this->mod_search->search_product_byparty($party_id);
	$data['partyname']= $data['records'][0]['party_name'];
	
	$this->load->view('search/view_product_byparty',$data);
	
	
}


//------------------------ Cheque


function verify_cheque(){
	
	$user_info = $this->authex->get_userdata();
    			
   	if(($user_info->level > 1)){
    	
    	 redirect("error/"); 
    } else {
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->view('search/view_verify_cheque',$data);
	
    }
    
}

function verify_cheque_result(){
	
	$user_info = $this->authex->get_userdata();
    			
   	if(($user_info->level > 1)){
    	
    	 redirect("error/"); 
    } else {
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->model('mod_accounts');
	$data['accounts']= $this->mod_accounts->get_all_accounts();
	
	$this->load->model('mod_search');
	$data['records']=$this->mod_search->verify_cheque_result();
	
	$this->load->view('search/view_cheque_result',$data);
	
    }
	
}

// -------------------------- RMA Warranty-------------------------------

function search_rma_invoice(){
	
	$user_info = $this->authex->get_userdata();
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->view('search/view_search_rma_invoice',$data);
		
    
	
}
function search_rma_invoice_result(){
		
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->model('mod_search');
	$invoice_num=$this->mod_search->check_rma_invoice();
	
	if($invoice_num) {
	
	$this->load->model('mod_rma');
	$data['records1']=$this->mod_rma->delivered_item_print1($invoice_num);
			
	$this->load->model('mod_rma');
	$data['records2']=$this->mod_rma->delivered_item_print2($invoice_num);
			
	$this->load->view('search/rma_invoice_helper',$data);
	
	} else {
		
		echo "0";
	}
			
}			
		
		
	
		
	
	
	
	
	



}	