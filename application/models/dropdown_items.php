<?php
class Dropdown_items extends CI_Model{
	
	public function create_dropdown($table, $id, $name, $select_text, Array $whereQuery = NULL )
	{
		if(is_array($whereQuery))
		{
			$records = $this->db->select("$id, $name")->where($whereQuery)->get($table);
		}
		else 
		{
			$records = $this->db->select("$id, $name")->get($table);		
		}				
		$data[''] = $select_text ;

		if($records->num_rows() > 0 )
		{
			foreach ($records->result_array() as $row)
			{
				$data[$row[$id]] = $row[$name] ;
			}
		}
		return $data; 		
	}
	
	
	function get_account_heads($id)
	{
		$cogs_account_id = $this->config->item('cogs_account_id');
		$sql = "SELECT acc_id, account_code, account_name FROM cx_account_heads 
				WHERE parent_group IN (
					SELECT acc_group_id FROM cx_account_groups WHERE grand_parent = ? OR acc_group_id = ?
				) ORDER BY account_code ASC";
		$records = $this->db->query($sql, array( $id, $id ));
		
		$data[''] = 'Select an account';
		
		foreach ($records->result() as $row)
		{
			$data[$row->acc_id] = $row->account_name;
		}
		return $data;		
	}
	
	
	
}