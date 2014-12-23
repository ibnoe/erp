<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authex{

 
 function __construct()
	{
		$this->ci =& get_instance();
		//load libraries
		$this->ci->load->library('session');
		$this->ci->load->database();
 
	}


	function get_user_id()
	{
		return $this->ci->session->userdata('user_id');
	}
	
	function get_user_level()
	{
		return $this->ci->session->userdata('user_level');
	}

 	function get_user_name()
 	{
		 return $this->ci->session->userdata('user_name');
 	}
 
 /*
  function get_userdata()
 {
     $CI =& get_instance();

     if( ! $this->logged_in())
     {
         return false;
     }
     else
     {
          $query = $CI->db->get_where("cane_admin", array("admin_id" => $CI->session->userdata("user_id")));
          return $query->row();
     }
 }
 */

 function logged_in()
 {
     $CI =& get_instance();
     return ($CI->session->userdata("user_id")) ? true : false;
 }

 function login($email, $password)
 {
     $CI =& get_instance();

     $data = array(
         "admin_email" => $email,
		 "admin_status" => '1',
         "admin_pass" => sha1($password)
     );

     $query = $CI->db->get_where("cane_admin", $data);

     if($query->num_rows() !== 1)
     {
         /* their username and password combination
         * were not found in the databse */

         return false;
     }
     else
     {
        //update the last login time
         $last_login = date("Y-m-d H-i-s");

         $data = array(
             "admin_last_login" => $last_login
         );
		 
		 $CI->db->where('admin_id', $query->row()->admin_id);
         $CI->db->update("cane_admin", $data);

         //store user information in the session
		  $CI->session->set_userdata("user_id", $query->row()->admin_id);
          $CI->session->set_userdata("user_name", $query->row()->admin_name);
		  $CI->session->set_userdata("user_level", $query->row()->level);

         return true;
     }
 }

 function logout()
 {
     $CI =& get_instance();
     $CI->session->unset_userdata("user_id");
	 $this->ci->session->sess_destroy();
 }

 function register($email, $password)
 {
     $CI =& get_instance();

     //ensure the email is unique
     if($this->can_register($email))
     {
         $data = array(
             "email" => $email,
             "password" => sha1($password)
         );

         $CI->db->insert("users", $data);

         return true;
     }

     return false;
 }

 function can_register($email)
 {
     $CI =& get_instance();

     $query = $CI->db->get_where("users", array("email" => $email));

     return ($query->num_rows() < 1) ? true : false;
 }
}