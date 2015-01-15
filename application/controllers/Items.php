<?php
class Items extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       include 'parent_construct.php';
   }

   function add()
   {
       $this->load->library('form_validation');
       $this->form_validation->set_error_delimiters('<span class="error">', '</span>'); 

       if ($this->form_validation->run() == FALSE) 
       {
			
       		$this->load->model('dropdown_items');
       		
       		$data['dropdown_item_types']= $this->dropdown_items->create_dropdown('cx_item_types', 'item_type_id', 'item_type_name', 'Select an item type' );
       		$data['dropdown_items']	= $this->dropdown_items->create_dropdown('cx_items', 'item_id', 'item_name', 'None' );
       		$data['dropdown_units']	= $this->dropdown_items->create_dropdown('cx_units', 'unit_id', 'unit_name', 'Select an unit' );
       	    
       		$data['all_accounts_head']	= $this->dropdown_items->create_dropdown('cx_account_heads', 'acc_id', 'account_name', 'Select an account' );
       		$data['cogs_accounts'] = $this->dropdown_items->get_account_heads( $this->config->item('cogs_group_id') );
       		$data['income_accounts'] = $this->dropdown_items->get_account_heads( $this->config->item('income_group_id') );
       		$data['assets_accounts'] = $this->dropdown_items->get_account_heads( $this->config->item('asset_group_id') );
       		$data['expense_accounts'] = $this->dropdown_items->get_account_heads( $this->config->item('expense_group_id') );
       		
       	
       	 
            $data['page_title'] = 'Add items' ;
            $data['main_content'] = 'items/view_add' ;
            $this->load->view('includes/template', $data);
       } 
       else 
       { 
       		$this->load->model('mod_items');
       		$response = $this->mod_items->add();
       	   if ($response) 
           { 
       			$base = base_url().'items/add'; 
       			$data['type']='alert alert-success'; 
       			$data['msg']="Successfully Added <a href='$base'>Add More</a>"; 
            } 
           else 
           { 
       			$base = base_url().'items/add'; 
       			$data['type']='alert alert-danger'; 
       			$data['msg']="Could not perform the requested action <a href='.$base.'>Add More</a>"; 
            } 
            $data['page_title'] = 'Add items' ;
            $data['main_content'] = "view_success" ;
            $this->load->view('includes/template', $data);
       } 
   }

   function show()
   {
       $this->load->model('mod_items');
       $data['records']= $this->mod_items->get_all();
            $data['page_title'] = 'List of items' ;
            $data['main_content'] = 'items/view_show' ;
            $this->load->view('includes/template', $data);
   }

   function edit($id)
   {
       $this->load->library('form_validation');
       $this->form_validation->set_error_delimiters('<span class="error">', '</span>'); 

       if ($this->form_validation->run() == FALSE) { 

       	$this->load->model('mod_items');
       	$data['records'] = $this->mod_items->get_single_row($id);
            $data['page_title'] = 'Edit items' ;
            $data['main_content'] = 'items/view_edit' ;
            $this->load->view('includes/template', $data);
       } 
       else 
       { 
       		$this->load->model('mod_items');
       		$response = $this->mod_items->edit();
       	   if ($response) 
           { 

       			$base = base_url().'items/show'; 
       			$data['type']='alert alert-success'; 
       			$data['msg']='Successfully Edited'; 
            } 
           else 
           { 
       			$base = base_url().'items/show'; 
       			$data['type']='alert alert-danger'; 
       			$data['msg']='Could not perform the requested action'; 
            } 
            $data['page_title'] = 'Edit items' ;
            $data['main_content'] = 'view_success' ;
            $this->load->view('includes/template', $data);
       } 
   }

   function delete_item()
   {
       $id = $this->input->post('id');
       $this->load->model('mod_items');
       echo $response= $this->mod_items->delete_item($id);
   }

}
