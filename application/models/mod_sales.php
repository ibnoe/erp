<?php
class Mod_sales extends CI_Model {

	
	function confirm_cash_sales()
	{
		
		$sold_date = date("Y-m-d", strtotime(trim($this->input->post('sold_date'))));
		$invoiceid = $this->gen_invoice_number();
		$customer_name = trim($this->input->post('customer_name'));
		$customer_contact = trim($this->input->post('customer_contact'));
		$total_amount = str_replace(',', '', trim($this->input->post('total_amount')));
		$product_id = ($_POST['product_id']);
		$buy_price = ($_POST['buy_price']);
		$selling_price = ($_POST['rate']);
		$quantity = ($_POST['quantity']);
		$product_serial = ($_POST['product_serial']);
		$warranty = ($_POST['warranty']);
		$purchase_id = ($_POST['purchase_id']);
		$year = date("Y");
		$invoice_number = sprintf("%06s", $invoiceid);
		$complete_invoice = 'INV-PC-' . $year . '-' . $invoice_number;
		$timezone = new DateTimeZone("Asia/Dhaka");
		$date = new DateTime();
		$date->setTimezone($timezone);
		$getdate = $date->format('h:i:s A');
		$data = array(
			'id' => '',
			'invoice_number' => $complete_invoice,
			'number' => $invoiceid,
			'sale_type' => '1', // Cash Sale
			'party_id' => NULL,
			'customer_name' => $customer_name,
			'customer_mobile' => $customer_contact,
			'sold_by' => $this->authex->get_user_id() ,
			'sold_date' => $sold_date,
			'sold_time' => $getdate,
			'total_amount' => $total_amount,
			'amount_received' => $total_amount,
			'balance' => '0',
			'sales_return' => '0'
		);
		$this->db->insert('cane_sales', $data);
		$autovalue = $this->db->insert_id(); // last auto incremented id,  Sales ID
		$cost_of_goods_sold = 0;
		for ($i = 0; $i < count($product_id); $i++)
		{
			$data = array(
				'sales_details_id' => '',
				'sales_id' => $autovalue,
				'product_id' => $product_id[$i],
				'buy_price' => str_replace(',', '', trim($buy_price[$i])) ,
				'selling_price' => str_replace(',', '', trim($selling_price[$i])) ,
				'quantity' => $quantity[$i]
			);
			$this->db->insert('cane_sales_details', $data);
	
			// Adding product serials to new table
	
			if (!empty($product_serial[$i]))
			{
				$sales_details_id = $this->db->insert_id(); // last auto incremented id
	
				// Entering serial numbers to new table
	
				$data = array(
					'sold_serials_id' => '',
					'sold_product_serial' => $product_serial[$i],
					'warranty' => $warranty[$i],
					'purchase_id' => $purchase_id[$i],
					'sold_details_id' => $sales_details_id
				);
				$query = $this->db->insert('cane_sales_p_serials', $data);
			}
	
			$cost_of_goods_sold+= str_replace(',', '', trim($buy_price[$i])) * $quantity[$i];
	
			// updating the product stock
	
			$this->update_product_stock($quantity[$i], $product_id[$i]);
		} // for loop ends
	
		// Delete product serials from its table
	
		$this->delete_product_serials($product_serial);
	
		// Voucher and Journal Entry for Cash Sale -------
	
		$this->voucher_journal_entry($invoice_number, $sold_date, $total_amount, $cost_of_goods_sold);
		
		return $autovalue; // Sales id
	}
	

