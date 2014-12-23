<?php
class Mod_generic extends CI_Model {
	
	function check_if_unique($searchKey, $data, $wheres=NULL)
	{			
		$this->db->select('*');
		$this->db->from($data['tablename']);
		$this->db->where($data['searchColumn'] , $searchKey);		
		if($data['primary_keyValue'])
		{		
			$this->db->where($data['primary_key'] .' !=', $data['primary_keyValue'] );
		}
		if(!empty($wheres))	
		{
			foreach ($wheres as $keys=>$values)
			{
				$this->db->where( $keys , $values );
			}
		}		
		$getData = $this->db->get('');		
		if($getData->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;		
		}			
	}
	
}