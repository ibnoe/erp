<?php
class Dropdown_items extends CI_Model{
	
	function get_items()
	{
		$records = $this->db->select('*')->get('cx_items');
	
		$data[''] = 'Select a parent item';
			
		foreach ($records->result() as $row)
		{
			$data[$row->item_id] = $row->item_name;
		}
		return $data;
	}
	
	function get_item_types() 
	{		 	
		$records = $this->db->select('*')->get('cx_item_types');	
	
		$data[''] = 'Select an item type';
		 
		foreach ($records->result() as $row)
		{	
			$data[$row->item_type_id] = $row->item_type_name;	
		}	
		return $data;		 
	}
	
	function get_units()
	{
		$records = $this->db->select('*')->get('cx_units');
	
		$data[''] = 'Select an unit';
			
		foreach ($records->result() as $row)
		{
			$data[$row->unit_id] = $row->unit_name;
		}
		return $data;
	}
	
}