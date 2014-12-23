<?php
class Home extends CI_Controller{

function __construct()
    {
        parent::__construct();
        
       include 'parent_construct.php';
        
    }    
	
	function index(){
		
		$data['page_title'] = 'Dashboard' ;
        $data['main_content'] = 'view_dashboard' ;
        $this->load->view('includes/template', $data);		
		
	}
	
		
	
	
	
	
	
	
	
	
	
	
	
}	