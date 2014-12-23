<?php
class Mod_rma extends CI_Model {

	
function add_to_warranty($user_id){	
	
	$product_serial=($_POST['product_serial']);
	$customer_name=$this->input->post('customer_name');
	$customer_contact=$this->input->post('customer_contact');
	
	$year=date("Y");
	$warr_invoiceid=$this->gen_invoice_number();
	$invoice_number=sprintf("%06s", $warr_invoiceid) ;
	
	
	// First 
				$data = array(
						'warranty_id' => '',
						'warranty_invoice' =>'CMP-PC-'.$year.'-'.$invoice_number,
						'warranty_num' => $warr_invoiceid, 
						'generated_date' => date("Y-m-d"),
						'entry_by' => $user_id,
						'customer_name' => $customer_name,
						'customer_contact' => $customer_contact,
						);
					$this->db->insert('cane_warranty', $data); 	
						 								
							
			$autovalue=mysql_insert_id();// last auto incremented id
	
	for($i=0; $i< count($product_serial); $i++){
	
						$data = array(
						'warr_id' => '',
						'on_warranty_serial' =>$product_serial[$i],
						'parent_warranty_id' => $autovalue,
						'problem_solved' => '0'
						);
												 								
				$this->db->insert('cane_warranty_items', $data); 		
		}				
						
		return  $autovalue;				
	
}						




function gen_invoice_number(){
	
	$year = date("Y");	
	
	$query = $this->db->query("SELECT max(warranty_num) AS MAXNUM FROM cane_warranty WHERE year(generated_date)='$year'");

					foreach ($query->result() as $row)
					{
					   $value1= $row->MAXNUM;
					   					   
					}
						
						
			$strLen = strlen($value1);
			$value  = (((int) $value1) + 1);
			
		return	 str_pad($value, $strLen, '0', STR_PAD_LEFT);
}



function warranty_printing1($autovalue){
	
		$this->db->select('*');
		$this->db->from('cane_warranty');
		$this->db->join('cane_admin', 'cane_admin.admin_id = cane_warranty.entry_by');
		$this->db->where('warranty_id', $autovalue); 											
		$getData = $this->db->get('');
		if($getData->num_rows() > 0)
		return $getData->result_array();
		else
		return null;
}

function warranty_printing2($autovalue){
	
	$getData = $this->db->query("
	
		SELECT
		
		brand_name,
		category_name,
		product_item,
		sold_product_serial,
		sold_date,
		invoice_number 
		FROM cane_sales_details

		LEFT JOIN  cane_sales_p_serials ON  cane_sales_p_serials.sold_details_id =cane_sales_details.sales_details_id
		LEFT JOIN cane_sales ON cane_sales.id=cane_sales_details.sales_id
		LEFT JOIN (
			SELECT product_id,brand_name,category_name,product_item FROM cane_products
			LEFT JOIN cane_category ON cane_category.category_id=cane_products.category_id 
			LEFT JOIN cane_brand ON cane_brand.brand_id=cane_products.brand_id
	  	 ) e ON e.product_id=cane_sales_details.product_id
		WHERE sold_product_serial IN (SELECT on_warranty_serial FROM cane_warranty_items WHERE parent_warranty_id='$autovalue')
	
		
	");
	
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
		
}


function product_on_warranty_list($daterange1,$daterange2){
	
	
	$daterange1=date("Y-m-d", strtotime($daterange1));
	$daterange2=date("Y-m-d", strtotime($daterange2));
	
	$getData = $this->db->query("
	
	SELECT warr_id,on_warranty_serial,brand_name,category_name,product_item,warranty_invoice,generated_date,customer_name,customer_contact
		
		FROM (
		
					SELECT warr_id,on_warranty_serial,product_id,warranty_invoice,generated_date,customer_name,customer_contact 
					
					FROM ( 
							
					SELECT 
					warr_id,on_warranty_serial,sold_details_id,warranty_invoice,generated_date,customer_name,customer_contact
					FROM cane_warranty_items
					LEFT JOIN cane_warranty ON cane_warranty.warranty_id=cane_warranty_items.parent_warranty_id
					LEFT JOIN cane_sales_p_serials ON cane_sales_p_serials.sold_product_serial=cane_warranty_items.on_warranty_serial
					WHERE generated_date between '$daterange1' and '$daterange2' AND problem_solved='0' 
					GROUP BY warr_id
					
					) as t 
					LEFT JOIN  cane_sales_details ON  cane_sales_details.sales_details_id=t.sold_details_id
		
		) as k
		LEFT JOIN (
			SELECT product_id,brand_name,category_name,product_item FROM cane_products
			LEFT JOIN cane_category ON cane_category.category_id=cane_products.category_id 
			LEFT JOIN cane_brand ON cane_brand.brand_id=cane_products.brand_id
		) e ON e.product_id=k.product_id
					
			");

	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
		
}

function delete_product_on_warranty(){
	
	$id=$this->input->post('id');
	
	$query = $this->db->query("DELETE FROM cane_warranty_items WHERE warr_id='$id'");

		$afftectedRows = $this->db->affected_rows();
		
		if($afftectedRows > 0){
			
			return 1;
		}
		else {
			
			2 ;
		}
	
}

function if_valid_warranty_invoice_info(){
	
	
	$warranty_invoice=$this->input->post('serial');
	
	
$query = $this->db->query("SELECT warranty_id FROM cane_warranty 
							LEFT JOIN cane_warranty_items ON cane_warranty_items.parent_warranty_id=cane_warranty.warranty_id
							WHERE warranty_invoice='$warranty_invoice' OR on_warranty_serial='$warranty_invoice'");

			if($query->num_rows() > 0) {

					foreach ($query->result() as $row)
					{
					   $warranty_id= $row->warranty_id;
					   					   
					}
					
					return  $warranty_id ;
										
			} else {
				
				return FALSE;
			}		
	
	
	
}

function confirm_product_delivery($user_id){
	
	$customer_name=$this->input->post('customer_name');
	$customer_contact=$this->input->post('customer_contact');
	$delivery_date=date("Y-m-d",strtotime($this->input->post('delivery_date')));
	
		
	$previous_product_id=($_POST['previous_product_id']);
	$previous_product_serial=($_POST['previous_product_serial']);
	$product_name=($_POST['product_name']);
	$sales_invoice=($_POST['sales_invoice']);
	

	$new_product_id=($_POST['new_product_id']);
	
	$new_product_serial=($_POST['new_product_serial']);
	$new_product_name=($_POST['new_product_name']);
	$acc_rec=($_POST['acc_rec']);
	$acc_pay=($_POST['acc_pay']); 
	
	$year=date("Y");
	$invoiceid=$this->gen_rpd_invoice_number();
	$rpd_invoice_number=sprintf("%06s", $invoiceid) ;
	
						$data = array(
						'rep_delivery_id' => '',
						'rep_delivery_invoice' =>'RPD-PC-'.$year.'-'.$rpd_invoice_number,
						'rep_delivery_num' =>$invoiceid,
						'rep_delivery_date' => $delivery_date,
						'customer_name'=>$customer_name,
						'customer_contact'=>$customer_contact,
						'prepared_by'=>$user_id,
									
												 								
						);
						$this->db->insert('cane_rep_delivery', $data);
	
						$autovalue=mysql_insert_id();// last auto incremented id
	
		for($i=0; $i< count($previous_product_serial); $i++){
				
						$data = array(
						'rep_items_id' => '',
						'previous_product_id' =>$previous_product_id[$i],
						'previous_product_serial' =>$previous_product_serial[$i],
						'sales_invoice' => $sales_invoice[$i],
						'new_product_id'=>$new_product_id[$i],
						'new_product_serial'=>$new_product_serial[$i],
						'acc_rec'=>$acc_rec[$i],
						'acc_pay'=>$acc_pay[$i],
						'parent_delivery_id'=>$autovalue
												 								
						);
						$this->db->insert('cane_rep_delivery_products', $data); 
						
			// Deleting Product Serials From Warrany Table
			$query = $this->db->query("DELETE FROM cane_warranty_items WHERE on_warranty_serial='$previous_product_serial[$i]'");
					
						
		}			

		
		return 	$autovalue;			
		
		
	
}

	

function gen_rpd_invoice_number(){
	
	$year = date("Y");	
	
	$query = $this->db->query("SELECT max(rep_delivery_num) AS MAXNUM FROM cane_rep_delivery WHERE year(rep_delivery_date)='$year'");

					foreach ($query->result() as $row)
					{
					   $value1= $row->MAXNUM;
					   					   
					}
						
						
			$strLen = strlen($value1);
			$value  = (((int) $value1) + 1);
			
		return	 str_pad($value, $strLen, '0', STR_PAD_LEFT);
}


function delivered_item_print1($autovalue){

	$getData = $this->db->query("
	
	SELECT 	rep_delivery_invoice,rep_delivery_date,customer_name,customer_contact,admin_name FROM  cane_rep_delivery
	LEFT JOIN cane_admin ON cane_admin.admin_id=cane_rep_delivery.prepared_by
	WHERE rep_delivery_id='$autovalue'
	");
	
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
	
	
}



function delivered_item_print2($autovalue){

	
	$getData = $this->db->query("
	
	SELECT 	*	
	FROM (		
		SELECT
		product_item AS new_product_item,
		cane_brand.brand_name AS new_brand_item,
		cane_category.category_name AS new_category_item  
				
		FROM cane_products
		LEFT JOIN cane_brand ON cane_brand.brand_id = cane_products.brand_id
		LEFT JOIN cane_category ON cane_category.category_id = cane_products.category_id
		WHERE product_id IN (SELECT new_product_id FROM cane_rep_delivery_products WHERE parent_delivery_id='$autovalue')
	) as a,	
	
	(	
		SELECT
		product_item AS previous_product_item,
		cane_brand.brand_name AS previous_brand_item,
		cane_category.category_name AS previous_category_item  
				
		FROM cane_products
		LEFT JOIN cane_brand ON cane_brand.brand_id = cane_products.brand_id
		LEFT JOIN cane_category ON cane_category.category_id = cane_products.category_id
		WHERE product_id IN (SELECT previous_product_id FROM cane_rep_delivery_products WHERE parent_delivery_id='$autovalue')
			
	) as b,
	
	(
		SELECT previous_product_serial,sales_invoice,new_product_serial,acc_rec,acc_pay,sold_date FROM cane_rep_delivery_products
		LEFT JOIN cane_sales ON cane_sales.invoice_number= cane_rep_delivery_products.sales_invoice
		WHERE parent_delivery_id='$autovalue'  
	) as c
	
		
	");
	
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
	
	
}





}