<?php
class Serial extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();

		include 'parent_construct.php';

    }

    function using_excel_file() 
    {

    	$this->load->library('form_validation');
		
		$this->form_validation->set_rules('category_id', 'Category', 'required');
		$this->form_validation->set_rules('brand_id', 'Brand', 'required');
		$this->form_validation->set_rules('product_id', 'Product', 'required');
		$this->form_validation->set_rules('purchase_voucher', 'Purchase Voucher', 'required');		
		$this->form_validation->set_rules('warranty_period', 'Warranty', 'required|integer');
		
		
		if ($this->form_validation->run() == FALSE) { 
			
       		$this->load->model('dropdown_items');
			$data['dropdown_category']= $this->dropdown_items->enter_serial_category();
		
			$data['page_title'] = 'Product Serial Entry - Using Excel File';
			$data['main_content'] = 'serial/view_using_excel';
			$this->load->view('includes/template', $data);	
       } 
       else
       {	

       		if(!empty($_FILES['userfile']))
			{

				$extension = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);

				if($extension =='xlsx' || $extension=='xls')
				{

						$excel_file = $_FILES['userfile']['tmp_name'];
						$excelData = $this->get_serials_from_excel($excel_file);
						
						$this->load->model('mod_serial');
						$data= $this->mod_serial->using_excel_file($excelData);				
						echo $data;
				}
				else
				{
					echo 4; // Wrong File Format

				}
			}
			else
			{
				echo 5 ; // Did not select any file
			}       	
       }

    }
    
    
	function using_form_element() 
    {

    	$this->load->library('form_validation');
		
		$this->form_validation->set_rules('category_id', 'Category', 'required');
		$this->form_validation->set_rules('brand_id', 'Brand', 'required');
		$this->form_validation->set_rules('product_id', 'Product', 'required');
		$this->form_validation->set_rules('purchase_voucher', 'Purchase Voucher', 'required');		
		$this->form_validation->set_rules('warranty_period', 'Warranty', 'required|integer');
		
		
		if ($this->form_validation->run() == FALSE) { 
			
       		$this->load->model('dropdown_items');
			$data['dropdown_category']= $this->dropdown_items->enter_serial_category();
		
			$data['page_title'] = 'Product Serial Entry';
			$data['main_content'] = 'serial/view_using_form_element';
			$this->load->view('includes/template', $data);	
       } 
       else
       {	

       		$this->load->model('mod_serial');
			$data= $this->mod_serial->using_form_element();				
			echo $data;	
       	
       }

    }
    
    function bag() {
    	
    	$this->load->model('mod_serial');
			$data= $this->mod_serial->using_form_element();				
			echo $data;
    }
    
    
	function select_product()
	{	
	
    	 if (($this->authex->get_user_level() > 1))
    	 {			
          	 redirect("error/"); 
          	 
    	 } 
    	 else 
    	 {   	 	
      	 	
			$this->load->model('dropdown_items');
			$data['dropdown_category']= $this->dropdown_items->enter_serial_category();												
			
			$data['page_title'] = 'Product Serial';
			$data['main_content'] = 'serial/view_select_product';
			$this->load->view('includes/template', $data);  	 	
    	 	
    	 	
    	 }
	
	}  
    
    
    function show(){

		
	   if (($this->authex->get_user_level() > 1))
	   {
			redirect("error/");
	   } 
	   else 
	   {
			$product_id=trim($this->input->post('product_id'));
			
			if(!empty($product_id))
			{
				$this->session->set_userdata('product_id',$product_id);
			}

			$product_id = $this->session->userdata('product_id');

			$this->load->model('mod_serial');
			$data['records']= $this->mod_serial->product_serial_list($product_id);
			
			$data['page_title'] = 'Product Serial';
			$data['main_content'] = 'serial/view_serial_list';
			$this->load->view('includes/template', $data); 

		}

	}
		

	function delete_item(){
	   if (($this->authex->get_user_level() > 1))
	   {
			redirect("error/");
	   } 
	   else 
	   {

		$this->load->model('mod_serial');
		$data= $this->mod_serial->delete_serial();
		echo $data;
		
	   }
	}
    
    
    

    function get_serials_from_excel($excel_file)
	{
			
		$this->load->library('excel');
		$objPHPExcel = PHPExcel_IOFactory::load($excel_file);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

		foreach($sheetData as $row)
		{
			if( !empty($row['A']) )
			{

				$data[] =  $row['A'];
							
			}
		}

		return $data;

	}
	
	
	function validity_check_purchase_voucher()
	{

		$this->load->model('mod_serial');
		$value= $this->mod_serial->validity_check_purchase_voucher();
			
		if ($value)
		{ 
			echo "true"; 
		} 
		else 
		{
			echo "false";
		}

	}
	
	function number_of_serial_to_fill(){

		$product_id = trim($this->input->post('product_id'));
		$purchase_voucher = trim($this->input->post('purchase_voucher'));
		
		$this->load->model('mod_serial');
		$purchase_id = $this->mod_serial->get_purchase_id($purchase_voucher);

		$this->load->model('mod_serial');
		$value= $this->mod_serial->get_number_of_serial_allowed($product_id , $purchase_id);
			
		echo $value;
	}



}