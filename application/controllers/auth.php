<?php
class Auth extends CI_Controller{

function __construct()
    {
        parent::__construct();
        
        $this->load->library('authex');
    
       
   	 }
   	 
   	 
   	 function login(){
   	 	
   	  if(!$this->authex->logged_in())
        {
          $this->load->view('login_page');
        } else {
        	redirect('');
        	
        }
   	 	
   	 	
   	 }//function ends
   	 
   	 
   	 function login_process(){
   	 	
   	 	$email=trim($this->input->post('user_id'));
   	 	$password=trim($this->input->post('user_pass'));
   	 	
   	 	
   	 	
   	 	if($this->authex->login($email, $password)){
   	 		
   	 		redirect('');
   	 	} else {
   	 		
   	 		$data['message']="Wrong login information";
   	 		$this->load->view('login_page',$data);
   	 	
   	 	}
   	 	
   	 			
   	 	
   	 	
   	 	
   	 }
   	 
   	 
function logout()
	{
		$this->authex->logout();

		
		redirect('');
	}
   	 
   	 
   	 
   	 
}   	 