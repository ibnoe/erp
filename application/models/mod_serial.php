<?php
class Mod_serial extends CI_Model {
		
	function using_excel_file($records)
	{
		$product_id = trim($this->input->post('product_id'));
		$warranty_period = trim($this->input->post('warranty_period'));
		$purchase_voucher = trim($this->input->post('purchase_voucher'));
		$purchase_id = $this->get_purchase_id($purchase_voucher);
		
		if (!$this->check_if_product_was_bought($product_id, $purchase_id))
		{
			return 7;
		}
		else
		{
			if ($this->array_search_dups($records))
			{
				return "3"; // Duplicate Entry Found
			} 
			else
			{
				if (!(count($records) <= $this->get_number_of_serial_allowed($product_id , $purchase_id)))
				{
					return 6; // more than allowed
				}
				else
				{
					// Checking if serial already exists in db	
					if ($this->if_serial_already_exists($records))
					{
						return "2";
					}
					else
					{	
						// insert data
	
						for ($i = 0; $i < count($records); $i++)
						{
							$data = array(
								'serial_id' => '',
								'product_serial' => $records[$i],
								'product_id' => $product_id,
								'product_warranty' => $warranty_period,
								'purchase_id' => $purchase_id
							);
							$results = $this->db->insert('cane_product_serials', $data);
						}
	
						return "1";
					} //2
				} //6
			} //3
		} // end of 7
	} //function ends
	
	
	
	function using_form_element()
	{
		
		$product_id = trim($this->input->post('product_id'));
		$warranty_period = trim($this->input->post('warranty_period'));
		$purchase_voucher = trim($this->input->post('purchase_voucher'));
		$purchase_id = $this->get_purchase_id($purchase_voucher);
		
		
	
		if (!$this->check_if_product_was_bought($product_id, $purchase_id))
		{
			return 7;
		}
		else
		{
			$linksArray=($_POST['product_serial']); 	
			foreach($linksArray as $key => $link)
			{
				if ($linksArray[$key] == '')
				{
					unset($linksArray[$key]);
				}
			}
	
			$linksArray = array_values($linksArray);
			$records = $linksArray;
	
			// checking for duplicate values
	
			if ($this->array_search_dups($records))
			{
				return 3; //Duplicate Entry Found
			} 
			else
			{
				if (!(count($records) <= $this->get_number_of_serial_allowed( $product_id , $purchase_id) ))
				{
					return 4;
				}
				else
				{
				// Checking if serial already exists in db	
					if ($this->if_serial_already_exists($records))
					{
						return 2;
					}
					else
					{	
						// insert data
	
						for ($i = 0; $i < count($records); $i++)
						{
							$data = array(
								'serial_id' => '',
								'product_serial' => $records[$i],
								'product_id' => $product_id,
								'product_warranty' => $warranty_period,
								'purchase_id' => $purchase_id
							);
							$results = $this->db->insert('cane_product_serials', $data);
						}
	
						return 1;
					} //2
				} //4
			} //3
		} //7
	} //function ends
	
	
	
	
	function product_serial_list($product_id){


		$sql = "SELECT 
				serial_id,brand_name,category_name,product_item,product_serial,product_warranty,party_invoice,purchase_date,party_name,purchase_voucher
				FROM  cane_product_serials
					
				LEFT JOIN (
					SELECT product_id,brand_name,category_name,product_item,warranty_product FROM cane_products
					LEFT JOIN cane_category ON cane_category.category_id=cane_products.category_id 
					LEFT JOIN cane_brand ON cane_brand.brand_id=cane_products.brand_id
				) e ON e.product_id=cane_product_serials.product_id
				
				LEFT JOIN (
					SELECT purchase_id,party_invoice,party_name,purchase_date,purchase_voucher FROM cane_purchase
					LEFT JOIN cane_party ON cane_party.party_id= cane_purchase.party_id
				) j ON j.purchase_id=cane_product_serials.purchase_id
				
				WHERE cane_product_serials.product_id = ? ";				
		
   		$query = $this->db->query($sql,array( $product_id ));		
		

		if($query->num_rows() > 0)
		return $query->result_array();
		else
		return null;

	}

