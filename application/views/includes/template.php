<?php $this->load->view('includes/head.php'); ?>
<?php $this->load->view('includes/left_menu'); ?>

<div class="drawer-overlay">

<?php $this->load->view('includes/top_menu'); ?>

<div class="container-fluid" style="margin-left:2%; margin-right:2%;">
	<div class="row-fluid">
		
		<h3 class="pageTitle"><?php echo $page_title ; ?></h3>
		<hr>
		<?php $this->load->view($main_content); ?>
	
</div>	
</div>
</div>
