<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
   
 include_once(APPPATH.'/third_party/excel/PHPExcel.php');
 include_once(APPPATH.'/third_party/excel/PHPExcel/IOFactory.php');

class Excel extends PHPExcel { 

 public function __construct() { 
        parent::__construct(); 
		
		
    } 
  
}