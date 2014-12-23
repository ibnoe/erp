<div class="container-fluid">
  <div class="row-fluid">
   <div class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
            
            <a class="navbar-brand" id="toogle-menu" href="#" data-status='close'>&#9776;</a>


         <!-- Brand and toggle get grouped for better mobile display -->
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
             <a class="navbar-brand" href="#">MicroElephant ERP</a>
         </div>
         <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
            <li class="menu-item menu-head"><a href="<?php echo base_url()?>">Dashboard</a></li>
               <!-- Admin  -->
               <li class="menu-item dropdown menu-head">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Group</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>group/add">Add Group</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>group/show">Group List</a></li>
                        </ul>
                     </li>
                     
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ledger</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>head/add">Add Ledger</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>head/show">Chart of Account</a></li>
                        </ul>
                     </li> 
                    
                      
                  </ul>
               </li>
               <!-- End of Admin  -->
               
                    <!-- Entry  -->
               <li class="menu-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Entries<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                  
                    <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sales</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>sales/add">Sales</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>sales/show">Sales History</a></li>
                           
                        </ul>
                     </li>
                     
                      <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Purchase</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>purchase/add">Purchase</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>purchase/show">Purchase History</a></li>
                           
                        </ul>
                     </li>
                  
                   
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Payment</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>payment/regular">Cash & Bank Deposit</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>payment/cheque">Cheque Payment</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>payment/show">Payment History</a></li>
                        </ul>
                     </li>
                     
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Receive</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>receive/regular">Regular Receive</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>receive/cheque">Cheque Receive</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>receive/show">Receive History</a></li>
                        </ul>
                     </li> 
                                                     
                     
                      <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Journal</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>journal/add">Add Journal</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>journal/show">Journal History</a></li>
                        </ul>
                     </li> 
                    
                     
                  </ul>
               </li>
               <!-- End of Entry  -->            
               
               <!-- Exam  -->
               <li class="menu-item dropdown">
               
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                
                 <li class="menu-item "><a href="<?php echo base_url()?>ledger">General Ledger</a></li>
                 <li class="menu-item "><a href="<?php echo base_url()?>ledger">Trial Balance</a></li>
                 <li class="menu-item "><a href="<?php echo base_url()?>incomestatement">Financial Statement</a></li>
                 <li class="menu-item "><a href="<?php echo base_url()?>balancesheet">Financial Position</a></li>
                 
                  </ul>
               </li>
               <!-- End of Exam  -->
               
               <!-- Attendance  -->
               <li class="menu-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <b class="caret"></b></a>
                  <ul class="dropdown-menu">                     
                     <li class="menu-item "><a href="<?php echo base_url();?>home/logout">Logout</a></li>
                    
                  </ul>
               </li>
               <!-- End of Attendance  -->
               
            </ul>


         </div>
      </div>
   </div>
</div>



</div>



<!-- CONTENTS END HERE -->

