<?php
class Pdf extends CI_Controller{

function __construct()
    {
        parent::__construct();
        
       include 'parent_construct.php';
        
    }
    
	function ledger_date(){
    	
    $data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	$this->load->model('dropdown_items');
	$data['getall_accounts']= $this->dropdown_items->getall_accounts();
	
	$this->load->view('report/print_ledger_date',$data);	
    	
    }
    
    function party_ledger_date(){

    $data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;	
    	
    $this->load->model('dropdown_items');
	$data['party_acc']= $this->dropdown_items->party_acc();
	
	$this->load->view('report/print_party_ledger_date',$data);	
    	
    }
    
    
    function print_ledger(){
    	
    	
	$daterange1=$this->input->post('daterange1');
    $daterange2=$this->input->post('daterange2');
	$account_id=$this->input->post('account_id');
    	
    if(empty($daterange1)) {
    	
    	redirect('pdf/ledger_date');
    }	else {

	$daterange1=date("Y-m-d", strtotime($daterange1));
    $daterange2=date("Y-m-d", strtotime($daterange2));	
		

    $data['user_name']=$this->authex->get_user_name();
	$user_info = $this->authex->get_userdata();
	$data['level']=$user_info->level;
	
	
	$this->load->model('mod_report');
	$data['records']= $this->mod_report->ledger($daterange1,$daterange2,$account_id);
	
	$this->load->model('mod_report');
	$info= $this->mod_report->ledger_begining_bal($daterange1,$daterange2,$account_id);
	$data['op_balance']= $info['op_balance']; 
	$data['account_name']= $info['account_name'];

	$data['daterange1']=date("d-m-Y", strtotime($daterange1));
	$data['daterange2']=date("d-m-Y", strtotime($daterange2));
	
    include_once('dompdf/dompdf_config.inc.php');
	$html= $this->load->view('print/print_ledger',$data,true);
	
	$dompdf = new DOMPDF();
	$base_path = $_SERVER['DOCUMENT_ROOT'];
	$dompdf->load_html($html);
	
	$file_name="Ledger_".$info['account_name'];
	
	$dompdf->render();
	$dompdf->stream("$file_name.pdf", array("Attachment" => 0));
	
    }
    
    
    }
    
}   