	function delete_serial(){

		$id = trim($this->input->post('id'));
		
		$sql = "DELETE FROM cane_product_serials WHERE serial_id= ? ";		
   		$query = $this->db->query($sql,array( $id ));	

		if($this->db->affected_rows()) 
		{	
			return 1;
		} 
		else 
		{
			return 2;
		}
	}
	
	
	function array_search_dups($array) 
	{

		$dup_array = $array;
		$dup_array = array_unique($dup_array);
		if(count($dup_array) != count($array))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	function get_number_of_serial_allowed($product_id , $purchase_id ){
		
		

		$sql = " SELECT TotalSerial,TotalQuantity 
				 FROM (
						SELECT count(serial_id) as TotalSerial FROM cane_product_serials WHERE purchase_id = ? AND product_id = ?
					  )a, 
					  (
						Select p_quantity as TotalQuantity FROM cane_purchase_details WHERE purchase_id = ? and p_product_id = ?
					 ) b" ;
		
		$query = $this->db->query($sql,array( $purchase_id , $product_id ,$purchase_id , $product_id ));		
		
		if ($query->num_rows() > 0){
				foreach ($query->result() as $row)
				{
					$TotalSerial = $row->TotalSerial;
					$TotalQuantity   = $row->TotalQuantity;
		
				}
				
				if( $TotalQuantity > $TotalSerial )
				{
					$value = $TotalQuantity - $TotalSerial;
					
				}
				else 
				{
					$value = $TotalSerial - $TotalQuantity;
					
				}			
		
				if($value > 0)
				{ 
					return $value;
				} 
				else 
				{ 
					return "0" ;
				}
		}		


	}//ends
	
	
	
	function get_purchase_id($purchase_voucher)
	{
		
		$sql = "SELECT purchase_id FROM cane_purchase WHERE purchase_voucher = ?";
		
   		$query = $this->db->query($sql,array( $purchase_voucher ));		

		if ($query->num_rows() > 0)
		{ 			
			foreach($query->result() as $row)
			{
				$purchase_id = $row->purchase_id;
			}
			return $purchase_id;			
		} 
		else 
		{ 
			echo false; 
		}
	}
	
	
	// Checking if the product was actually bought
	function check_if_product_was_bought($product_id,$purchase_id)
	{
		
		$sql = "SELECT p_details_id FROM cane_purchase_details WHERE purchase_id = ? AND p_product_id= ? ";
		
   		$query = $this->db->query($sql,array( $purchase_id, $product_id ));		

		if ($query->num_rows() > 0)
		{ 
			return true;
		} 
		else 
		{ 
			echo false; 
		}


	}
	
	function if_serial_already_exists($records)
	{
		
		$result = 0;
		for ($i = 0; $i < count($records); $i++)
		{		
			$sql = "SELECT serial_id FROM  cane_product_serials WHERE product_serial = ? ";		
   			$query = $this->db->query($sql,array( $records[$i] ));				
			$result+= $query->num_rows();
		 }
		 return $result;
		 
		if ($result > 0)
		{
			return TRUE;
		}
		else 
		{
			 return FALSE ;
		}
		
		
	}
	
	
	function validity_check_purchase_voucher(){

		$purchase_voucher=$this->input->post('purchase_voucher');
		
		$sql = "SELECT purchase_id FROM cane_purchase WHERE purchase_voucher = ? ";		
   		$query = $this->db->query($sql,array( $purchase_voucher ));		

		if ($query->num_rows() > 0)
		{ 
			return true;
		} 
		else 
		{ 
			echo false; 
		}

	}
	
	
	
	
}