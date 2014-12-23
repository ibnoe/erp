<?php
class User extends CI_Controller{

function __construct()
    {
        parent::__construct();
        
       include 'parent_construct.php';
        
    }
    
   	 
function add(){   	 	

   	$user_info = $this->authex->get_userdata();
    			
   	if(($user_info->level > 1)){
    	
    	 redirect("error/"); 
    } else {

    		$user_info = $this->authex->get_userdata();
			$data['level']=$user_info->level;
	   	 	$data['user_name']=$this->authex->get_user_name();
			$this->load->view('user/view_add_user',$data);	
    }
   	 	
   	 	
 }//function ends
   	 
function add_new_user(){
		
	$user_info = $this->authex->get_userdata();
    			
   	if(($user_info->level > 1)){
    	
    	 redirect("error/"); 
    } else {
	
		$this->load->model('mod_user');
		$data= $this->mod_user->add_user();
		
		echo $data;
	
    }	
		
}//function ends
   	 
function user_list(){
			
  $user_info = $this->authex->get_userdata();
   			
  if(($user_info->level > 1)){
    				
          redirect("error/");
           
    } else {
										
			$this->load->model('mod_user');
			$data['records']= $this->mod_user->user_list();
						
			$user_info = $this->authex->get_userdata();
			$data['level']=$user_info->level;
					    
			$data['user_name']=$this->authex->get_user_name();
			$this->load->view('user/view_user_list',$data);			
			
    }
}//function ends
	
	
	
function edit_user($user_id){
				
	$user_info = $this->authex->get_userdata();
    			
   	if(($user_info->level > 1)){
    				
     		 redirect("error/"); 
    } else {

    	$data['user_name']=$this->authex->get_user_name();
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;
						
		$this->load->model('mod_user');
		$data['records']= $this->mod_user->grab_user_info($user_id);
						
		$this->load->view('user/view_edit_user',$data);

    }
		
}//function ends
	
	
function user_updated(){
		
	$user_info = $this->authex->get_userdata();
    			
   	if(($user_info->level > 1)){
    				
     		 redirect("error/"); 
    } else {
			
		$this->load->model('mod_user');
		$data= $this->mod_user->user_updated();
		
		echo $data;
    }	
		
		
}//function ends
	
	
function delete_user(){
	
	$user_info = $this->authex->get_userdata();
    			
   	if(($user_info->level > 1)){
    				
     		 redirect("error/"); 
    } else {
		
		$id = mysql_real_escape_string($_POST['id']);//Some clean up :)
		
		$this->load->model('mod_user');
		$data= $this->mod_user->delete_user($id);
		
		if(!empty($data)){
			
			echo $data;
		}
		
    }
    	
}//function ends	
	
	
	function change_password(){
		
		$data['user_name']=$this->authex->get_user_name();
			
		$user_info = $this->authex->get_userdata();
		$data['level']=$user_info->level;		
				
		$this->load->view('user/view_change_pass',$data);
		
	}
	
	function password(){
		
		$curr_password=sha1(trim($this->input->post('curr_password')));
		$new_password=sha1(trim($this->input->post('new_password')));
		$user_id=$this->authex->get_user_id();
		$query = $this->db->query("SELECT admin_id FROM cane_admin WHERE admin_pass='$curr_password'");
                                  
		if ($query->num_rows() > 0){
					
			// Insert Data into temporary table
				$data = array(
					 'admin_pass' => $new_password,
					
			   
				);
				$this->db->where('admin_id', $user_id);
				$data=$this->db->update('cane_admin', $data); 
				
				if($data){echo "1";} else{echo "2";}
				
			
		} else	{
		
			echo "2";
		}
		
		
	}
	
   	 
}   	 