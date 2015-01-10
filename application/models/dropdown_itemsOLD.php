<?php
class Dropdown_items extends CI_Model{
	

function category_names() {
		        
	    
	$this->db->select('*');
	$records=$this->db->get('cane_category');
		        
	$data=array();
	$data[''] = 'Select Category';
	      
	foreach ($records->result() as $row){

	 	 $data[$row->category_id] = $row->category_name;
					   
	}			

	return ($data);     
		       
} 
 	     

function brands() {
		        

	$this->db->select('brand_id, brand_name');
	$records=$this->db->get('cane_brand');

	$data=array();
	$data[''] = 'Select Brand'; 
	foreach ($records->result() as $row){
					
	  $data[$row->brand_id] = $row->brand_name;
	}
	return ($data);	        
		        
} 
 	
 
function parties() {
			      
	$this->db->select('party_id, party_name');
	$this->db->order_by('party_name','ASC');
	$records=$this->db->get('cane_party');
		        
	$data=array();
	$data[''] = 'Select';
		        	
	foreach ($records->result() as $row){
					
	   $data[$row->party_id] = $row->party_name ;
	}
					  
	return ($data);

} 

function software_users() {
			      
	$this->db->select('admin_id, admin_name');
	$this->db->order_by('admin_name','ASC');
	$records=$this->db->get('cane_admin');
		        
	$data=array();
	$data[''] = 'Select';
	$data['all'] = 'Show Me Overall';	        	
	foreach ($records->result() as $row){
					
	   $data[$row->admin_id] = $row->admin_name ;
	}
					  
	return ($data);

} 
		    

function enter_serial_category() {
	
	$this->db->select('cane_category.category_name,cane_category.category_id');
	$this->db->from('cane_category');
	$this->db->join('cane_products', 'cane_products.category_id = cane_category.category_id');
	
	$this->db->where('cane_products.warranty_product','1'); // 1 means it is a warranty product
	 
	$records = $this->db->get('');
	
	$data=array();
	$data[''] = 'Select';
	      
	foreach ($records->result() as $row){

	 	 $data[$row->category_id] = $row->category_name;
					   
	}			

	return ($data);     
		       
	
	
} 


function get_serial_brands($category_id){
	
	$this->db->select('cane_brand.brand_name,cane_brand.brand_id');
	$this->db->from('cane_brand');
	$this->db->join('cane_products', 'cane_products.brand_id = cane_brand.brand_id');
	$this->db->where('cane_products.category_id',$category_id);
	$this->db->where('cane_products.warranty_product','1'); // 1 means it is a warranty product
	$this->db->group_by('cane_brand.brand_id'); 
	$records = $this->db->get('');
  
  	$output = null;
  	 $output .= "<option value=''>Select</option>";	 
   	foreach ($records->result() as $row)
    {
   	
      $output .= "<option value='".$row->brand_id."'>".$row->brand_name."</option>";
    }
		
    return $output;
	
}

function get_serial_products($category_id,$brand_id) {
	
	$this->db->select('product_id,product_item');
	$this->db->from('cane_products');
	$this->db->where('category_id',$category_id);
	$this->db->where('brand_id',$brand_id);
	$this->db->where('warranty_product','1'); // 1 means it is a warranty product
	$this->db->order_by('product_item','ASC'); 
	$records = $this->db->get('');
  
  	$output = null;
  	 $output .= "<option value=''>Select</option>";	 
   	foreach ($records->result() as $row)
    {
   	
      $output .= "<option value='".$row->product_id."'>".$row->product_item."</option>";
    }
		
    return $output;
		
		       
	
	
} 


function non_serial_category() {
	
	$this->db->select('cane_category.category_name,cane_category.category_id');
	$this->db->from('cane_category');
	$this->db->join('cane_products', 'cane_products.category_id = cane_category.category_id');
	
	$this->db->where('cane_products.warranty_product','2'); // 2 means it is a non warranty product
	 
	$records = $this->db->get('');
	
	$data=array();
	$data[''] = 'Select';
	      
	foreach ($records->result() as $row){

	 	 $data[$row->category_id] = $row->category_name;
					   
	}			

	return ($data);     
		       
	
	
} 

function non_serial_brands($category_id) {
	
	$this->db->select('cane_brand.brand_name,cane_brand.brand_id');
	$this->db->from('cane_brand');
	$this->db->join('cane_products', 'cane_products.brand_id = cane_brand.brand_id');
	$this->db->where('cane_products.category_id',$category_id);
	$this->db->where('cane_products.warranty_product','2'); // 2 means it is a non warranty product
	$this->db->group_by('cane_brand.brand_id'); 
	$records = $this->db->get('');
  
  	$output = null;
  	 $output .= "<option value=''>Select</option>";	 
   	foreach ($records->result() as $row)
    {
   	
      $output .= "<option value='".$row->brand_id."'>".$row->brand_name."</option>";
    }
		
    return $output;
		       
	
	
} 

function non_serial_products($category_id,$brand_id) {
	
	$this->db->select('product_id,product_item');
	$this->db->from('cane_products');
	$this->db->where('category_id',$category_id);
	$this->db->where('brand_id',$brand_id);
	$this->db->where('warranty_product','2'); // 2 means it is a non warranty product
	$this->db->order_by('product_item','ASC'); 
	$records = $this->db->get('');
  
  	$output = null;
  	 $output .= "<option value=''>Select</option>";	 
   	foreach ($records->result() as $row)
    {
   	
      $output .= "<option value='".$row->product_id."'>".$row->product_item."</option>";
    }
		
    return $output;
		
		       
	
	
} 

 

function get_brands_custom($category_id){
		
	$this->db->select('cane_brand.brand_name,cane_brand.brand_id');
	$this->db->from('cane_brand');
	$this->db->join('cane_products', 'cane_products.brand_id = cane_brand.brand_id');
	$this->db->where('cane_products.category_id',$category_id);
	$this->db->group_by('cane_brand.brand_id'); 
	$records = $this->db->get('');
  
  	$output = null;
  	 $output .= "<option value=''>Select</option>";	 
   	foreach ($records->result() as $row)
    {
   	
      $output .= "<option value='".$row->brand_id."'>".$row->brand_name."</option>";
    }
		
    return $output;
		
	}	    

function get_products_custom($category_id,$brand_id){
		
	$this->db->select('product_id,product_item');
	$this->db->from('cane_products');
	$this->db->where('category_id',$category_id);
	$this->db->where('brand_id',$brand_id);
	$this->db->order_by('product_item','ASC'); 
	$records = $this->db->get('');
  
  	$output = null;
  	 $output .= "<option value=''>Select</option>";	 
   	foreach ($records->result() as $row)
    {
   	
      $output .= "<option value='".$row->product_id."'>".$row->product_item."</option>";
    }
		
    return $output;
		
	}	
	


function auto_suggest_party(){
				
	$query = $this->db->query('SELECT party_id, party_name FROM cane_party where party_name like "'. mysql_real_escape_string($_REQUEST['term']) .'%" order by party_name asc ');

			$data = array();						
			foreach ($query->result_array() as $row)
			{	
			 $data[] = array(	
			      'label' => $row['party_name'] ,
			   'value' => $row['party_id']
			 ); 
			}
			
		return $data;	
}//ends
	
		
	function party_acc(){

	$records= $this->db->query("SELECT id,account_name FROM cane_accounts WHERE acc_type='3' order by account_name");
	        
	 		        
	  $data=array();
		     	$data[''] = 'Select'; 
							foreach ($records->result() as $row)
					{
					    $data[$row->id] = $row->account_name;
					}
		        
		        return ($data);
		
	}	    
	
		
		    
