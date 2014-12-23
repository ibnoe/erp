<?php
class Sales extends CI_Controller{

function __construct()
    {
        parent::__construct();
        
       include 'parent_construct.php';
        
    }
    
//  ----------------------------------------------- Cash and Party sale -----------------------
	
    
	function cash()
	{
		$this->session->unset_userdata('cart');
		$this->load->model('dropdown_items');
		$data['dropdown_category'] = $this->dropdown_items->non_serial_category();
		$data['page_title'] = 'Cash Sale';
		$data['main_content'] = 'sales/view_sale_cash';
		$this->load->view('includes/template', $data);
	}
	
	function add_to_cart_cash()
	{
		$without_serial = $this->input->post('without_serial');
		$this->load->library('sales_lib');
		
		if (empty($without_serial))
		{
			$product_serial = $this->input->post('product_serial');
			$info = $this->sales_lib->get_product_id($product_serial);
			$product_id = $info['product_id'];
			$warranty = $info['product_warranty'];
			$purchase_id = $info['purchase_id'];
			if (!$product_id)
			{
				echo "2"; // Product Not Available
			}
			else
			{
				if ($this->sales_lib->if_already_in_cart($product_serial))
				{
					echo "3"; // Already in the cart
				}
				else
				{
					$this->sales_lib->add_item($product_id, '1', $product_serial, $warranty, $purchase_id);
					$data['cart'] = $this->sales_lib->get_cart();
					$this->load->view('sales/sales_helper_cash', $data);
				}
			}
		}
	
		// End of if without serial
	
		else
		{
			$product_id = $this->input->post('product_id');
			$quantity = $this->input->post('quantity');
			if (!$this->sales_lib->sufficient_quantity($product_id, $quantity))
			{
				echo "2"; // Not Sufficent Product
			}
			else
			{
				$this->sales_lib->add_item($product_id, $quantity, '', '', '', '');
				$data['cart'] = $this->sales_lib->get_cart();
				$this->load->view('sales/sales_helper_cash', $data);
			}
		}
	}
	
	function confirm_cash_sales()
	{
		$this->load->model('mod_sales');
		$autovalue = $this->mod_sales->confirm_cash_sales();
		$this->load->model('mod_sales');
		$data['records1'] = $this->mod_sales->cash_printing1($autovalue);
		$this->load->model('mod_sales');
		$data['records2'] = $this->mod_sales->cash_printing2($autovalue);
		$this->load->view('print/print_invoice_cash', $data);
	} 
	
	
	
	
	function party()
	{
					
		$this->session->unset_userdata('cart');
		
		$this->load->model('dropdown_items');
		$data['dropdown_category']= $this->dropdown_items->non_serial_category();
						
		$data['page_title'] = 'Party Sale';
		$data['main_content'] = 'sales/view_sale_party';
		$this->load->view('includes/template', $data);

	
	}
	

	function add_to_cart_party()
	{
		$without_serial = $this->input->post('without_serial');
		$this->load->library('sales_lib');
		if (empty($without_serial))
		{
			$product_serial = $this->input->post('product_serial');
			$info = $this->sales_lib->get_product_id($product_serial);
			$product_id = $info['product_id'];
			$warranty = $info['product_warranty'];
			$purchase_id = $info['purchase_id'];
			if (!$product_id)
			{
				echo "2"; // Product Not Available
			}
			else
			{
				if ($this->sales_lib->if_already_in_cart($product_serial))
				{
					echo "3"; // Already in the cart
				}
				else
				{
					$this->sales_lib->add_item($product_id, '1', $product_serial, $warranty, $purchase_id);
					$data['cart'] = $this->sales_lib->get_cart();
					$this->load->view('sales/sales_helper_party', $data);
				}
			}
		}
	
		// End of if without serial
	
		else
		{
			$product_id = $this->input->post('product_id');
			$quantity = $this->input->post('quantity');
			if (!$this->sales_lib->sufficient_quantity($product_id, $quantity))
			{
				echo "2"; // Not Sufficent Product
			}
			else
			{
				$this->sales_lib->add_item($product_id, $quantity, '', '', '', '');
				$data['cart'] = $this->sales_lib->get_cart();
				$this->load->view('sales/sales_helper_party', $data);
			}
		}
	}

	function edit_cart_items()
	{
		$product_id = trim($this->input->post('product_id'));
		$quantity = trim($this->input->post('quantity'));
		$price = trim($this->input->post('price'));
		$this->load->library('sales_lib');
		$this->sales_lib->edit_item($product_id, $quantity, $price);
	}
	
	function delete_cart_item_cash()
	{
		$product_id = trim($this->input->post('id'));
		$this->load->library('sales_lib');
		$this->sales_lib->delete_item($product_id);
		$data['cart'] = $this->sales_lib->get_cart();
		$this->load->view('sales/sales_helper_cash', $data);
	}
	
	function delete_cart_item_party()
	{
		$product_id = trim($this->input->post('id'));
		$this->load->library('sales_lib');
		$this->sales_lib->delete_item($product_id);
		$data['cart'] = $this->sales_lib->get_cart();
		$this->load->view('sales/sales_helper_party', $data);
	}
  
 	
	
	function confirm_party_sales()
	{		
			
		$this->load->model('mod_sales');
		$autovalue=$this->mod_sales->confirm_party_sales();				
						
		$this->load->model('mod_sales');
		$data['records1']=$this->mod_sales->party_printing1($autovalue);
					
		$this->load->model('mod_sales');
		$data['records2']=$this->mod_sales->party_printing2($autovalue);		
			
		$this->load->view('print/print_invoice_party',$data);
					
			
	}//ends

