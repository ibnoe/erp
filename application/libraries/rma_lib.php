<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rma_lib{

	var $CI;
  
  	function __construct()
	{
		$this->CI =& get_instance();
		
		    //load libraries
    $this->CI->load->library('session');
	$this->CI->load->database();
	
	}

	function get_cart()
	{
		if(!$this->CI->session->userdata('cart'))
			$this->set_cart(array());
		
		return $this->CI->session->userdata('cart');
	}
	
	function set_cart($cart_data)
	{
		$this->CI->session->set_userdata('cart',$cart_data);
	}
	
	
	function add_delivery_item($product_serial,$rep_product_id,$delivery_serial,$acc_rec,$acc_pay)
	{
	
	  $CI =& get_instance();
	
 	$query = $CI->db->query("
	
		SELECT
		e.product_id, 
		brand_name,
		category_name,
		product_item,
		sold_product_serial,
		sold_date,
		invoice_number 
		FROM cane_sales_details

		LEFT JOIN  cane_sales_p_serials ON  cane_sales_p_serials.sold_details_id =cane_sales_details.sales_details_id
		LEFT JOIN cane_sales ON cane_sales.id=cane_sales_details.sales_id
		LEFT JOIN (
			SELECT product_id,brand_name,category_name,product_item FROM cane_products
			LEFT JOIN cane_category ON cane_category.category_id=cane_products.category_id 
			LEFT JOIN cane_brand ON cane_brand.brand_id=cane_products.brand_id
	  	 ) e ON e.product_id=cane_sales_details.product_id
		WHERE sold_product_serial='$product_serial'
	"); 	
	
		$query2 = $CI->db->query("
	
		SELECT
		product_item,
		product_id,  
		cane_brand.brand_name,
		cane_category.category_name
		
		FROM cane_products
		LEFT JOIN cane_brand ON cane_brand.brand_id = cane_products.brand_id
		LEFT JOIN cane_category ON cane_category.category_id = cane_products.category_id
		WHERE product_id='$rep_product_id'
	");							




		
	if ($query2->num_rows() > 0){
				
				$new_product_id=$query2->row()->product_id;
				$new_product_name=$query2->row()->brand_name." ". $query2->row()->category_name. " ". $query2->row()->product_item ;
				$new_serial=$delivery_serial;
				
	}	
		
			if ($query->num_rows() > 0){
				
				$product_id=$query->row()->product_id;
				$product_desc=$query->row()->brand_name. " ". $query->row()->category_name." ". $query->row()->product_item;
				$product_serial=$query->row()->sold_product_serial;
				$sold_date=$query->row()->sold_date;
				$sold_invoice=$query->row()->invoice_number;
				
					
			$items = $this->get_cart();
				
				
				$item = array($product_serial=>
					array(
						'product_serial'=>$product_serial,	
						'product_name'=>$product_desc,			
						'product_id'=>$product_id,
						'sold_date'=>$sold_date,
						'sold_invoice'=>$sold_invoice,
						'new_product_id'=>$new_product_id,
						'new_product_name'=>$new_product_name,
						'new_serial'=>$new_serial,
						'acc_rec'=>$acc_rec,
						'acc_pay'=>$acc_pay											
						
						)
					);
					
				//add to existing array
				$items+=$item;
				
				$this->set_cart($items);
				return true;
			}	
	}
	
	
	
	
	function delete_item($product_id)
	{
		$items=$this->get_cart();
		unset($items[$product_id]);
		$this->set_cart($items);
	}
	
	function if_already_in_cart($product_serial)
	{
		$items = $this->get_cart();
		
		if(isset($items[$product_serial]))
		{
			return true;
			
		} else {
		
		   return false;
		}
	}
	
	function check_on_sold_items($product_serial){
	
	$CI =& get_instance();
	
 	$query = $CI->db->query("
	
		SELECT
		e.product_id, 
		brand_name,
		category_name,
		product_item,
		sold_product_serial,
		sold_date,
		invoice_number 
		FROM cane_sales_details

		LEFT JOIN  cane_sales_p_serials ON  cane_sales_p_serials.sold_details_id =cane_sales_details.sales_details_id
		LEFT JOIN cane_sales ON cane_sales.id=cane_sales_details.sales_id
		LEFT JOIN (
			SELECT product_id,brand_name,category_name,product_item FROM cane_products
			LEFT JOIN cane_category ON cane_category.category_id=cane_products.category_id 
			LEFT JOIN cane_brand ON cane_brand.brand_id=cane_products.brand_id
	  	 ) e ON e.product_id=cane_sales_details.product_id
		WHERE sold_product_serial='$product_serial'
	"); 								
                                  
		if ($query->num_rows() > 0){
				
				$product_id=$query->row()->product_id;
				$brand_name=$query->row()->brand_name;
				$category_name=$query->row()->category_name;
				$product_item=$query->row()->product_item;
				$sold_product_serial=$query->row()->sold_product_serial;
				$sold_date=$query->row()->sold_date;
				$invoice_number=$query->row()->invoice_number;
						
			$items = $this->get_cart();
				
				
				$item = array($sold_product_serial=>
					array(
						'product_id'=>$product_id,	
						'brand_name'=>$brand_name,			
						'category_name'=>$category_name,
						'product_item'=>$product_item,
						'sold_product_serial'=>$sold_product_serial,
						'sold_date'=>$sold_date,
						'invoice_number'=>$invoice_number,
						
						)
					);
					
				//add to existing array
				$items+=$item;
				
				$this->set_cart($items);
				return true;
				
				
				
				
				
		} else {
				
				return  FALSE; 
		}
             
	}
	
	function if_already_exists_in_warranty($product_serial)
	{
	
	$CI =& get_instance();
	
 	$query = $CI->db->query("SELECT warr_id FROM cane_warranty_items WHERE on_warranty_serial='$product_serial' AND problem_solved='0'"); 								
                                  
		if ($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
		  return false;
		}	
	}
	
	
	
	

 }