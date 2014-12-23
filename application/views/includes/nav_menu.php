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
            <ul class="nav navbar-nav" style="margin-left:10%;">
               <!-- Admin  -->
               <li class="menu-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Class</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>grade/add">Add Class</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>grade/show">Class List</a></li>
                        </ul>
                     </li>
                     
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Section</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>section/add">Add Section</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>section/show">Section List</a></li>
                        </ul>
                     </li>
                     
                     
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Shift</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>shift/add">Add Shift</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>shift/show">Shift List</a></li>
                        </ul>
                     </li>
                     
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Group</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>group/add">Add Group</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>group/show">Group List</a></li>
                        </ul>
                     </li>
                     
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Batch</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>batch/add">Add Batch</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>batch/show">Batch List</a></li>
                        </ul>
                     </li>
                     
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Subject</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>parentsubject/add">Parent Subject</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>parentsubject/show">Parent Subject List</a></li>                        
                           <li class="menu-item "><a href="<?php echo base_url()?>subject/add">Add Subject</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>subject/show">Subject List</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>subject/sort">Sort Subject</a></li>
                        </ul>
                     </li>
                     
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Term</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>term/add">Add Term</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>term/show">Terms List</a></li>
                        </ul>
                     </li>
                     
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Grading Rule</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url()?>gradesystem/add">Add Rule</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>gradesystem/show">Grade Rules</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>gradesystem/final_result_rule">Final Result Rules</a></li>
                           
                        </ul>
                     </li>
                     
                     
                     
                     
                      <li class="menu-item "><a href="<?php echo base_url()?>information/update">School Information</a></li>        
                     
                     
                     
                  </ul>
               </li>
               <!-- End of Admin  -->
               <!-- Manage  -->
               <li class="menu-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Student</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item"><a href="<?php echo base_url()?>student/add">Add Student</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>student/show">Student List</a></li>
                           <li class="menu-item "><a href="<?php echo base_url()?>assign/subject">Assign Subject</a></li>
                           <li class="menu-item "><a href="#">Promote Student</a></li>
                        </ul>
                     </li>
                     
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Teacher</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="#">Add Teacher</a></li>
                           <li class="menu-item "><a href="#">Teacher List</a></li>
                        </ul>
                     </li>
               
               
                  </ul>
               </li>
               <!-- End of Manage  -->
               <!-- Exam  -->
               <li class="menu-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Exam <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                
                 <li class="menu-item "><a href="<?php echo base_url()?>mark/add">Enter Marks</a></li>
                  <li class="menu-item "><a href="<?php echo base_url()?>result/final_result_calculation">Generate Final Result</a></li>
                 
                     <li class="menu-item dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">See Result</a>
                        <ul class="dropdown-menu">
                           <li class="menu-item "><a href="<?php echo base_url();?>result/single_term">Term Result</a></li>
                            <li class="menu-item "><a href="<?php echo base_url();?>result/all_terms">Final Result</a></li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <!-- End of Exam  -->
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