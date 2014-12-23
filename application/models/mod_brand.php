<?php

class Mod_brand extends CI_Model {

   function __construct()
   {
       parent::__construct();
   }

   function add()
   {
      $brand_name = trim($this->input->post('brand_name'));

       $data = array(
          'brand_id' => '',
       	  'brand_name' => $brand_name,
       );
       $this->db->insert('cane_brand', $data);
       if($this->db->affected_rows() > 0)
       { 
         return TRUE;
       } 
       else 
       { 
         return FALSE;
       }
   }

   function get_all()
   {
       $this->db->select('*');
       $this->db->from('cane_brand');
       $this->db->order_by('brand_name','ASC');
       $getData = $this->db->get('');
       if($getData->num_rows() > 0)
       return $getData->result_array();
       else
       return null;
   }

   function get_single_row($id)
   {
       $sql = "SELECT * FROM cane_brand WHERE brand_id = ?" ;
       $getData = $this->db->query($sql,array($id));
       if($getData->num_rows() > 0)
       return $getData->result_array();
       else
       return null;
   }

   function edit()
   {
      $brand_id = trim($this->input->post('brand_id'));
      $brand_name = trim($this->input->post('brand_name'));

       $data = array(
       		'brand_name' => $brand_name,
       );
       $this->db->where('brand_id',$brand_id);    
       $this->db->update('cane_brand', $data);
       if($this->db->affected_rows() > 0)
       { 
         return TRUE;
       } 
       else 
       { 
         return FALSE;
       }
   }

   function delete_item($id)
   {
       $query= $this->db->delete('cane_brand', array('brand_id' => $id));
       if($this->db->affected_rows() > 0)
       { 
         return TRUE;
       } 
       else 
       { 
         return FALSE;
       }
   }

}
