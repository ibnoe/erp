<?php
class Mod_purchase extends CI_Model {

	
	function add() 
	{
		
		$user_id = $this->authex->get_user_id();		
		$purchase_date = date("Y-m-d", strtotime(trim($this->input->post('purchase_date'))));
		$party = trim($this->input->post('party_id'));
		$party_invoice=trim($this->input->post('party_invoice'));
		$total_amount=str_replace(',', '', trim($this->input->post('total_amount')));
		$product_id=($_POST['product_id']);
		$rate=($_POST['rate']);
		$quantity=($_POST['quantity']);

		$year = date("Y");
		$invoiceid = $this->gen_invoice_number();
		$invoice_number = sprintf("%06s", $invoiceid) ;

		$current_invoice = 'PUR-PC-'.$year.'-'.$invoice_number;
		
		//Starting Transaction
		$this->db->trans_start();
		
		
		// Enter into cane_purchase
		$data = array(
						'purchase_id' => '',
						'purchase_voucher' =>$current_invoice,
						'num' => $invoiceid,
						'party_id' => $party,
						'party_invoice' => $party_invoice,
						'purchase_total' => $total_amount, 
						'purchase_date' => $purchase_date,
						'entry_by' => $user_id,

		);
		$this->db->insert('cane_purchase', $data);
			
		$autovalue= $this->db->insert_id();

		// Enter into cane_purchase_details
		for($i = 0; $i < count($product_id); $i++){

			$data = array(
				 		 'p_details_id'=>'',             
						 'purchase_id'=>$autovalue,
				 	     'p_product_id'=>$product_id[$i],
						 'p_unit_price'=>str_replace(',', '', trim($rate[$i])),
				 	     'p_quantity'=>$quantity[$i], 
			);
				
				
			$query=$this->db->insert('cane_purchase_details', $data);
			
				
			 $sql = "SELECT TRUNCATE(ifnull(buy_price*in_stock,0),2) AS COGS,in_stock FROM  cane_products WHERE product_id  = ?" ;
			 $query = $this->db->query($sql,array( $product_id[$i]  ));
			

			foreach ($query->result() as $row)
			{
				$cogs= $row->COGS;
				$in_stock= $row->in_stock;
			}

			$new_cogs=$cogs+(str_replace(',', '', trim($rate[$i]))*$quantity[$i]);
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


		}// end for loop


		// Make the journal Entry for increasing the inventory due to purchase
		
		$sql = "SELECT id FROM cane_accounts WHERE parent_id = ? AND acc_type = ? " ;
	    $query = $this->db->query($sql,array( $party , '3'  ));		

		foreach ($query->result() as $row) 
		{

			$party_account = $row->id;
				
		}
			
		// Voucher Entry First
		$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>$current_invoice, // from above
				 		'narration' => 'Goods Purchased', 
						'trans_date' => $purchase_date, 
				 		'entry_by' => $user_id
		);
		$this->db->insert('cane_voucher', $data);
			
		$parent_voucher = $this->db->insert_id();

		$data = array(
					  	'id' => '',
			 		  	'amount' => $total_amount,
				 		'dr_side' => '3', // Purchase/ Marchendize Inventory 
						'cr_side' => $party_account, // Party
				 		'parent_voucher' => $parent_voucher 

		);
		$this->db->insert('cane_entries', $data);

