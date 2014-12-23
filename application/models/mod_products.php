<?php
class Mod_products extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function add()
	{
		$category_id = trim($this->input->post('category_id'));
		$brand_id = trim($this->input->post('brand_id'));
		$product_item = trim($this->input->post('product_item'));
		$unit_name = trim($this->input->post('unit_name'));
		$is_serial_available = trim($this->input->post('is_serial_available'));
		$sku_number = trim($this->input->post('sku_number'));
		$selling_price = str_replace(',', '', trim($this->input->post('selling_price'))   );	
	
		$data = array(
				'product_id' => '',
				'category_id' => $category_id,
				'brand_id' => $brand_id,
				'product_item' => $product_item,
				'unit_name' => $unit_name,
				'sku_number' => $sku_number,
				'buy_price' => '0',
				'selling_price' => $selling_price,
				'in_stock' => '0',
				'is_serial_available' => $is_serial_available,
				
		);
		$this->db->insert('cane_products', $data);
		if($this->db->affected_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}	
	
	function get_all() 
	{	
		$getData = $this->db->query("		
		SELECT
		product_item,
		product_id,  
		cane_brand.brand_name,
		cane_category.category_name,
		unit_name,
		sku_number,				
		buy_price,
		selling_price,
		in_stock,	
		(CASE is_serial_available WHEN '1' THEN 'Yes' ELSE 'No' END) AS is_serial_available
		FROM cane_products
		LEFT JOIN cane_brand ON cane_brand.brand_id = cane_products.brand_id
		LEFT JOIN cane_category ON cane_category.category_id = cane_products.category_id
		ORDER BY cane_category.category_name ASC		
		");		
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
   function get_single_row($id)
   {
       $sql = "SELECT * FROM cane_products WHERE product_id = ?" ;
       $getData = $this->db->query($sql,array($id));
       if($getData->num_rows() > 0)
       return $getData->result_array();
       else
       return null;
   }


	
	function edit(){
		
		$product_id = trim($this->input->post('product_id'));
		$category_id = trim($this->input->post('category_id'));
		$brand_id = trim($this->input->post('brand_id'));
		$product_item = trim($this->input->post('product_item'));
		$unit_name = trim($this->input->post('unit_name'));
		$is_serial_available = trim($this->input->post('is_serial_available'));
		$sku_number = trim($this->input->post('sku_number'));
		$selling_price = str_replace(',', '', trim($this->input->post('selling_price'))   );		
		$data = array(
				
				'category_id' => $category_id,
				'brand_id' => $brand_id,
				'product_item' => $product_item,
				'unit_name' => $unit_name,
				'sku_number' => $sku_number,				
				'selling_price' => $selling_price,				
				'is_serial_available' => $is_serial_available,
		
		);		
		$this->db->where('product_id',$product_id);		
		$this->db->update('cane_products', $data);
		if($this->db->affected_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
	}
	
	function delete_item($id)
	{
		$query= $this->db->delete('cane_products', array('product_id' => $id));
		if($this->db->affected_rows() > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}	

	

}