<?php

class Mod_items extends CI_Model {

   function __construct()
   {
       parent::__construct();
   }

   function add()
   {

   	extract($_POST);
   	$has_subitem = ( $this->input->post('has_subitem') == 'on' ? 0 : 1 );
   	
   	$data = array(
		'item_id' => '',
		'item_type_id' => $item_type_id,
		'parent_item_id' => $parent_item_id,
		'item_name' => $item_name,
		'has_subitem' => $has_subitem,
   		'entry_by'	  => $this->authex->get_user_id()		
	);
	$this->db->insert('cx_items', $data);
	$item_id = $this->db->insert_id();
   	
    if ( $this->input->post('has_subitem') == 'on')
	{
		$this->form_validation->set_rules('unit_id', 'Unit', "required");
		$this->form_validation->set_rules('item_code', 'Item Code', "required");			
		
		// Service
	
		if ($this->input->post('item_type_id') == 1) // 1 = Service
		{
			if ($this->input->post('options_service') == 'on')
			{
				// Binding Data
				$item_details = array(
						'item_details_id' => '',
						'item_id' => $item_id,
						'unit_id' => $unit_id,
						'item_code' => $item_code,
						'item_option_id' => 1, // see cx_item_options table
				);
				$item_purchase = array(
						'id' => '',
						'cost' => currency_to_number($purchase_cost) ,
						'account_to_debit' => $expense_account,
						'item_id' => $item_id,						
				);
				$item_sales = array(
						'id' => '',
						'price' => currency_to_number($price) ,
						'account_to_credit' => $income_accounts,
						'item_id' => $item_id,
				);				
				//Inserting Into Database Table
				$this->db->insert('cx_item_details', $item_details);
				$this->db->insert('cx_item_purchase', $item_purchase);
				$this->db->insert('cx_item_sales', $item_sales);
				
			}
			else
			{
				// Binding Data
				$item_details = array(
						'item_details_id' => '',
						'item_id' => $item_id,
						'unit_id' => $unit_id,
						'item_code' => $item_code,
						'item_option_id' => NULL,
				);
				$item_sales = array(
						'id' => '',
						'price' => currency_to_number($price) ,
						'account_to_credit' => $income_accounts,
						'item_id' => $item_id,
				);
				//Inserting Into Database Table
				$this->db->insert('cx_item_details', $item_details);				
				$this->db->insert('cx_item_sales', $item_sales);

			}
		}
		elseif ($this->input->post('item_type_id') == 2) // 2 = Inventory Part
		{
					
			// Binding Data
			$item_details = array(
					'item_details_id' => '',
					'item_id' => $item_id,
					'unit_id' => $unit_id,
					'item_code' => $item_code,
					'item_option_id' => NULL,
			);
			$item_purchase = array(
					'id' => '',
					'cost' => currency_to_number($purchase_cost)  ,
					'account_to_debit' => $cogs_account,
					'item_id' => $item_id,
			);
			$item_sales = array(
					'id' => '',
					'price' => currency_to_number($price) ,
					'account_to_credit' => $income_accounts,
					'item_id' => $item_id,
			);
			$item_inventory = array(
					'id' => '',
					'asset_account' => $asset_account,
					'reorder_level' => $reorder_level,
					'item_id' => $item_id,
			);
			//Inserting Into Database Table
			$this->db->insert('cx_item_details', $item_details);
			$this->db->insert('cx_item_purchase', $item_purchase);			
			$this->db->insert('cx_item_sales', $item_sales);
			$this->db->insert('cx_item_inventory', $item_inventory);
			
		}
		elseif ($this->input->post('item_type_id') == 3) // 3 = Inventory Assembly
		{						
			// Binding Data
			$item_details = array(
					'item_details_id' => '',
					'item_id' => $item_id,
					'unit_id' => $unit_id,
					'item_code' => $item_code,
					'item_option_id' => NULL,
			);

			$item_purchase = array(
					'id' => '',
					'cost' => currency_to_number($complete_total) ,
					'account_to_debit' => $cogs_account,
					'item_id' => $item_id,
			);
			$item_sales = array(
					'id' => '',
					'price' => currency_to_number($price),
					'account_to_credit' => $income_accounts,
					'item_id' => $item_id,
			);	
			$item_inventory = array(
					'id' => '',
					'asset_account' => $asset_account,
					'reorder_level' => $reorder_level,
					'item_id' => $item_id,
			);
			
			//Inserting Into Database Table
			$this->db->insert('cx_item_details', $item_details);
			$this->db->insert('cx_item_purchase', $item_purchase);
			$this->db->insert('cx_item_sales', $item_sales);
			$this->db->insert('cx_item_inventory', $item_inventory);
			
			$product_id 	= $this->input->post('product_id');
			$cost 			= $this->input->post('cost');
			$quantity 		= $this->input->post('quantity');
			$total 			= $this->input->post('total');
			
			
			if (count($product_id) > 0)
			{				
				for ($i = 0; $i < count($product_id); $i++)
				{
					if ($product_id[$i] != "")
					{
						$cx_item_bill_of_materials = array(
								'id' => '',
								'item_id' 	=> $product_id[$i],
								'cost' 		=> $cost[$i],
								'quantity' 	=> $quantity[$i],
								'total'		=> currency_to_number( $total[$i] ),
								'parent_item_id	'=> $item_id
						);				
						//Inserting Into Database Table
						$this->db->insert('cx_item_bill_of_materials', $cx_item_bill_of_materials );						
					}
				}			
			}
			
		}
		elseif ($this->input->post('item_type_id') == 4) // 1 = // Non Inventory
		{
			if ($this->input->post('options_non_inventory') == 'on')
			{
				// Binding Data
				$item_details = array(
						'item_details_id' => '',
						'item_id' => $item_id,
						'unit_id' => $unit_id,
						'item_code' => $item_code,
						'item_option_id' => 2, // see cx_item_options table
				);
				$item_purchase = array(
						'id' => '',
						'cost' => $purchase_cost,
						'account_to_debit' => $cogs_account,
						'item_id' => $item_id,
				);
				$item_sales = array(
						'id' => '',
						'price' => $price,
						'account_to_credit' => $income_accounts,
						'item_id' => $item_id,
				);
				//Inserting Into Database Table
				$this->db->insert('cx_item_details', $item_details);
				$this->db->insert('cx_item_purchase', $item_purchase);
				$this->db->insert('cx_item_sales', $item_sales);
				
				
			}
			else
			{
				$this->form_validation->set_rules('office_supply_price', 'Price', "required");
				$this->form_validation->set_rules('office_supply_accounts', 'Accounts', "required");
				
				// Binding Data
				$item_details = array(
						'item_details_id' => '',
						'item_id' => $item_id,
						'unit_id' => $unit_id,
						'item_code' => $item_code,
						'item_option_id' => NULL,
				);
				$item_sales = array(
						'id' => '',
						'price' => $office_supply_price,
						'account_to_credit' => $office_supply_accounts,
						'item_id' => $item_id,
				);
				//Inserting Into Database Table
				$this->db->insert('cx_item_details', $item_details);			
				$this->db->insert('cx_item_sales', $item_sales);
				
			}
		}
	}
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

   function get_product_items_with_price()
   {
	   	$sql = "SELECT cx_items.item_id, item_name, price FROM cx_items
					LEFT JOIN cx_item_sales ON cx_item_sales.item_id = cx_items.item_id
					WHERE has_subitem = ? ORDER BY item_name ASC";
	   	$getData = $this->db->query($sql, array( 0 )); // 0 Means it has no subitem and it is a complete product	   
	   	if($getData->num_rows() > 0)
	   		return $getData->result_array();
	   	else
	   	return null;
   }
   
   function get_parent_item_type()
   {
   	$sql = "SELECT item_id AS id , item_name AS name , item_type_id AS type FROM cx_items WHERE has_subitem = ? ORDER BY item_name ASC";
   	$getData = $this->db->query($sql, array( 1 )); // 0 Means it has no subitem and it is a complete product
   	if($getData->num_rows() > 0)
   		return $getData->result_array();
   	else
   		return null;
   }
   

}
