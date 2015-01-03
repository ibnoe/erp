<?php

class Mod_category extends CI_Model {

   function __construct()
   {
       parent::__construct();
   }

   function add()
   {
      $category_name = trim($this->input->post('category_name'));

       $data = array(
          'category_id' => '',
       	  'category_name' => $category_name,         
       );
       $this->db->insert('cx_category', $data);
       if($this->db->affected_rows() > 0)
       { 
         return 1;
       } 
       else 
       { 
         return 0;
       }
   }

   function get_all()
   {
       $this->db->select('*');
       $this->db->from('cx_category');       
       $this->db->order_by('category_name','ASC');
       $getData = $this->db->get('');
       if($getData->num_rows() > 0)
       return $getData->result_array();
       else
       return null;
   }

   function get_single_row($id)
   {
       $sql = "SELECT * FROM cx_category WHERE category_id = ?" ;
       $getData = $this->db->query($sql,array($id));
       if($getData->num_rows() > 0)
       return $getData->result_array();
       else
       return null;
   }

   function edit()
   {
      $category_id = trim($this->input->post('category_id'));
      $category_name = trim($this->input->post('category_name'));

       $data = array(
       'category_name' => $category_name,
       );
       $this->db->where('category_id',$category_id);
      
       $this->db->update('cx_category', $data);
       if($this->db->affected_rows() > 0)
       { 
         return 1;
       } 
       else 
       { 
         return 0;
       }
   }

   function delete_item($id)
   {
       $query= $this->db->delete('cx_category', array('category_id' => $id));
       if($this->db->affected_rows() > 0)
       { 
         return 1;
       } 
       else 
       { 
         return 0;
       }
   }

}
