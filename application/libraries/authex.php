<?php
use Zend\Crypt\Password\Bcrypt;
 
class Authex{
	
function __construct()
{
	$this->ci =& get_instance();
	//load libraries
	$this->ci->load->library('session');
	$this->ci->load->database();
	spl_autoload_register( array( $this, 'autoload') );
 
}
	function autoload($className)
	{
		$className = ltrim($className, '\\');
		$fileName  = '';
		$namespace = '';
		if ($lastNsPos = strrpos($className, '\\')) {
			$namespace = substr($className, 0, $lastNsPos);
			$className = substr($className, $lastNsPos + 1);
			$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
		}
		$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
	
		require $fileName;
	}
	

	function get_user_id()
	{
		return $this->ci->session->userdata('user_id');
	}
	

 	function get_user_name()
 	{
		 return $this->ci->session->userdata('user_name');
 	}
 	
 	function get_branch_id()
 	{
 		return $this->ci->session->userdata('branch_id');
 	}
 	
 	function get_branch_name()
 	{
 		return $this->ci->session->userdata('branch_name');
 	}
 	
 	function get_left_menus()
 	{
 		return $this->ci->session->userdata('left_menus');
 	}
 	
 	function money_format_options()
 	{
 		
 		return array(
 				'symbol' => "Tk ",
 				'decimal' => ". ",
 				'thousand' => ", ",
 				'precision' => 2 ,
 				'format'=> "%s%v", 				
 		);
 		
 	}
 
 
 function logged_in()
 {
     $CI =& get_instance();
     return ($CI->session->userdata("user_id")) ? true : false;
 }

 function login($email, $password)
 {
     $CI =& get_instance();
     $sql = "SELECT user_id,user_password, role_id, employee_name, a.branch_id, branch_name 
	     		FROM (
	     			SELECT user_id,user_password, role_id, employee_name, branch_id
		     		FROM cx_users u 
		     		INNER JOIN cx_employees e ON e.employee_id = u.employee_id
		     		WHERE user_email = ? AND user_status = ?
	     		) a  
     		INNER JOIN cx_branch b ON b.branch_id = a.branch_id
     		";     
     $query = $CI->db->query($sql, array($email , 1));
  
     if($query->num_rows() !== 1)
     {
         return false;
     }
     else
     {    	
        // Verify Password        
     	$bcrypt = new Bcrypt();   
     	     	
     	if($bcrypt->verify($password, $query->row()->user_password ))
     	{
     		//update the last login time
     		$data = array(
     				"last_login" => date("Y-m-d H-i-s")
     		);
     		$CI->db->where('user_id', $query->row()->user_id);
     		$CI->db->update("cx_users", $data);
     		
     		// Get Menu Items for the user
     		$sql = "SELECT menu_name, menu_link,section_id, is_hidden, class_method FROM cx_permissions
					INNER JOIN cx_menus ON cx_permissions.menu_id = cx_menus.menu_id
					WHERE role_id = ?";     		
     		$result = $CI->db->query($sql, array( $query->row()->role_id  ) );
     		
     		$menu_items = array();
     		     		
     		if ($result->num_rows() > 0)
     		{
     			foreach ($result->result() as $row)
     			{
     				// Get Module Names
     				$sql = "SELECT module_name FROM cx_sections
							LEFT JOIN cx_modules ON cx_modules.module_id = cx_sections.parent_module_id
							WHERE section_id = ?";
     				$QueryResult = $CI->db->query($sql, array( $row->section_id  ) );
     				
     				// Generate the array for Navigation Menu for the user 
     				if ($QueryResult->num_rows() > 0)
     				{
     					foreach ($QueryResult->result() as $rows)
     					{     						
     						if($row->is_hidden == 0)
     						{
     							$menu_items[$rows->module_name ][] = array("menuName" => $row->menu_name, "menuLink" => $row->menu_link);
     						}	  															
     					}
     				}

     				$permissions[] = trim($row->class_method);
     			}
     		}
     		 		
     		//store user information in the session
     		$CI->session->set_userdata("user_id", $query->row()->user_id);
     		$CI->session->set_userdata("role_id", $query->row()->role_id);
     		$CI->session->set_userdata("user_name", $query->row()->employee_name);
     		$CI->session->set_userdata("branch_id", $query->row()->branch_id);
     		$CI->session->set_userdata("branch_name", $query->row()->branch_name);
     		$CI->session->set_userdata("left_menus", $menu_items);
     		$CI->session->set_userdata("permissions", $permissions);
     		
     		return TRUE;
     		   		
     	} 
     	else 
     	{
     		return FALSE; // Password did not match
     	}
        
     }
 }

 function logout()
 {
     $CI =& get_instance();
     $CI->session->unset_userdata("user_id");
     $CI->session->unset_userdata("role_id");
     $CI->session->unset_userdata("user_name");
     $CI->session->unset_userdata("branch_id");    
	 $this->ci->session->sess_destroy();
 }
 
 public static function checkUrlPermission()
 {
 	$CI =& get_instance(); 
 	$url = trim( strtolower( $CI->router->fetch_class() ) ."-". strtolower( $CI->router->fetch_method() ) ); 
 	$excluding = array("home-index", "home-logout", "auth-index");
 	 	
 	if(!in_array($url , $excluding))
 	{
 		if(!in_array( $url,  $CI->session->userdata("permissions") ))
 		{
 			redirect();
 		}
 	}
 }

 public static function Permission($actionName = NULL)
 {
 	$CI =& get_instance();
 	if(in_array( $actionName ,  $CI->session->userdata("permissions") ))
 	{
 		return TRUE;
 	}
 	else
 	{
 		return FALSE;
 	}
 }
   
}