	function voucher_journal_entry($invoice_number, $sold_date,$total_amount,$cost_of_goods_sold)
	{
	
		// First Step: Make the voucher entry
	
		$data = array(
			'voucher_id' => '',
			'voucher_number' => $invoice_number, // from above
			'narration' => 'Product Sold On Cash',
			'trans_date' => $sold_date,
			'entry_by' => $this->authex->get_user_id()
		);
		$this->db->insert('cane_voucher', $data);
		
		$parent_voucher = $this->db->insert_id();
		
	
		// Second Step: Make the first journal entry	
		$data = array(
			'id' => '',
			'amount' => $total_amount,
			'dr_side' => '1', //Cash Debit
			'cr_side' => '2', // Sales Credit
			'parent_voucher' => $parent_voucher
		);
		$this->db->insert('cane_entries', $data);
	
		// Third Step: Make the second journal entry
	
		$data = array(
			'id' => '',
			'amount' => $cost_of_goods_sold,
			'dr_side' => '4', //COGS Debit
			'cr_side' => '3', // Marchendize Inventory/Purchase Credit
			'parent_voucher' => $parent_voucher
		);
		$this->db->insert('cane_entries', $data);
	
		
	
	}
	
	function delete_product_serials($product_serial) 
	{
		
		for($i = 0; $i < count($product_serial); $i++){
			
			$this->db->delete('cane_product_serials', array('product_serial' => $product_serial[$i])); 
			
		}
		return TRUE ;
		
	}
	
	function update_product_stock($quantity, $product_id )
	{
		
		$sql = "UPDATE cane_products SET in_stock = in_stock-$quantity WHERE product_id = ? ";
		$query = $this->db->query( $sql , array( $product_id  ));
		return TRUE;
	}



	function cash_printing1($sales_id){
	
	$this->db->select('*');
	$this->db->from('cane_sales');
	$this->db->join('cane_admin', 'cane_admin.admin_id = cane_sales.sold_by');
	$this->db->where('cane_sales.id', $sales_id); 											
	$getData = $this->db->get('');
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
	}
	

	function cash_printing2($autovalue){
		
		$sql = "		
				SELECT brand_name,category_name,product_item,selling_price,quantity,sold_product_serial,warranty	
				FROM
				(
					SELECT * FROM cane_sales_details
					LEFT JOIN  cane_sales_p_serials ON cane_sales_p_serials.sold_details_id=cane_sales_details.sales_details_id
				) as j
				
				LEFT JOIN (
					SELECT product_id,brand_name,category_name,product_item FROM cane_products
					LEFT JOIN cane_category ON cane_category.category_id=cane_products.category_id 
					LEFT JOIN cane_brand ON cane_brand.brand_id=cane_products.brand_id
				) e ON e.product_id=j.product_id
				
				WHERE j.sales_id = ? ";	
		
		$getData = $this->db->query( $sql , array( $autovalue  ));
		
		if($getData->num_rows() > 0)
		return $getData->result_array();
		else
		return null;
		
	}



