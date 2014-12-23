<?php
class Purchase extends CI_Controller

{
	function __construct()
	{
		parent::__construct();
		include 'parent_construct.php';

	}

	// -------------------------------------------------- Purchase ----------------------------------------------- //
	function test()
	{
		$obj = new Mod_purchase();
	}
	function add()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->load->model('mod_purchase');
			$output = $this->mod_purchase->add();
			if ($output)
			{
				$this->session->set_flashdata('item', 'Purchase Complete');
			}
		
			redirect('purchase/add');
		}
		else
		{
			$this->session->unset_userdata('cart');
			$this->load->model('dropdown_items');
			$data['dropdown_category'] = $this->dropdown_items->category_names();
			$data['page_title'] = 'Add Purchase';
			$data['main_content'] = 'purchase/view_add';
			$this->load->view('includes/template', $data);
		}
	}

	function add_to_cart()
	{
		$product_id = trim($this->input->post('product_id'));
		$quantity = trim($this->input->post('quantity'));
		$price = trim($this->input->post('price'));
		$this->load->library('purchase_lib');
		$this->purchase_lib->add_item($product_id, $quantity, $price);
		$data['cart'] = $this->purchase_lib->get_cart();	
		$this->load->view('purchase/purchase_helper', $data);
	}

	function edit_cart_items()
	{
		$product_id = trim($this->input->post('product_id'));
		$quantity = trim($this->input->post('quantity'));
		$price = trim($this->input->post('price'));
		$this->load->library('purchase_lib');
		$this->purchase_lib->edit_item($product_id, $quantity, $price);
	}

	function delete_cart_item()
	{
		$product_id = trim($this->input->post('id'));
		$this->load->library('purchase_lib');
		$this->purchase_lib->delete_item($product_id);
		$data['cart'] = $this->purchase_lib->get_cart();
		$this->load->view('purchase/purchase_helper', $data);
	}

	function show()
	{
		$this->load->model('dropdown_items');
		$data['dropdown_parties'] = $this->dropdown_items->parties();
		$data['page_title'] = 'Purchase History';
		$data['main_content'] = 'purchase/view_purchase_date';
		$this->load->view('includes/template', $data);
	}

	function history()
	{
		$daterange1 = $this->input->post('daterange1');
		$daterange2 = $this->input->post('daterange2');
		$party_id = $this->input->post('party_id');
		if (strlen($daterange1) > 0)
		{
			$this->session->set_userdata('daterange1', $daterange1);
			$this->session->set_userdata('daterange2', $daterange2);
			$this->session->set_userdata('party_id', $party_id);
		}

		$daterange1 = $this->session->userdata('daterange1');
		$daterange2 = $this->session->userdata('daterange2');
		$party_id = $this->session->userdata('party_id');
		$this->load->model('mod_purchase');
		$data['records'] = $this->mod_purchase->purchase_list($daterange1, $daterange2, $party_id);
		$data['page_title'] = 'Purchase History';
		$data['main_content'] = 'purchase/view_show_purchase';
		$this->load->view('includes/template', $data);
	}

	function purchase_details($id = NULL)
	{
		if (($this->authex->get_user_level() > 1))
		{
			redirect("error/");
		}
		else
		{
			$this->load->model('mod_purchase');
			$data['records'] = $this->mod_purchase->get_purchase_details($id);
			$data['page_title'] = 'Purchase Details';
			$data['main_content'] = 'purchase/view_purchase_details';
			$this->load->view('includes/template', $data);
		}
	}

	// -------------------------------------------------- End of Purchase ----------------------------------------------- //
	// -------------------------------------------------- Purchase Return ---------------------------------- //

	function purchase_return()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->load->model('mod_purchase');
			$output = $this->mod_purchase->purchase_return();
			if ($output)
			{
				$this->session->set_flashdata('item', 'Purchase Return Complete');
			}

			redirect('purchase/purchase-return');
		}
		else
		{
			$this->session->unset_userdata('cart');
			$this->load->model('dropdown_items');
			$data['dropdown_category'] = $this->dropdown_items->category_names();
			$data['page_title'] = 'Purchase Return';
			$data['main_content'] = 'purchase/view_return';
			$this->load->view('includes/template', $data);
		}
	}

	function purchase_return_show()
	{
		$this->load->model('dropdown_items');
		$data['dropdown_parties'] = $this->dropdown_items->parties();
		$data['page_title'] = 'Purchase Return History - Select Date Range';
		$data['main_content'] = 'purchase/view_return_date';
		$this->load->view('includes/template', $data);
	}

	function return_history()
	{
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{		
			$daterange1 = $this->input->post('daterange1');
			$daterange2 = $this->input->post('daterange2');
			$party_id = $this->input->post('party_id');
	
			$this->load->model('mod_purchase');
			$data['records'] = $this->mod_purchase->purchase_return_list($daterange1, $daterange2, $party_id);
			$data['page_title'] = 'Purchase Return History';
			$data['main_content'] = 'purchase/view_show_return';
			$this->load->view('includes/template', $data);		
		}
		else
		{
			redirect("purchase/show-return");
		}	
	}

	function purchase_return_details($id = NULL)
	{
		$this->load->model('mod_purchase');
		$data['records'] = $this->mod_purchase->get_purchase_return_details($id);
		$data['page_title'] = 'Purchase Return Details';
		$data['main_content'] = 'purchase/view_return_details';
		$this->load->view('includes/template', $data);
	}

	// -------------------------------------------------- End of Purchase Return ---------------------------------- //

}
