<div class="row">
   <div class="navbar navbar-default" role="navigation">
      <div class="container">
         <!-- Brand and toggle get grouped for better mobile display -->
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
         </div>
         <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
               <!-- Admin  -->
               <li class="menu-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url();?>category/add">Add Category</a></li>
                           <li class="menu-item "><a href="<?php echo base_url();?>category/show">Category List</a></li>
                        </ul>
                     </li>
                     
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Brand</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>brand/add">Add Brand</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>brand/show">Brand List</a></li>
                        </ul>
                     </li>
                     
                     
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Product</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>product/add">Add Product</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>product/show">Product List</a></li>
                        </ul>
                     </li>
                     
                    
                     
                  </ul>
               </li>
               <!-- End of Admin  -->
               <!-- Purchase  -->
               <li class="menu-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Purchase <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                  
                   <li class="menu-item "><a href="<?php echo base_url();?>purchase/add">Purchase</a></li>
                   <li class="menu-item "><a href="<?php echo base_url();?>purchase/show">Purchase History</a></li>
                   <li class="menu-item "><a href="<?php echo base_url();?>purchase/return">Return</a></li>
                  <li class="menu-item "><a href="<?php echo base_url();?>purchase/show-return">Return History</a></li>
                  
                  <li style="width: 100%; border:1px #E7E7E7 solid; margin-top:2%; margin-bottom:2%;"></li>
                  
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Product Serial</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item"><a href="<?php echo base_url()?>serial/using-excel-file">Batch Entry</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>serial/using-form-element">Single Entry</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>serial/select-product">Serial List</a></li>
                          
                        </ul>
                     </li>
                     
                    
               
                  </ul>
               </li>
               <!-- End of Purchase  -->
               <!-- Sales  -->
               <li class="menu-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sale <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                
                 <li class="menu-item "><a href="<?php echo base_url()?>sales/cash">Cash Sale</a></li>
                 <li class="menu-item "><a href="<?php echo base_url()?>sales/party">Party Sale</a></li>
                 
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">See Result</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url();?>result/single_term">Term Result</a></li>
                            <li class="menu-item "><a href="<?php echo base_url();?>result/all_terms">Final Result</a></li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <!-- End of Sales  -->
               <!-- Attendance  -->
               <li class="menu-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Attendance <b class="caret"></b></a>
                  <ul class="dropdown-menu">                     
                     <li class="menu-item "><a href="<?php echo base_url();?>attendance/student">Student Attendance</a></li>
                    
                  </ul>
               </li>
               <!-- End of Attendance  -->
               <!-- Accounts  -->
               <li class="menu-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Accounts <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Fee</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="#">Add Student</a></li>
                           <li class="menu-item "><a href="#">Student List</a></li>
                           <li class="menu-item "><a href="#">Promote Student</a></li>
                        </ul>
                     </li>
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Office Expense</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="#">Add Teacher</a></li>
                           <li class="menu-item "><a href="#">Teacher List</a></li>
                        </ul>
                     </li>
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bank Transaction</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="#">Add Teacher</a></li>
                           <li class="menu-item "><a href="#">Teacher List</a></li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <!-- End of Accounts  -->
               <!-- Portal  -->
               <li class="menu-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portal<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Online Admission</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="#">Add Student</a></li>
                           <li class="menu-item "><a href="#">Student List</a></li>
                           <li class="menu-item "><a href="#">Promote Student</a></li>
                        </ul>
                     </li>
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Notice Board</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="#">Add Teacher</a></li>
                           <li class="menu-item "><a href="#">Teacher List</a></li>
                        </ul>
                     </li>
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contact Form</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="#">Add Teacher</a></li>
                           <li class="menu-item "><a href="#">Teacher List</a></li>
                        </ul>
                     </li>
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">About Page</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="#">Add Teacher</a></li>
                           <li class="menu-item "><a href="#">Teacher List</a></li>
                        </ul>
                     </li>
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reunion</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="#">Add Teacher</a></li>
                           <li class="menu-item "><a href="#">Teacher List</a></li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <!-- End of Portal -->
               <!-- SMS  -->
               <li class="menu-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">SMS <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contact Group</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="#">Add Attendance</a></li>
                        </ul>
                     </li>
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contact</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="#">Add Attendance</a></li>
                        </ul>
                     </li>
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Send SMS</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="#">Add Attendance</a></li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <!-- End of Attendance  -->
            </ul>
         </div>
      </div>
   </div>
</div>