	function confirm_party_sales(){
	
	
		$sold_date = date("Y-m-d", strtotime(trim($this->input->post('sold_date'))));
		$invoiceid = $this->gen_invoice_number();
		$party = trim($this->input->post('party_id'));
		$total_amount = str_replace(',', '', trim($this->input->post('total_amount')));
		$amount_paid = str_replace(',', '', trim($this->input->post('amount_paid')));
		$bal = str_replace(',', '', trim($this->input->post('balance')));
		$balance = str_replace(array(
			"(",
			")"
		) , array(
			"-",
			""
		) , $bal); // to remove brackets and add minus sign if there is any
		$year = date("Y");
		$invoice_number = sprintf("%06s", $invoiceid);
		$complete_invoice = 'INV-PC-' . $year . '-' . $invoice_number;
		$timezone = new DateTimeZone("Asia/Dhaka");
		$date = new DateTime();
		$date->setTimezone($timezone);
		$getdate = $date->format('h:i:s A');
		$data = array(
			'id' => '',
			'invoice_number' => $complete_invoice,
			'number' => $invoiceid,
			'sale_type' => '2', // Party Sale
			'party_id' => $party,
			'customer_name' => NULL,
			'customer_mobile' => NULL,
			'sold_by' => $this->authex->get_user_id() ,
			'sold_date' => $sold_date,
			'sold_time' => $getdate,
			'total_amount' => $total_amount,
			'amount_received' => $amount_paid,
			'balance' => $balance,
			'sales_return' => '0'
		);
		$this->db->insert('cane_sales', $data);
		$product_id = ($_POST['product_id']);
		$buy_price = ($_POST['buy_price']);
		$selling_price = ($_POST['rate']);
		$quantity = ($_POST['quantity']);
		$product_serial = ($_POST['product_serial']);
		$warranty = ($_POST['warranty']);
		$purchase_id = ($_POST['purchase_id']);
		$autovalue = $this->db->insert_id(); // last auto incremented id
		$cost_of_goods_sold = 0;
		
		for ($i = 0; $i < count($product_id); $i++)
		{
			$data = array(
				'sales_details_id' => '',
				'sales_id' => $autovalue,
				'product_id' => $product_id[$i],
				'buy_price' => str_replace(',', '', trim($buy_price[$i])) ,
				'selling_price' => str_replace(',', '', trim($selling_price[$i])) ,
				'quantity' => $quantity[$i]
			);
			$this->db->insert('cane_sales_details', $data);
		
			// Adding product serials to new table
		
			if (!empty($product_serial[$i]))
			{
				$sales_details_id = $this->db->insert_id(); // last auto incremented id
		
				// Entering serial numbers to new table
		
				$data = array(
					'sold_serials_id' => '',
					'sold_product_serial' => $product_serial[$i],
					'warranty' => $warranty[$i],
					'purchase_id' => $purchase_id[$i],
					'sold_details_id' => $sales_details_id
				);
				$this->db->insert('cane_sales_p_serials', $data);
			}
		
			$cost_of_goods_sold+= str_replace(',', '', trim($buy_price[$i])) * $quantity[$i];
		
			// updating the product stock
		
			$this->update_product_stock($quantity[$i], $product_id[$i]);
		} // for loop ends
	
		// Delete product serials from its table
	
		$this->delete_product_serials($product_serial);
	
			
	// Journal Entry - Inventory Redueced due to sale. payment information has to manually done by the user
			
			$query = $this->db->query("SELECT id FROM cane_accounts WHERE parent_id='$party' AND acc_type='3'"); //3 means party

			foreach ($query->result() as $row)
			{
			   $party_account=$row->id;
			}
			
			
			// Voucher Entry First
				$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>$complete_invoice, // from above
				 		'narration' => 'Sold Product to Party', 
						'trans_date' => $sold_date, 
				 		'entry_by' => $this->authex->get_user_id()
											);
				$this->db->insert('cane_voucher', $data); 
							
				$parent_voucher= $this->db->insert_id();
			
			
			// First 
				$data = array(
						'id' => '',
						'amount' => $total_amount,
						'dr_side' => $party_account, //Party Account Debit
						'cr_side' => '2',  // Sales Credit
						'parent_voucher' => $parent_voucher  								
						);
			$this->db->insert('cane_entries', $data); 
			
