<?php
class Category extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       include 'parent_construct.php';
   }

   function add()
   {
       $this->load->library('form_validation');
       $this->form_validation->set_error_delimiters('<span class="error">', '</span>'); 
       
       $this->form_validation->set_rules('category_name', 'Category Name', 'required|callback_check_if_unique');
       
       if ($this->form_validation->run() == FALSE) 
       { 

            $data['page_title'] = 'Add Category' ;
            $data['main_content'] = 'category/view_add' ;
            $this->load->view('includes/template', $data);
       } 
       else 
       { 
       	$this->load->model('mod_category');
       	$response = $this->mod_category->add();
       	   if ($response) 
           { 
       			$base = base_url().'category/add'; 
       			$data['type']='alert alert-success'; 
       			$data['msg']="Successfully Added <a href='$base'>Add More</a>"; 
            } 
           else 
           { 
       			$base = base_url().'category/add'; 
       			$data['type']='alert alert-danger'; 
       			$data['msg']="Could not perform the requested action <a href='.$base.'>Add More</a>"; 
            } 
            $data['page_title'] = 'Add category' ;
            $data['main_content'] = "view_success" ;
            $this->load->view('includes/template', $data);
       } 
   }

   function show()
   {
       $this->load->model('mod_category');
       $data['records']= $this->mod_category->get_all();
            $data['page_title'] = 'List of Category' ;
            $data['main_content'] = 'category/view_show' ;
            $this->load->view('includes/template', $data);
   }

   function edit($id)
   {
       $this->load->library('form_validation');
       $this->form_validation->set_error_delimiters('<span class="error">', '</span>'); 
       $this->form_validation->set_rules('category_name', 'Category Name', 'required|callback_check_if_unique[edit]');

       if ($this->form_validation->run() == FALSE) { 

       	$this->load->model('mod_category');
       	$data['records'] = $this->mod_category->get_single_row($id);
            $data['page_title'] = 'Edit Category' ;
            $data['main_content'] = 'category/view_edit' ;
            $this->load->view('includes/template', $data);
       } 
       else 
       { 
       	$this->load->model('mod_category');
       	$response = $this->mod_category->edit();
       	   if ($response) 
           { 

       			$base = base_url().'category/show'; 
       			$data['type']='alert alert-success'; 
       			$data['msg']="Successfully Edited <a href='$base'>Go Back to List</a>"; 
            } 
           else 
           { 
       			$base = base_url().'category/show'; 
       			$data['type']='alert alert-danger'; 
       			$data['msg']="Could not perform the requested action <a href='$base'>Go Back to List</a>";
            } 
            $data['page_title'] = 'Edit Category' ;
            $data['main_content'] = 'view_success' ;
            $this->load->view('includes/template', $data);
       } 
   }

   function delete_item()
   {
       $id = $this->input->post('id');
       $this->load->model('mod_category');
       echo $response= $this->mod_category->delete_item($id);
   }
   function check_if_unique($searchKey, $fromEdit=NULL)
   {
   		
   	$data = array();
   	$data['tablename'] 		= 'cx_category';
   	$data['searchColumn'] 	= 'category_name';
   	$data['primary_key'] 	= 'category_id';   	
   
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
    

}
