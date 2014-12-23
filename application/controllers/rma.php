<?php
class Rma extends CI_Controller{

function __construct()
    {
        parent::__construct();
        
       include 'parent_construct.php';
        
    }
    
function add_to_warranty(){
		
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
		$user_id=$user_info->admin_id;
			
		$this->session->unset_userdata('cart');
		
		$this->load->model('dropdown_items');
		$data['dropdown_category']= $this->dropdown_items->non_serial_category();
		
		$this->load->view('rma/view_add_to_warranty',$data);

	
}//function ends


function add_to_cart_warranty(){
	
	$product_serial=$this->input->post('product_serial');	
		
	$this->load->library('rma_lib');	
	
		
	if($this->rma_lib->if_already_exists_in_warranty($product_serial)){
		
		echo "3"; // Product Already Exists in Warranty List
	}
		
		
	elseif(!$info=$this->rma_lib->check_on_sold_items($product_serial)){
		
		echo "2" ; // Product Was not sold or found 
		
	} 
	
	else {
		
							
			$data['cart']= $this->rma_lib->get_cart();
			$this->load->view('rma/warranty_helper',$data);	
	}
	
}

function delete_cart_item_warranty(){
  	
  	$product_id=trim($this->input->post('id'));
  	  	
  	$this->load->library('rma_lib');
	$this->rma_lib->delete_item($product_id);
	$data['cart']= $this->rma_lib->get_cart();
	$this->load->view('rma/warranty_helper',$data);	
	 	
  } 

 function confirm_warranty(){
 	
 	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$user_id=$user_info->admin_id;
			
	$this->load->model('mod_rma');
	$autovalue=$this->mod_rma->add_to_warranty($user_id);
			
	$this->load->model('mod_rma');
	$data['records1']=$this->mod_rma->warranty_printing1($autovalue);
			
	$this->load->model('mod_rma');
	$data['records2']=$this->mod_rma->warranty_printing2($autovalue);
			
	$this->load->view('print/print_warranty_claim',$data);
 	
 } 

function product_on_warranty_date(){
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
									
	$this->load->view('rma/view_onwarranty_date',$data);
	
}

function product_on_warranty_list(){
	
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

		$this->load->model('mod_rma');
		$data['records']= $this->mod_rma->product_on_warranty_list($daterange1,$daterange2);
		
									
		$this->load->view('rma/view_product_on_warranty_list',$data);		
	
}

function delete_product_on_warranty(){
	
	
	$this->load->model('mod_rma');
	$data= $this->mod_rma->delete_product_on_warranty();
	echo $data;
}


function search_warranty_invoice(){
		
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
												
		$this->load->view('rma/view_search_warranty_inv',$data);
	
	
}

function get_warranty_invoice(){
	
	$this->load->model('mod_rma');
	$autovalue=$this->mod_rma->if_valid_warranty_invoice_info();
	
	if($autovalue) {
	
	$this->load->model('mod_rma');
	$data['records1']=$this->mod_rma->warranty_printing1($autovalue);
			
	$this->load->model('mod_rma');
	$data['records2']=$this->mod_rma->warranty_printing2($autovalue);
		
									
	$this->load->view('rma/warr_inv_search_helper',$data);	
	
	} else {
		
		echo "0";
	}
}

//-------------------------------------------------------Warranty Delivery Product--------------

function deliver_product(){
	
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
		$user_id=$user_info->admin_id;
			
		$this->session->unset_userdata('cart');

		$this->load->model('dropdown_items');
		$data['dropdown_category']= $this->dropdown_items->enter_serial_category();
		
		$this->load->view('rma/view_add_deliver_products',$data);
	


}


function get_serial_brands(){
  				
	$category_id = mysql_real_escape_string($_POST['category_id']);
		
	$this->load->model('dropdown_items');
	$output= $this->dropdown_items->get_serial_brands($category_id);
	
    echo $output; 
  }
  
function get_serial_products(){
  				
	$category_id = mysql_real_escape_string($_POST['category_id']);
	$brand_id = mysql_real_escape_string($_POST['brand_id']);
		
	$this->load->model('dropdown_items');
	$output= $this->dropdown_items->get_serial_products($category_id,$brand_id);
	
    echo $output; 
  }

function add_to_cart_delivery(){
	
	$product_serial=$this->input->post('product_serial');
	$rep_product_id=$this->input->post('product_id');
	$delivery_serial=$this->input->post('delivery_serial');	
	
	$acc_rec=$this->input->post('acc_rec');
	$acc_pay=$this->input->post('acc_pay');	
		
	$this->load->library('rma_lib');	
	
		
	if(!$this->rma_lib->if_already_exists_in_warranty($product_serial)){
		
		echo "3"; // Couldn't Find the product in warrany list
	}
		
	
	else {
			$this->rma_lib->add_delivery_item($product_serial,$rep_product_id,$delivery_serial,$acc_rec,$acc_pay);
							
			$data['cart']= $this->rma_lib->get_cart();
			$this->load->view('rma/delivery_helper',$data);	
	}
	
}

function delete_cart_item_delivery(){
	
	$product_serial=trim($this->input->post('id'));
  	  	
  	$this->load->library('rma_lib');
	$this->rma_lib->delete_item($product_serial);
	$data['cart']= $this->rma_lib->get_cart();
	$this->load->view('rma/delivery_helper',$data);	
	
}

function confirm_product_delivery(){
	
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$user_id=$user_info->admin_id;
			
	$this->load->model('mod_rma');
	$autovalue=$this->mod_rma->confirm_product_delivery($user_id);

	$this->load->model('mod_rma');
	$data['records1']=$this->mod_rma->delivered_item_print1($autovalue);
			
	$this->load->model('mod_rma');
	$data['records2']=$this->mod_rma->delivered_item_print2($autovalue);
		
									
	$this->load->view('print/print_rma_return_invoice',$data);	
	
	
	
}


	
	

    
    
}    