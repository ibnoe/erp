<?php
class Mod_search extends CI_Model {
	
	
//------------------Search A Product Information BY Product Serial--------------
	
	function search_inventory(){
		
	$product_serial=trim($this->input->post('product_serial'));
		
	$getData = $this->db->query("
	
		SELECT 
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
		
		WHERE cane_product_serials.product_serial='$product_serial'
		
		");
	
		if($getData->num_rows() > 0)
		return $getData->result_array();
		else
		return null;
		
}
	
//------------------Search A Sales Invoice --------------

	function get_invoice_num($serial){
		
		
		$query = $this->db->query("SELECT sales_id FROM cane_sales_p_serials
		LEFT JOIN cane_sales_details ON cane_sales_details.sales_details_id=cane_sales_p_serials.sold_details_id
		WHERE sold_product_serial='$serial'");
				
					if($query->num_rows() > 0) {
							foreach ($query->result() as $row){
								
								   $sales_id= $row->sales_id;
								   					   
								}	
						
					}	
		
		if(!empty($sales_id)){return $sales_id; } else {return FALSE;}
		
				
		
	}//function ends
	
	
function getcheck_valid_invoice($serial){
		
		
		$query = $this->db->query("SELECT id FROM cane_sales WHERE invoice_number='$serial'");
				
		if($query->num_rows() > 0) {
						
			foreach ($query->result() as $row){
								
			   $invoice_num= $row->id;
								   					   
			}
			return $invoice_num;								
								
		} else {return FALSE;}	
		
}//function ends
	
	
function cash_invoice($sales_id){
	
			$this->db->select('*');
			$this->db->from('cane_sales');
			$this->db->join('cane_admin', 'cane_admin.admin_id = cane_sales.sold_by');
			$this->db->where('cane_sales.id', $sales_id);
			$this->db->group_by('cane_sales.id'); 											
			$getData = $this->db->get('');
			if($getData->num_rows() > 0)
			return $getData->result_array();
			else
			return null;
	}
	
	
function party_invoice($sales_id){
	
			$this->db->select('*');
			$this->db->from('cane_sales');
			$this->db->join('cane_party', 'cane_party.party_id = cane_sales.party_id');
			$this->db->join('cane_admin', 'cane_admin.admin_id = cane_sales.sold_by');
			$this->db->where('cane_sales.id', $sales_id);
			$this->db->group_by('cane_sales.id'); 											
			$getData = $this->db->get('');
			if($getData->num_rows() > 0)
			return $getData->result_array();
			else
			return null;
	}
	
function get_invoice($sales_id){
	
	$query = $this->db->query("SELECT sale_type FROM cane_sales WHERE id='$sales_id'");
	
	if($query->num_rows() > 0) {
		
				foreach ($query->result() as $row){
									
						  $sale_type = $row->sale_type;
				}
				
			if($sale_type=='1') {
				
				return $this->cash_invoice($sales_id);
			} else {
				
				return $this->party_invoice($sales_id);
			}
	} else {return NULL;}		
	
	
}	

function get_products($sales_id){
	
	
	$getData = $this->db->query("
	
		SELECT brand_name,category_name,product_item,selling_price,buy_price,quantity,sold_product_serial,warranty,purchase_voucher,purchase_date	
		FROM
		(
			SELECT * FROM cane_sales_details
			LEFT JOIN  
			(
				SELECT sold_details_id,sold_product_serial,warranty,purchase_voucher,purchase_date FROM cane_sales_p_serials
				LEFT JOIN cane_purchase ON cane_purchase.purchase_id=cane_sales_p_serials.purchase_id
			) k ON k.sold_details_id=cane_sales_details.sales_details_id
			
		) as j
		
		LEFT JOIN (
			SELECT product_id,brand_name,category_name,product_item FROM cane_products
			LEFT JOIN cane_category ON cane_category.category_id=cane_products.category_id 
			LEFT JOIN cane_brand ON cane_brand.brand_id=cane_products.brand_id
		) e ON e.product_id=j.product_id
		
		WHERE j.sales_id='$sales_id'
			
			");
	
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
		
}

//-------------------------- Cheuqe----------------------

function verify_cheque_result(){
	
	$cheque_number=trim($this->input->post('cheque_number'));
	
	$getData = $this->db->query("
			
		SELECT voucher_number, trans_date, narration, dr_side, cr_side,amount
		FROM (
		
		SELECT id, parent_voucher, cheque_id, dr_side, cr_side,amount
		FROM cane_entries
		LEFT JOIN cane_cheques ON cane_entries.id = cane_cheques.top_journal
		WHERE cheque_number = '$cheque_number'
		UNION ALL
		SELECT id, parent_voucher, cheque_id, dr_side, cr_side,amount
		FROM cane_entries
		LEFT JOIN cane_cheques ON cane_entries.id = cane_cheques.bottom_journal
		WHERE cheque_number = '$cheque_number'
		ORDER BY id ASC
		) AS f
		LEFT JOIN cane_voucher ON cane_voucher.voucher_id = f.parent_voucher
	
	
			
		");
	
		if($getData->num_rows() > 0)
		return $getData->result_array();
		else
		return null;
	
}

//--------- Search All Products of a Party----------------------- 

function search_product_byparty($party_id){
	
			
	$getData = $this->db->query("
	
		SELECT 
		serial_id,brand_name,category_name,product_item,product_serial,product_warranty,party_invoice,purchase_date,party_name,party_id,purchase_voucher
		FROM  cane_product_serials
			
		LEFT JOIN (
			SELECT product_id,brand_name,category_name,product_item,warranty_product FROM cane_products
			LEFT JOIN cane_category ON cane_category.category_id=cane_products.category_id 
			LEFT JOIN cane_brand ON cane_brand.brand_id=cane_products.brand_id
		) e ON e.product_id=cane_product_serials.product_id
		
		LEFT JOIN (
			SELECT purchase_id,party_invoice,party_name,cane_purchase.party_id,purchase_date,purchase_voucher FROM cane_purchase
			LEFT JOIN cane_party ON cane_party.party_id= cane_purchase.party_id
			
		) j ON j.purchase_id=cane_product_serials.purchase_id
		WHERE party_id='$party_id'
		ORDER BY category_name
		
		
		");
	
		if($getData->num_rows() > 0)
		return $getData->result_array();
		else
		return null;
		
		
	}
	
// -----------------------------------------------------Search Credit Memo Invoice--------------------------------------------

function search_credit_memo(){
		
	$serial=trim($this->input->post('serial'));
		
	$query = $this->db->query("SELECT sales_return_id FROM cane_sales_return WHERE sales_return_invoice='$serial'");
	
	if($query->num_rows() > 0) {
		
				foreach ($query->result() as $row){
									
						  $sales_return_id = $row->sales_return_id;
				}
				
				return $sales_return_id;
	}			
	else { 
		
		return FALSE;
	
	}
	
		
}

// -----------------------------------------------------Search Purchase Voucher--------------------------------------------

function search_purchase_voucher() {
	
	$serial=trim($this->input->post('serial'));
	$search_by=trim($this->input->post('search_by'));
	
	if($search_by=='2') { // 2= Product Serial Number
		
				$query = $this->db->query("SELECT purchase_id FROM cane_sales_p_serials WHERE sold_product_serial='$serial'");
		
				if($query->num_rows() > 0) {
		
				foreach ($query->result() as $row){
									
					$data = $row->purchase_id;
				}
		
				} else {
			
				$query = $this->db->query("SELECT purchase_id FROM cane_product_serials WHERE product_serial='$serial'");
					
					
				if($query->num_rows() > 0) {
				
					foreach ($query->result() as $row){
											
							$data = $row->purchase_id;
					}
				
				}
					
			}
			
		$field_name='purchase_id';
	
	}
	else {
		
		$field_name="purchase_voucher";
		$data= $serial;
		
	}
	
	
	
	 $this->db->select('*');
	 $this->db->from('cane_purchase');
	 $this->db->join('cane_admin', 'cane_admin.admin_id = cane_purchase.entry_by');
	 $this->db->join('cane_party', 'cane_party.party_id = cane_purchase.party_id');
					
	 $this->db->where($field_name, $data);
		
	 $getData = $this->db->get('');
	 if($getData->num_rows() > 0)
	 return $getData->result_array();
	 else
	 return null;

}
	
// -----------------------------------------------------RMA Stuff--------------------------------------------
	
function check_rma_invoice(){
		
	$invoice_number=$this->input->post('invoice_number');
	
	$query = $this->db->query("SELECT rep_delivery_id FROM cane_rep_delivery WHERE rep_delivery_invoice='$invoice_number'");
				
					if($query->num_rows() > 0) {
							foreach ($query->result() as $row){
								
								   $invoice_num= $row->rep_delivery_id;
								   					   
								}	
						
					}	
		
		if(!empty($invoice_num)){return $invoice_num; } else {return FALSE;}
				

}

// Get the records of rma from rma model	
}
	
	