			// Second
				$data = array(
						'id' => '',
						'amount' => $cost_of_goods_sold,
						'dr_side' => '4', //COGS Debit
						'cr_side' => '3',  // Marchendize Inventory/Purchase Credit
						'parent_voucher' => $parent_voucher 								
						);
			$this->db->insert('cane_entries', $data); 
			
		
		// End of  Journal Entry ------------------------------------------		
			
			
	return $autovalue;	
			
	}	


	function party_printing1($autovalue){
	
		$this->db->select('*');
		$this->db->from('cane_sales');
		$this->db->join('cane_party', 'cane_party.party_id = cane_sales.party_id');
		$this->db->join('cane_admin', 'cane_admin.admin_id = cane_sales.sold_by');
		$this->db->where('cane_sales.id', $autovalue); 											
		$getData = $this->db->get('');
		if($getData->num_rows() > 0)
		return $getData->result_array();
		else
		return null;
	}

	function party_printing2($autovalue){
	
	$sql = "SELECT brand_name,category_name,product_item,selling_price,quantity,sold_product_serial,warranty	
				FROM
				(
					SELECT * FROM cane_sales_details
					LEFT JOIN  cane_sales_p_serials ON cane_sales_p_serials.sold_details_id=cane_sales_details.sales_details_id
				) as j
				
				LEFT JOIN (
					SELECT product_id,brand_name,category_name,product_item FROM cane_products
					LEFT JOIN cane_category ON cane_category.category_id=cane_products.category_id 
					LEFT JOIN cane_brand ON cane_brand.brand_id=cane_products.brand_id
				) e ON e.product_id=j.product_id		
			WHERE j.sales_id = ? ";
	
	$getData = $this->db->query( $sql , array( $autovalue  ));	
	if($getData->num_rows() > 0)
	return $getData->result_array();
	else
	return null;
		
	}

	
	function gen_invoice_number()
	{
	$year = date("Y");
	$query = $this->db->query("SELECT max(number) AS MAXNUM FROM cane_sales WHERE year(sold_date)='$year'");
	foreach($query->result() as $row)
	{
		$value1 = $row->MAXNUM;
	}

	$strLen = strlen($value1);
	$value = (((int)$value1) + 1);
	return str_pad($value, $strLen, '0', STR_PAD_LEFT);
	
	}
	

	function cash_sales_list($daterange1,$daterange2){
		
		// sale_type=1 means cash
		
		$daterange1 = date("Y-m-d", strtotime($daterange1));
		$daterange2 = date("Y-m-d", strtotime($daterange2));
		
		$sql = "SELECT * FROM cane_sales 	
				LEFT JOIN cane_admin ON cane_admin.admin_id = cane_sales.sold_by
				WHERE cane_sales.sold_date between ? and ? AND sale_type='1' 
				ORDER BY cane_sales.id ASC ";					
			
		$getData = $this->db->query( $sql , array( $daterange1, daterange2  ));	
		if($getData->num_rows() > 0)
		return $getData->result_array();
		else
		return null;
	
	}

	function party_sales_list($daterange1,$daterange2){
		
		// sale_type=1 means cash
		
		$daterange1 = date("Y-m-d", strtotime($daterange1));
		$daterange2 = date("Y-m-d", strtotime($daterange2));
		
		$sql = "SELECT * FROM cane_sales 	
				LEFT JOIN cane_admin ON cane_admin.admin_id = cane_sales.sold_by
				LEFT JOIN cane_party ON cane_party.party_id = cane_sales.party_id
				WHERE cane_sales.sold_date between ? and ? AND sale_type='2' 
				ORDER BY cane_sales.id ASC ";					
			
		$getData = $this->db->query( $sql , array( $daterange1, daterange2  ));	

		if($getData->num_rows() > 0)
		return $getData->result_array();
		else
		return null;
	
	}	

//-----------Sales Return ---------------------------------

