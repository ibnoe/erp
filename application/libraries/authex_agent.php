<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authex_agent{

 function Authex_agent()
 {	
 
 	$this->ci =& get_instance();
     

     //load libraries
    $this->ci->load->library('session');
	$this->ci->load->database();
 }


function get_user_id()
	{
		return $this->ci->session->userdata('agent_id');
	}

 function get_user_name()
 {
     $CI =& get_instance();

     if( ! $this->logged_in())
     {
         return false;
     }
     else
     {
          $query = $CI->db->get_where("cane_agent", array("agent_id" => $CI->session->userdata("agent_id")));
          return $query->row()->agent_company;
     }
 }
 
 
  function get_userdata()
 {
     $CI =& get_instance();

     if( ! $this->logged_in())
     {
         return false;
     }
     else
     {
          $query = $CI->db->get_where("cane_agent", array("agent_id" => $CI->session->userdata("agent_id")));
          return $query->row();
     }
 }

 function logged_in()
 {
     $CI =& get_instance();
     return ($CI->session->userdata("agent_id")) ? true : false;
 }

 function login($email, $password)
 {
     $CI =& get_instance();

     $data = array(
         "agent_login_id" => $email,
		 "agent_status" => '1',
         "agent_login_password" => sha1($password)
     );

     $query = $CI->db->get_where("cane_agent", $data);

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
             "agent_last_login" => $last_login
         );

         $CI->db->update("cane_agent", $data);

         //store user id in the session
         $CI->session->set_userdata("agent_id", $query->row()->agent_id);
		  $CI->session->set_userdata("agent_level", $query->row()->agent_level);

         return true;
     }
 }

 function logout()
 {
     $CI =& get_instance();
     
	 
	 $this->ci->session->set_userdata(array('agent_id' => '', 'agent_name' => '','agent_level' => ''));
		
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