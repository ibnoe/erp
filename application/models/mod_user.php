<?php
class Mod_user extends CI_Model {
	
	function add_user(){
		
		$admin_name=trim($this->input->post('admin_name'));
		$admin_email=trim($this->input->post('admin_email'));
		$admin_password=trim($this->input->post('admin_password'));
		$level=trim($this->input->post('level'));
		$admin_status=trim($this->input->post('admin_status'));
		
		
	if(!empty($admin_name)){
		
		$query = $this->db->query("SELECT admin_id  FROM cane_admin WHERE admin_email='$admin_email'");
                                  
		if ($query->num_rows() > 0){

			return "2";
			
		} else	{
							
						
				// Insert Data into temporary table
				$data = array(
					'admin_id' => '',
					'level' => $level,
			 		'admin_name' => $admin_name,
				 	'admin_email' => $admin_email,
					'admin_pass' => sha1($admin_password),
					'admin_last_login' => '',
					'admin_status' => $admin_status
				
				);
				$this->db->insert('cane_admin', $data); 
				
				return "1";
				
			
		}	
		
	}//if not empty
			
}//function ends
	
function user_list() { 

	$getData = $this->db->query("
	
			SELECT * FROM cane_admin
			LEFT JOIN cane_admin_level ON cane_admin_level.level_id=cane_admin.level
		
	
			");
	
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
	
}
	//End 
			
function grab_user_info($user_id) { 

	$this->db->select('*');
	$this->db->from('cane_admin');
	$this->db->where('admin_id',$user_id);
			
	$getData = $this->db->get('');
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
}
//End 
	
		
function user_updated(){
		$level=trim($this->input->post('level'));
		$admin_status=trim($this->input->post('admin_status'));
		$admin_id=trim($this->input->post('admin_id'));
				
		
			
										
				// Insert Data into temporary table
				$data = array(
					 'level' => $level,
				 	'admin_status' => $admin_status,
									
			   
				);
				$this->db->where('admin_id', $admin_id);
				$this->db->update('cane_admin', $data); 
				 
				
				return "1";
			
			
			
}//function ends 				
		


function delete_user($id){
	
			      
				$query1 = $this->db->query("SELECT id FROM  cane_entries WHERE entry_by='$id'");
				$query2 = $this->db->query("SELECT warranty_id FROM  cane_warranty WHERE entry_by='$id'");
				$query3 = $this->db->query("SELECT rep_delivery_id FROM  cane_rep_delivery WHERE prepared_by='$id'");
				$query4 = $this->db->query("SELECT product_id FROM cane_product_sales WHERE entry_by='$id'");
	
				$value1= $query1->num_rows(); $value2= $query2->num_rows(); $value3= $query3->num_rows(); $value4= $query4->num_rows();
				$value= $value1+$value2+$value3+$value4;
				
	if ($value > 0){
		
			 return 2;
			  
		} else {	
																					
				$query= $this->db->delete('cane_admin', array('admin_id ' => $id)); 
				
				return 1; 
		}
		
		
}


}