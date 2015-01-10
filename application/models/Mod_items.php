<?php

class Mod_items extends CI_Model {

   function __construct()
   {
       parent::__construct();
   }

   function add()
   {
      $item_type_id = trim($this->input->post('item_type_id'));
      $parent_item_id = trim($this->input->post('parent_item_id'));
      $item_name = trim($this->input->post('item_name'));
      $has_subitem = trim($this->input->post('has_subitem'));
      $unit_id = trim($this->input->post('unit_id'));
      $item_code = trim($this->input->post('item_code'));
      $is_active = trim($this->input->post('is_active'));
      $asset_account = trim($this->input->post('asset_account'));
      $reorder_level = trim($this->input->post('reorder_level'));
      $on_hand = trim($this->input->post('on_hand'));
      $total_value = trim($this->input->post('total_value'));
      $description_purchase = trim($this->input->post('description_purchase'));
      $cost = trim($this->input->post('cost'));
      $cogs_account = trim($this->input->post('cogs_account'));
      $description_sales = trim($this->input->post('description_sales'));
      $price = trim($this->input->post('price'));
      $income_account = trim($this->input->post('income_account'));
      $tax_code_id = trim($this->input->post('tax_code_id'));

       $data = array(
          'item_id' => '',
       'item_type_id' => $item_type_id,
       'parent_item_id' => $parent_item_id,
       'item_name' => $item_name,
       'has_subitem' => $has_subitem,
       'unit_id' => $unit_id,
       'item_code' => $item_code,
       'is_active' => $is_active,
       'asset_account' => $asset_account,
       'reorder_level' => $reorder_level,
       'on_hand' => $on_hand,
       'total_value' => $total_value,
       'description_purchase' => $description_purchase,
       'cost' => $cost,
       'cogs_account' => $cogs_account,
       'description_sales' => $description_sales,
       'price' => $price,
       'income_account' => $income_account,
       'tax_code_id' => $tax_code_id,
       );
       $this->db->insert('cx_items', $data);
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
       $this->db->from('cx_items');
       $this->db->order_by('item_name','ASC');
       $getData = $this->db->get('');
       if($getData->num_rows() > 0)
       return $getData->result_array();
       else
       return null;
   }

   function get_single_row($id)
   {
       $sql = "SELECT * FROM cx_items WHERE item_id = ?" ;
       $getData = $this->db->query($sql,array($id));
       if($getData->num_rows() > 0)
       return $getData->result_array();
       else
       return null;
   }

   function edit()
   {
      $item_id = trim($this->input->post('item_id'));
      $item_type_id = trim($this->input->post('item_type_id'));
      $parent_item_id = trim($this->input->post('parent_item_id'));
      $item_name = trim($this->input->post('item_name'));
      $has_subitem = trim($this->input->post('has_subitem'));
      $unit_id = trim($this->input->post('unit_id'));
      $item_code = trim($this->input->post('item_code'));
      $is_active = trim($this->input->post('is_active'));
      $asset_account = trim($this->input->post('asset_account'));
      $reorder_level = trim($this->input->post('reorder_level'));
      $on_hand = trim($this->input->post('on_hand'));
      $total_value = trim($this->input->post('total_value'));
      $description_purchase = trim($this->input->post('description_purchase'));
      $cost = trim($this->input->post('cost'));
      $cogs_account = trim($this->input->post('cogs_account'));
      $description_sales = trim($this->input->post('description_sales'));
      $price = trim($this->input->post('price'));
      $income_account = trim($this->input->post('income_account'));
      $tax_code_id = trim($this->input->post('tax_code_id'));

       $data = array(
       'item_type_id' => $item_type_id,
       'parent_item_id' => $parent_item_id,
       'item_name' => $item_name,
       'has_subitem' => $has_subitem,
       'unit_id' => $unit_id,
       'item_code' => $item_code,
       'is_active' => $is_active,
       'asset_account' => $asset_account,
       'reorder_level' => $reorder_level,
       'on_hand' => $on_hand,
       'total_value' => $total_value,
       'description_purchase' => $description_purchase,
       'cost' => $cost,
       'cogs_account' => $cogs_account,
       'description_sales' => $description_sales,
       'price' => $price,
       'income_account' => $income_account,
       'tax_code_id' => $tax_code_id,
       );
       $this->db->where('item_id',$item_id);
       $this->db->where('school_id' );
       $this->db->update('cx_items', $data);
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
       $query= $this->db->delete('cx_items', array('item_id' => $item_id));
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