function sales_return($user_id){
	
	$return_date = date("Y-m-d", strtotime(trim($this->input->post('return_date'))));
	$sales_invoice=trim($this->input->post('sales_invoice'));
	$total_amount=str_replace(',', '', trim($this->input->post('total_amount')));
	$product_serials=trim($this->input->post('product_serials'));	
	
	$product_id=($_POST['product_id']);
	$rate=($_POST['rate']); 
	$unit_cost=($_POST['unit_cost']);
	$quantity=($_POST['quantity']); 
		
	$year=date("Y");
	$invoiceid=$this->gen_sales_return_inv_number();
	$invoice_number=sprintf("%06s", $invoiceid) ;
		
	// Updating Sale invoice status
		$data = array(
						'sales_return' => '1',
						
						);
						$this->db->where('invoice_number', $sales_invoice); 
						$this->db->update('cane_sales', $data); 
	
	// Enter into cane_sales_return
		
						$data = array(
						'sales_return_id' => '',
						'sales_return_invoice' =>'SR-PC-'.$year.'-'.$invoice_number,
						'num' => $invoiceid,
						'against_sales_invoice' =>$sales_invoice,
						'sales_return_total' =>$total_amount,
						'sales_return_date' =>$return_date, 
						'entry_by' =>$user_id,
						
						);
						$this->db->insert('cane_sales_return', $data); 
			
				$autovalue= $this->db->insert_id();	
				
	// Enter into cane_purchase_details
		$total_unit_cost=0;		
		for($i = 0; $i < count($product_id); $i++){
				
				 	$data = array( 
				 		 's_return_details_id'=>'',             
						 'sales_return_id'=>$autovalue,
				 	     'return_product_id'=>$product_id[$i],
				 		 'return_unit_cost'=>str_replace(',', '', trim($unit_cost[$i])),
						 'return_unit_price'=>str_replace(',', '', trim($rate[$i])),
				 	     'return_quantity'=>$quantity[$i], 
					 );		
						 
					
				$query=$this->db->insert('cane_sales_return_details', $data);  
									
			//Finding the current stock and price report			
			$query = $this->db->query("SELECT TRUNCATE(ifnull(buy_price*in_stock,0),2) AS COGS,in_stock FROM  cane_products 
										WHERE product_id='$product_id[$i]'");

					foreach ($query->result() as $row)
					{
					   $cogs= $row->COGS;
					   $in_stock= $row->in_stock;				   
					}
			// calculating the new stock and price	
				$new_cogs=$cogs+(str_replace(',', '', trim($unit_cost[$i]))*$quantity[$i]);
				$new_stock=$in_stock+$quantity[$i];
				
				$number=$new_cogs/$new_stock;
				$new_buy_price= number_format((float)$number, 2, '.', '');
							
				
				// Update Product Price and Quantity		
						$data = array(              
											'buy_price'=>$new_buy_price,
											'in_stock '=>$new_stock
											
								);  				 
												  
											 						                 
						$this->db->where('product_id', $product_id[$i]);
						$this->db->update('cane_products', $data);

						
			$total_unit_cost += (str_replace(',', '', trim($unit_cost[$i]))*$quantity[$i]);			
				
		}// end for loop
		

// Returning the product serials From sold serials
		
$myArray = explode(',', $product_serials);
	
for ($i=0;  $i < count($myArray); $i++) {
		 	
		 	// Getting serials and information
		 $query = $this->db->query("SELECT sold_product_serial,warranty,purchase_id,product_id FROM cane_sales_p_serials
									LEFT JOIN cane_sales_details ON cane_sales_details.sales_details_id= cane_sales_p_serials.sold_details_id	
		 							WHERE sold_product_serial='$myArray[$i]'");
			
			if ($query->num_rows() > 0){
				
							foreach ($query->result() as $row) {
								
								$product_serial = $row->sold_product_serial;
								$warranty = $row->warranty;
								$purchase_id = $row->purchase_id;
								$product_id = $row->product_id;
								 					   					   
							}
				 	
							// Inserting 		
								$data = array(              
											'serial_id'=>'',
											'product_serial'=>$product_serial,
											'product_id'=>$product_id,
											'product_warranty'=>$warranty,
											'purchase_id'=>$purchase_id,
													
										);  				 
								$this->db->insert('cane_product_serials', $data); 	
		
						 // Deleting from previous table
		
						 $query = $this->db->query("DELETE FROM cane_sales_p_serials WHERE sold_product_serial='$myArray[$i]'");
										
		 	} 						
					
}// for loop ends				
						
		// Make the journal Entry for increasing the inventory due to sales return
		
			$query = $this->db->query("SELECT party_id FROM cane_sales WHERE invoice_number='$sales_invoice'");
			
				foreach ($query->result() as $row) {
						
						  $party = $row->party_id;
						 					   					   
					}
								
			if(!$party==NULL){
						
					$query = $this->db->query("SELECT id FROM cane_accounts WHERE parent_id='$party' AND acc_type='3'"); //3 means party
	
					foreach ($query->result() as $row) {
						
						  $credit_account = $row->id;
						 					   					   
					}
					
					
			} else {
				
				$credit_account='1'; // Cash
			}		
			
			
				// Voucher Entry First
				$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>'SR-PC-'.$year.'-'.$invoice_number, // from above
				 		'narration' => 'Sales Return', 
						'trans_date' => $return_date, 
				 		'entry_by' => $user_id
											);
				$this->db->insert('cane_voucher', $data); 
							
				$parent_voucher= $this->db->insert_id();	
						
				//Journal Entry
								$data = array(
									  	'id' => '',
							 		  	'amount' =>$total_unit_cost,
								 		'dr_side' => '3', // Purchase/ Marchandize Inventory
										'cr_side' => '4', // Cost of Goods Sold
								 		'parent_voucher' => $parent_voucher,
																							   
									);
								$this->db->insert('cane_entries', $data); 
																		
								$data = array(
									  	'id' => '',
							 		  	'amount' => $total_amount,
								 		'dr_side' => '5', // Sales Return
										'cr_side' => $credit_account, // Party/Cash
								 		'parent_voucher' => $parent_voucher,
																											   
									);
								$this->db->insert('cane_entries', $data); 
		
		return $autovalue;	
	
	
	
}


function gen_sales_return_inv_number(){
	
	$year = date("Y");	
	
	$query = $this->db->query("SELECT max(num) AS MAXNUM FROM  cane_sales_return WHERE year(sales_return_date)='$year'");

	foreach ($query->result() as $row)
	{
	   $value1= $row->MAXNUM;
	 }
						
	$strLen = strlen($value1);
	$value  = (((int) $value1) + 1);
			
	return	 str_pad($value, $strLen, '0', STR_PAD_LEFT);
}


function sales_return_printing1($id){
	
		$getData = $this->db->query("
					SELECT 
					sales_return_invoice,
					against_sales_invoice,
					sales_return_total,
					sales_return_date,
					admin_name,
					customer_name,
					customer_mobile,
					party_name,
					party_contact 
					FROM cane_sales_return
					LEFT JOIN cane_admin ON cane_admin.admin_id=cane_sales_return.entry_by
					LEFT JOIN
					(
						SELECT invoice_number,party_name,party_contact,customer_name,customer_mobile FROM cane_sales
						LEFT JOIN cane_party ON cane_party.party_id=cane_sales.party_id
						
					) e ON e.invoice_number=cane_sales_return.against_sales_invoice
					WHERE sales_return_id='$id'
					
		");

		if($getData->num_rows() > 0)
		return $getData->result_array();
		else
		return null;

	
}

function sales_return_printing2($id){
	
		$getData = $this->db->query("
		
			SELECT brand_name,category_name,product_item,return_unit_price,return_quantity	
				FROM
				(
					SELECT * FROM  cane_sales_return_details
					
				) as j
				
				LEFT JOIN (
					SELECT product_id,brand_name,category_name,product_item FROM cane_products
					LEFT JOIN cane_category ON cane_category.category_id=cane_products.category_id 
					LEFT JOIN cane_brand ON cane_brand.brand_id=cane_products.brand_id
				) e ON e.product_id=j.return_product_id
		
			WHERE j.sales_return_id='$id'
					
		");

		if($getData->num_rows() > 0)
		return $getData->result_array();
		else
		return null;
	
	
}

//------ Helper-------------------

function check_sales_voucher(){
	
		$sales_invoice=$this->input->post('sales_invoice');
		
		$query = $this->db->query("SELECT id FROM cane_sales WHERE invoice_number='$sales_invoice'");
                                  
		if ($query->num_rows() > 0){ return true;} else { echo false; }
  	 
}



}