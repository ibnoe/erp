<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_return_lib{

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
	
	
	function add_item($product_id,$quantity,$price,$unit_cost)
	{
	
	  $CI =& get_instance();

    $CI->db->select('product_id,product_item,brand_name,category_name');
	$CI->db->from('cane_products');
	$CI->db->join('cane_brand', 'cane_brand.brand_id = cane_products.brand_id');
	$CI->db->join('cane_category', 'cane_category.category_id = cane_products.category_id');
	$CI->db->where('product_id',$product_id);
	
	$query = $CI->db->get('');
   	$product_desc= $query->row()->category_name ." ". $query->row()->brand_name ." ". $query->row()->product_item;
	
	$product_id=$query->row()->product_id;		
	
	$items = $this->get_cart();
		
		
		$item = array($product_id=>
			array(
			    'product_id'=>$product_id,	
				'product_name'=>$product_desc,			
				'quantity'=>$quantity,
				'price'=>$price,
				'unit_cost'=>$unit_cost,
				
				)
			);
			
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
		
		$this->set_cart($items);
		return true;
		
	}
	
	
	function edit_item($product_id,$quantity,$price,$unit_cost)
	{
		$items = $this->get_cart();
		if(isset($items[$product_id]))
		{
			$items[$product_id]['quantity'] = $quantity;
			$items[$product_id]['price'] = $price;
			$items[$product_id]['unit_cost'] = $unit_cost;
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
	

 }