		// Transaction Complete
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		    return FALSE;
		} 
		else 
		{
			return TRUE;
		}
	}

	function gen_invoice_number()
	{

		$year = date("Y");
		
		$sql = "SELECT max(num) AS MAXNUM FROM cane_purchase WHERE year(purchase_date)= ? " ;
	    $query = $this->db->query($sql,array( $year  ));			

		foreach ($query->result() as $row)
		{
			$value1= $row->MAXNUM;
	 	}

		 $strLen = strlen($value1);
		 $value  = (((int) $value1) + 1);
		 	
		 return	 str_pad($value, $strLen, '0', STR_PAD_LEFT);
	}


	function purchase_list($daterange1,$daterange2,$party_id) 
	{

		$daterange1=date("Y-m-d", strtotime($daterange1));
		$daterange2=date("Y-m-d", strtotime($daterange2));

		$this->db->select('*');
		$this->db->from('cane_purchase');
		$this->db->join('cane_admin', 'cane_admin.admin_id = cane_purchase.entry_by');
		$this->db->join('cane_party', 'cane_party.party_id = cane_purchase.party_id');
			
		if(!($party_id == 'all')){
			$this->db->where('cane_purchase.party_id', $party_id);
		}
		$this->db->where('purchase_date >=', $daterange1);
		$this->db->where('purchase_date <=', $daterange2);
		$this->db->order_by('purchase_date','DESC');
		$this->db->order_by('purchase_id','DESC');
		$getData = $this->db->get('');
		if($getData->num_rows() > 0)
		return $getData->result_array();
		else
		return null;
			
			
	}

	function get_purchase_details($id = NULL)
	{

		$sql = "SELECT 
				 p_product_id,brand_name,category_name,product_item,p_unit_price,p_quantity,purchase_id 
				 FROM cane_purchase_details					
				 LEFT JOIN (
					SELECT product_id,brand_name,category_name,product_item FROM cane_products
					LEFT JOIN cane_category ON cane_category.category_id=cane_products.category_id 
					LEFT JOIN cane_brand ON cane_brand.brand_id=cane_products.brand_id
				 ) e ON e.product_id=cane_purchase_details.p_product_id
				 WHERE purchase_id = ? ";		
	    $query = $this->db->query($sql,array($id));
		if($query->num_rows() > 0)
		return $query->result_array();
		else
		return null;
	}	


	function purchase_return(){
		
		$user_id = $this->authex->get_user_id();
		$return_date = date("Y-m-d", strtotime(trim($this->input->post('purchase_date'))));
		$party=trim($this->input->post('party_id'));
		$return_against_invoice = trim($this->input->post('party_invoice'));
		$total_amount = str_replace(',', '', trim($this->input->post('total_amount')));
		$product_id =$this->input->post('product_id');;
		$rate = $this->input->post('rate');
		$quantity = $this->input->post('quantity');

		// Enter into cane_purchase

		$data = array(
						'p_return_id' => '',
						'party_id' => $party,
						'return_against_invoice' =>$return_against_invoice,
						'return_total_amount' => $total_amount, 
						'return_date' => $return_date,
						'entry_by' => $user_id,

		);
		$this->db->insert('cane_purchase_return', $data);
			
		$autovalue= $this->db->insert_id();

		// Enter into cane_purchase_details

		for($i = 0; $i < count($product_id); $i++){

			$data = array(
		 		 'p_return_details_id'=>'',             
				 'p_return_id'=>$autovalue,
		 	     'return_product_id'=>$product_id[$i],
				 'return_unit_price'=>str_replace(',', '', trim($rate[$i])),
		 	     'return_quantity'=>$quantity[$i], 
			);
				
				
			$query=$this->db->insert('cane_purchase_return_details', $data);
				
			// Get the current Cost of goods available for sale and stock info
			$sql = "SELECT TRUNCATE(ifnull(buy_price*in_stock,0),2) AS COGS,in_stock FROM  cane_products WHERE product_id = ? ";
			$query = $this->db->query($sql,array( $product_id[$i]  ));							
						 
			foreach ($query->result() as $row)
			{
				$cogs= $row->COGS;
				$in_stock= $row->in_stock;
			}
			
			// Finding out the new Cost of goods available for sale and stock info	after purchase return

			$new_cogs=$cogs-(str_replace(',', '', trim($rate[$i]))*$quantity[$i]);
			$new_stock=$in_stock-$quantity[$i];

			$number=$new_cogs/$new_stock;
			$new_buy_price= number_format((float)$number, 2, '.', '');
				

			// Update Product Price and Quantity
			$data = array(
				'buy_price'=>$new_buy_price,
				'in_stock '=>$new_stock
				
			);				
			$this->db->where('product_id', $product_id[$i]);
			$this->db->update('cane_products', $data);


		}// end for loop


		// Make the journal Entry for deacresing in inventory due to purchase return

		$sql = "SELECT id FROM cane_accounts WHERE parent_id = ? AND acc_type = ? "; 
	
		$query = $this->db->query($sql,array( $party , 3 )); //3 means party
		
		foreach ($query->result() as $row) 
		{

			$party_account = $row->id;
				
		}
			
		// Voucher Entry First
		$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>'Journal', 
				 		'narration' => 'Returned Purchased Goods', 
						'trans_date' => $return_date, 
				 		'entry_by' => $user_id
		);
		$this->db->insert('cane_voucher', $data);
			
		$parent_voucher= $this->db->insert_id();

		$data = array(
					  	'id' => '',
			 		  	'amount' => $total_amount,
				 		'dr_side' => $party_account, // Party
						'cr_side' => '8', // Purchase Return  
				 		'parent_voucher' => $parent_voucher, 

		);
		$this->db->insert('cane_entries', $data);

		// Adjusting the balance between purchase return and purchase/marchendize inventory

		// Voucher Entry First
		$data = array(
					  	'voucher_id' => '',
			 		  	'voucher_number' =>'Journal', 
				 		'narration' => 'Transfered Balance To Purchase From Purchase Return', 
						'trans_date' => $return_date, 
				 		'entry_by' => $user_id
		);
		$this->db->insert('cane_voucher', $data);
			
		$parent= $this->db->insert_id();

		$data = array(
					  	'id' => '',
			 		  	'amount' => $total_amount,
				 		'dr_side' => '8', // Purchase Return  
						'cr_side' => '3', // Purchase/ marchendize inventory 
				 		'parent_voucher' => $parent,

		);
		$this->db->insert('cane_entries', $data);

		return 1;

	}

	function purchase_return_list($daterange1,$daterange2,$party_id) {

		$daterange1=date("Y-m-d", strtotime($daterange1));
		$daterange2=date("Y-m-d", strtotime($daterange2));

		$this->db->select('*');
		$this->db->from('cane_purchase_return');
		$this->db->join('cane_admin', 'cane_admin.admin_id = cane_purchase_return.entry_by');
		$this->db->join('cane_party', 'cane_party.party_id = cane_purchase_return.party_id');
			
		if(!($party_id == 'all')){
			$this->db->where('cane_purchase_return.party_id', $party_id);
		}
			
		$this->db->where('return_date >=', $daterange1);
		$this->db->where('return_date <=', $daterange2);
		$this->db->order_by('return_date','ASC');

		$getData = $this->db->get('');
		if($getData->num_rows() > 0)
		return $getData->result_array();
		else
		return null;
			
			
	}

	function get_purchase_return_details($id){

		$sql = "SELECT 
				brand_name,category_name,product_item,return_unit_price,return_quantity 
				FROM cane_purchase_return_details
					
				LEFT JOIN (
					SELECT product_id,brand_name,category_name,product_item,warranty_product FROM cane_products
					LEFT JOIN cane_category ON cane_category.category_id=cane_products.category_id 
					LEFT JOIN cane_brand ON cane_brand.brand_id=cane_products.brand_id
				) e ON e.product_id=cane_purchase_return_details.return_product_id
				WHERE p_return_id= ? ";		
		
		$query = $this->db->query($sql,array( $id )); 

		if($query->num_rows() > 0)
		return $query->result_array();
		else
		return null;

	}
	
	
	

}
