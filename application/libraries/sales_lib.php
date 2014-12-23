<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_lib{

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
	
	
	function add_item($product_id,$quantity,$product_serial=NULL,$warranty=NULL,$purchase_id=NULL)
	{
	
	  $CI =& get_instance();

    $CI->db->select('product_id,product_item,brand_name,category_name,buy_price,selling_price');
	$CI->db->from('cane_products');
	$CI->db->join('cane_brand', 'cane_brand.brand_id = cane_products.brand_id');
	$CI->db->join('cane_category', 'cane_category.category_id = cane_products.category_id');
	$CI->db->where('product_id',$product_id);
	
	$query = $CI->db->get('');
   	$product_desc= $query->row()->category_name ." ". $query->row()->brand_name ." ". $query->row()->product_item;
	
	$buy_price=$query->row()->buy_price;
	$selling_price=$query->row()->selling_price;		
	
	$items = $this->get_cart();
		
		if(!empty($product_serial)) 
		{
		//add to existing array
			$array_head=$product_serial;
		}
		else
		{
		$array_head=$product_id;
		}
		
		$item = array($array_head=>
			array(
			    'product_id'=>$product_id,	
				'product_name'=>$product_desc,			
				'quantity'=>$quantity,
				'price'=>$selling_price,
				'buy_price'=>$buy_price,
				'product_serial'=>$product_serial,
				'warranty'=>$warranty,
				
				'purchase_id'=>$purchase_id
				
				)
			);
		// For products with serial
		if(!empty($product_serial)) 
		{
		//add to existing array
			$items+=$item;
		}
		//for products without serial
		else
		{	
				//Item already exists, add to quantity
				if(isset($items[$product_id]))
				{
					$items[$product_id]['quantity']+=$quantity;
					
				}
				else
				{
					//add to existing array
					$items+=$item;
				}
		}		
		
		$this->set_cart($items);
		return true;
		
	}
	
	
	function edit_item($product_id,$quantity,$price)
	{
		$items = $this->get_cart();
		if(isset($items[$product_id]))
		{
			$items[$product_id]['quantity'] = $quantity;
			$items[$product_id]['price'] = $price;
			$this->set_cart($items);	
		}
		
		return false;
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
	
	function get_product_id($product_serial){
	
	$CI =& get_instance();
	
 	$query = $CI->db->query("SELECT cane_products.product_id,product_warranty,purchase_id FROM cane_product_serials 
							 LEFT JOIN cane_products ON cane_products.product_id=cane_product_serials.product_id
							 WHERE product_serial='$product_serial' AND in_stock >'0'"); 							
                                  
			if ($query->num_rows() > 0){

				$data['product_id']=$query->row()->product_id;
				$data['product_warranty']=$query->row()->product_warranty;
				
				$data['purchase_id']=$query->row()->purchase_id;
				
				return $data;
				
			} else {
				
				return  FALSE; 
			}
             
	}
	
	function sufficient_quantity($product_id,$quantity)
	{
		$CI =& get_instance();
		$items = $this->get_cart();
		
		if(isset($items[$product_id]))
		{
		
		$cart_quantity= $items[$product_id]['quantity'];
		} 
		else
		{
		$cart_quantity=0;
		} 
		
		$query = $CI->db->query("SELECT in_stock FROM cane_products WHERE product_id='$product_id'"); 
			                                  
		if ($query->num_rows() > 0)
		{
			
		$in_stock=$query->row()->in_stock;	
				
		}	
		
		$total_quantity_req= $quantity+$cart_quantity;
		
				if($in_stock>=$total_quantity_req)
				{
					return true;
				}
				else {
				    return false;
				}
			
	}
	
	
	

 }