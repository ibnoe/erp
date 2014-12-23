<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/menu'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<h3 class="pageTitle"><?php echo $page_title ; ?></h3>
		<hr>
		<?php $this->load->view($main_content); ?>
	</div>	
</div>	
</div>
<?php $this->load->view('includes/footer'); ?>