	// Bank and Cash accounts that are used for payment 
	function cash_bank_accounts(){

	$records= $this->db->query("SELECT id,account_name FROM cane_accounts WHERE acc_type='1' OR acc_type='2' ");
	        
	 		        
	  $data=array();
		     	$data[''] = 'Select'; 
							foreach ($records->result() as $row)
					{
					    $data[$row->id] = $row->account_name;
					}
		        
		        return ($data);
		
	}

	// Bank and Cash accounts that are used for recieve  
	function cash_bank__cheque_accounts(){

	$records= $this->db->query("SELECT id,account_name FROM cane_accounts WHERE acc_type='1' OR acc_type='2' OR acc_type='5'");
	        
	 		        
	  $data=array();
		     	$data[''] = 'Select'; 
							foreach ($records->result() as $row)
					{
					    $data[$row->id] = $row->account_name;
					}
		        
		        return ($data);
		
	}
	
	// Bank and Cash accounts that are used for recieve  
	function fund_transfer_accounts(){

	$records= $this->db->query("SELECT id,account_name FROM cane_accounts WHERE acc_type='1' OR acc_type='2' OR acc_type='5' OR id='7' ORDER BY account_name ");
	        
	 		        
	  $data=array();
		     	$data[''] = 'Select'; 
							foreach ($records->result() as $row)
					{
					    $data[$row->id] = $row->account_name;
					}
		        
		        return ($data);
		
	}
	
	    
	
	function getall_accounts(){

	$records= $this->db->query("SELECT id,account_name FROM cane_accounts order by account_name");
	        
	 		        
	  $data=array();
		     	$data[''] = 'Select'; 
							foreach ($records->result() as $row)
					{
					    $data[$row->id] = $row->account_name;
					}
		        
		        return ($data);
		
	}
	
	
	function get_expense_accounts(){

	$records= $this->db->query("SELECT id,account_name FROM cane_accounts WHERE acc_type='7' order by account_name");
	        
	 		        
	  $data=array();
		     	$data[''] = 'Select'; 
							foreach ($records->result() as $row)
					{
					    $data[$row->id] = $row->account_name;
					}
		        
		        return ($data);
		
	}
	

	function get_accounts_print(){
		
		$records= $this->db->query("SELECT id,account_name FROM cane_accounts WHERE acc_type='1' OR acc_type='3'  order by account_name");
	        
	 		        
	  $data=array();
		     	$data[''] = 'Select'; 
							foreach ($records->result() as $row)
					{
					    $data[$row->id] = $row->account_name;
					}
		        
		        return ($data);
		
	}
		    
}