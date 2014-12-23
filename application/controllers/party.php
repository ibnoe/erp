<?php
class Party extends CI_Controller{

function __construct()
    {
        parent::__construct();
        
       include 'parent_construct.php';
        
    }
    
   	 
	function add(){
		
		$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
			    
		$this->load->view('party/view_add_party',$data);
		
	}
   	 
	function add_new_party(){
					
		$this->load->model('mod_party');
		$data= $this->mod_party->add();
		
		echo $data;
		
	}
   	 
	function party_list(){
		
			$user_info = $this->authex->get_userdata();
			$data['level']=$user_info->level;
								
			$this->load->model('mod_party');
		    $data['records']= $this->mod_party->party_list();
			
		    $data['user_name']=$this->authex->get_user_name();
		    
			$this->load->view('party/view_party_list',$data);			
			
	}//function ends
	
	
	
	function edit_party($party_id){
				
			
			$user_info = $this->authex->get_userdata();
			$data['level']=$user_info->level;
	
			$data['user_name']=$this->authex->get_user_name();
			// Get data from module permission table
			$this->load->model('mod_party');
			$data['records']= $this->mod_party->grab_party_info($party_id);
			
				
			$this->load->view('party/view_edit_party',$data);
		
		
	}//function ends
	
	
	function party_updated(){
		
			
		$this->load->model('mod_party');
		$data= $this->mod_party->party_updated();
		
		echo $data;
		
		
	}//function ends
	
	
function delete_party(){
		
		$id = mysql_real_escape_string($_POST['id']);
		
		$this->load->model('mod_party');
		$data= $this->mod_party->delete_party($id);
		
		if(!empty($data)){
			
			echo $data;
		}
}//function ends


   	 
}   	 