	function print_cashsales($id){

		
	$this->load->model('mod_sales');
	$data['records1']=$this->mod_sales->cash_printing1($id);
				
	$this->load->model('mod_sales');
	$data['records2']=$this->mod_sales->cash_printing2($id);
				
	$this->load->view('print/print_invoice_cash',$data);
		
	}

	function print_partysales($id){

		
	$this->load->model('mod_sales');
	$data['records1']=$this->mod_sales->party_printing1($id);
				
	$this->load->model('mod_sales');
	$data['records2']=$this->mod_sales->party_printing2($id);
				
	$this->load->view('print/print_invoice_party',$data);
		
}



// ------------------------------Sales Return------------------------- 

function sales_return(){
	
$user_info = $this->authex->get_userdata();
    	 if(($user_info->level > 1)){
    				
          	 redirect("error/"); 
          	 
    	 } else {
    	 	
    	$this->session->unset_userdata('cart');
    	
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
		$user_id=$user_info->admin_id;
		
		$this->load->model('dropdown_items');
		$data['dropdown_category']= $this->dropdown_items->category_names();
		
			
		$this->load->view('sales/view_sales_return',$data);
    	}
	
}//Function ends

	function check_sales_voucher()
	{
		
		$this->load->model('mod_sales');
		$value= $this->mod_sales->check_sales_voucher();
				                                  
		if ($value)
		{ 
			echo "true"; 
		} 
		else 
		{
			echo "false";
		}
		
	}


function sales_return_add_to_cart(){
  	
  	
  	$product_id=trim($this->input->post('product_id'));
  	$quantity=trim($this->input->post('quantity'));
  	$price=trim($this->input->post('price'));
  	$unit_cost=trim($this->input->post('unit_cost'));
  	
  	$this->load->library('sales_return_lib');
	$this->sales_return_lib->add_item($product_id,$quantity,$price,$unit_cost);
	$data['cart']= $this->sales_return_lib->get_cart();
	
	$this->load->view('sales/sales_return_helper',$data);
  }
  
  function sales_return_edit_cart_items(){
  	
  	$product_id=trim($this->input->post('product_id'));
  	$quantity=trim($this->input->post('quantity'));
  	$price=trim($this->input->post('price'));
  	$unit_cost=trim($this->input->post('unit_cost'));
  	
  	$this->load->library('sales_return_lib');
	$this->sales_return_lib->edit_item($product_id,$quantity,$price,$unit_cost);
	 	
  }
  
function sales_return_delete_cart_item(){
  	
  	$product_id=trim($this->input->post('id'));
  	  	
  	$this->load->library('sales_return_lib');
	$this->sales_return_lib->delete_item($product_id);
	$data['cart']= $this->sales_return_lib->get_cart();
	
	$this->load->view('sales/sales_return_helper',$data);
	 	
  }
  
  function confirm_sales_return(){
  	
  	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$user_id=$user_info->admin_id;
		
	$this->load->model('mod_sales');
	$autovalue=$this->mod_sales->sales_return($user_id);
	
	$this->load->model('mod_sales');
	$data['records1']=$this->mod_sales->sales_return_printing1($autovalue);
				
	$this->load->model('mod_sales');
	$data['records2']=$this->mod_sales->sales_return_printing2($autovalue);
				
	$this->load->view('print/print_credit_note',$data);
 	
}



//-------------------------------Sales History------------------------------------

	function cash_select_date(){
	
	
		
		$this->load->view('sales/view_cash_sales_date',$data);			
	
	}

function cash_sales_history(){
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$daterange1=$this->input->post('daterange1');
	$daterange2=$this->input->post('daterange2');
			
	if(strlen($daterange1) > 0){
	
	   $this->session->set_userdata('daterange1',$daterange1);
	   $this->session->set_userdata('daterange2',$daterange2);
					  
	}
    	$daterange1 = $this->session->userdata('daterange1'); 
		$daterange2 = $this->session->userdata('daterange2');

	$this->load->model('mod_sales');
	$data['records']= $this->mod_sales->cash_sales_list($daterange1,$daterange2);
	
	
	$this->load->view('sales/view_cash_sales_list',$data);

	
	
}

function party_select_date(){
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
		
	$this->load->view('sales/view_party_sales_date',$data);			
	
}

function party_sales_history(){
	
	$data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$daterange1=$this->input->post('daterange1');
	$daterange2=$this->input->post('daterange2');
			
	if(strlen($daterange1) > 0){
	
	   $this->session->set_userdata('daterange1',$daterange1);
	   $this->session->set_userdata('daterange2',$daterange2);
					  
	}
    	$daterange1 = $this->session->userdata('daterange1'); 
		$daterange2 = $this->session->userdata('daterange2');

	$this->load->model('mod_sales');
	$data['records']= $this->mod_sales->party_sales_list($daterange1,$daterange2);
	
	
	$this->load->view('sales/view_party_sales_list',$data);

	
	
}


//------------------- Helper functions ----------------------------	
	
//Funtion to check product's availability 
function is_available_in_stock($product_serial){

 	$query = $this->db->query("SELECT cane_products.product_id FROM cane_product_serials 
 	LEFT JOIN cane_products ON cane_products.product_id=cane_product_serials.product_id
 	WHERE product_serial='$product_serial' AND in_stock >'0' AND sales_invoice_id IS NULL
 	");
                                  
			if ($query->num_rows() > 0){

				return TRUE;
				
			} else {
				
				return  FALSE; 
			}
             
}//function Ends  		
    

function is_already_in_temp_tbl($product_serial){
	
	$query = $this->db->query("SELECT id FROM cane_temp_invoice WHERE product_sku='$product_serial'");
	
		if ($query->num_rows() > 0){

				return TRUE;
				
			} else {
				
				return  FALSE; 
			}
	
}//ends





}   