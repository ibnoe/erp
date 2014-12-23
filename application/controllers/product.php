<?php
class Product extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       include 'parent_construct.php';
   }	
	
   function add()
   {
   	$this->load->library('form_validation');
   	$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
   	
   	$this->form_validation->set_rules('category_id', 'Category Name', 'required');
   	$this->form_validation->set_rules('brand_id', 'Brand Name', 'required');
   	$this->form_validation->set_rules('product_item', 'Product', 'required|callback_check_if_unique_product');
   	$this->form_validation->set_rules('unit_name', 'Unit Name', 'required');   	
   	$this->form_validation->set_rules('sku_number', 'SKU', 'required|callback_check_if_unique_sku');
   	$this->form_validation->set_rules('selling_price', 'Selling Price', 'required');
   	$this->form_validation->set_rules('is_serial_available', 'Serial Availablity', 'required');
   	
   
   	if ($this->form_validation->run() == FALSE) 
   	{
   		$this->load->model('dropdown_items');
   		$data['dropdown_category']= $this->dropdown_items->category_names();
   		
   		$this->load->model('dropdown_items');
   		$data['dropdown_brands']= $this->dropdown_items->brands();
   		
   		$data['page_title'] = 'Add Product' ;
   		$data['main_content'] = 'Product/view_add' ;
   		$this->load->view('includes/template', $data);
   	}
   	else
   	{
   		$this->load->model('mod_products');
   		$response = $this->mod_products->add();
   		if ($response)
   		{
   			$base = base_url().'product/add';
   			$data['type']='alert alert-success';
   			$data['msg']="Successfully Added <a href='$base'>Add More</a>";
   		}
   		else
   		{
   			$base = base_url().'product/add';
   			$data['type']='alert alert-danger';
   			$data['msg']="Could not perform the requested action <a href='.$base.'>Add More</a>";
   		}
   			$data['page_title'] = 'Add Product' ;
   			$data['main_content'] = "view_success" ;
   			$this->load->view('includes/template', $data);
       }
   	}
	function show() 
	{
		$this->load->model ( 'mod_products' );
		$data ['records'] = $this->mod_products->get_all();
		$data ['page_title'] = 'List of Product';
		$data ['main_content'] = 'Product/view_show';
		$this->load->view ( 'includes/template', $data );
	}
   
   	function edit($id)
   	{
       	$this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        
        $this->form_validation->set_rules('category_id', 'Category Name', 'required');
        $this->form_validation->set_rules('brand_id', 'Brand Name', 'required');
        $this->form_validation->set_rules('product_item', 'Product', 'required|callback_check_if_unique_product[edit]');
        $this->form_validation->set_rules('unit_name', 'Unit Name', 'required');
        $this->form_validation->set_rules('sku_number', 'SKU', 'required|callback_check_if_unique_sku[edit]');
        $this->form_validation->set_rules('selling_price', 'Selling Price', 'required');
        $this->form_validation->set_rules('is_serial_available', 'Serial Availablity', 'required');
   
        if ($this->form_validation->run() == FALSE) 
        {
        	$this->load->model('dropdown_items');
        	$data['dropdown_category']= $this->dropdown_items->category_names();
        	 
        	$this->load->model('dropdown_items');
        	$data['dropdown_brands']= $this->dropdown_items->brands();
   
          	 $this->load->model('mod_products');
          	 $data['records'] = $this->mod_products->get_single_row($id);
          	 $data['page_title'] = 'Edit Product' ;
          	 $data['main_content'] = 'Product/view_edit' ;
          	 $this->load->view('includes/template', $data);
       }
       else
       {
         	 $this->load->model('mod_products');
          	 $response = $this->mod_products->edit();
          	 if ($response)
          	 {
   
          		$base = base_url().'product/show';
          		$data['type']='alert alert-success';
          		$data['msg']="Successfully Edited <a href='$base'>Go Back to List</a>"; 
          	 }
             else
             {
	            $base = base_url().'product/show';
	            $data['type']='alert alert-danger';	            
	            $data['msg']="Could not perform the requested action <a href='$base'>Go Back to List</a>";
              }
              	$data['page_title'] = 'Edit Product' ;
              	$data['main_content'] = 'view_success' ;
              	$this->load->view('includes/template', $data);
        }
   }
   
   function delete_item()
   {
      $id = $this->input->post('id');
      $this->load->model('mod_products');
      echo $response= $this->mod_products->delete_item($id); 
   	
   }
   
 
	function check_if_unique_product($searchKey, $fromEdit=NULL)
	{
		 
		$data = array();
		$wheres = array();
		
		$data['tablename'] 		= 'cane_products';
		$data['searchColumn'] 	= 'product_item';
		$data['primary_key'] 	= 'product_id';
		 
		$data['primary_keyValue']  = ($fromEdit) ? $this->input->post( $data['primary_key']) : '' ;
		
		$wheres['category_id'] = $this->input->post('category_id');
		$wheres['brand_id'] = $this->input->post('brand_id');		
		
		$this->load->model('mod_generic');
		$output = $this->mod_generic->check_if_unique( $searchKey, $data, $wheres );
		if ($output)
		{
			$this->form_validation->set_message('check_if_unique_product', 'Already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	function check_if_unique_sku($searchKey, $fromEdit=NULL)
	{
		 
		$data = array();
		$data['tablename'] 		= 'cane_products';
		$data['searchColumn'] 	= 'sku_number';
		$data['primary_key'] 	= 'product_id';
		 
		$data['primary_keyValue']  = ($fromEdit) ? $this->input->post( $data['primary_key']) : '' ;
		$this->load->model('mod_generic');
		$output = $this->mod_generic->check_if_unique( $searchKey, $data );
		if ($output)
		{
			$this->form_validation->set_message('check_if_unique', 'Already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	


	// Function-check_id_availablity
	function check_availablity() {
	
		$product_serial = mysql_real_escape_string($_POST['product_serial']);//Some clean up :)
			
	
		$query = $this->db->query("SELECT product_id FROM cane_product_sales WHERE product_serial='$product_serial'");
	
		if ($query->num_rows() > 0){
	
	
			foreach ($query->result() as $row)  {
	
				$product_id= $row->product_id;
			}
	
	
			$query = $this->db->query("
					SELECT
					cane_products.product_name AS productName,
					cane_brand.brand_name AS brandName,
					cane_category.category_name AS categoryName
					FROM
					cane_products
					LEFT JOIN cane_brand ON cane_brand.brand_id=cane_products.brand_id
					LEFT JOIN cane_category ON cane_category.category_id=cane_products.category_id
					WHERE product_id='$product_id'
					");
	
			foreach ($query->result() as $row) {
	
			$productName= $row->productName;
			$brandName= $row->brandName;
			$categoryName= $row->categoryName;
			}
				
			echo "Brand:$brandName, Category:$categoryName, Model:$productName";
	
	
		}	else {echo"0";}
	
		 
		}
		// End of Function-Function-check_email_availablity
	
	
			function get_last_serial(){
	
			$model_id = mysql_real_escape_string($_POST['model_id']);
			$category_id = mysql_real_escape_string($_POST['category_id']);
			$brand_id = mysql_real_escape_string($_POST['brand_id']);
	
	
	
	$query = $this->db->query("SELECT product_id FROM cane_products WHERE model_id='$model_id' AND brand_id='$brand_id' AND category_id='$category_id'");
	
		foreach ($query->result() as $row){
			
		$product_id= $row->product_id;
			}
				
	
			$query = $this->db->query("SELECT max(num) AS number FROM cane_product_sales WHERE product_id='$product_id'");
	
			foreach ($query->result() as $row)
			{
					$number= $row->number;
	
			}
	
					if($number){
	
						
					echo $number+1;
	
			}else {echo "1";}
	
			}
	

	

	
}