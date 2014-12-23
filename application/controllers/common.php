<?php
class Common extends CI_Controller{

	function __construct()
	{
		parent::__construct();

		include 'parent_construct.php';

	}
	
	function get_party(){

		$this->load->model('mod_common');
		$data = $this->mod_common->get_party();
		echo json_encode($data);
	}
	


	function check_party_validity()
	{
			
		$this->load->model('mod_common');
		$value= $this->mod_common->check_if_party_exists();
			
		if ($value)
		{
			echo "true";
		}
		else
		{
			echo "false";
		}
			
	}


	function get_brands_custom()
	{

		$category_id = $this->input->post('category_id');
		$this->load->model('dropdown_items');
		$output= $this->dropdown_items->get_brands_custom($category_id);
		echo $output;
	}

	function get_products_custom()
	{

		$category_id = $this->input->post('category_id');
		$brand_id = $this->input->post('brand_id');

		$this->load->model('dropdown_items');
		$output= $this->dropdown_items->get_products_custom($category_id,$brand_id);

		echo $output;
	}
	
}