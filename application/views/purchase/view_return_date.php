<div class="col-md-6" >

<form role="form" id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url();?>purchase/return-history" method="post" autocomplete="off" >
	
	<div class="form-group">
     <label class="col-md-3 control-label">Party</label>
       <div class="col-md-6">
            <?php  $dropdown_parties['all']='All'; ?>	
   			<?php echo form_dropdown('party_id', $dropdown_parties, '','class="form-control" id="party_id" ');?>
       </div>
     </div>
     


     <div class="form-group">
     <label class="col-md-3 control-label">From</label>
       <div class="col-md-6">
            <input type="text" name="daterange1" class="form-control" id="datepicker1" placeholder="" value="">
       </div>
     </div>
     
      <div class="form-group">
     <label class="col-md-3 control-label">To</label>
       <div class="col-md-6">
            <input type="text" name="daterange2" class="form-control" id="datepicker2" placeholder="" value="">
       </div>
     </div>

     <div class="form-group">
	    <div class="col-sm-offset-3 col-sm-10">
	      <button type="submit" class="btn btn-primary">Submit</button>
	    </div>
  	</div>
  
  
</form>

</div>


<div class="span-6">
		 <span class="result" style="font-size:14px;color:green;"></span>
         <span class="errormsg2" style="font-size:14px;color:red;"></span>
	
	 </div>	
	 
<script>
$(function() {
    // validate signup form on keyup and submit
    var validator = $("#myForm").validate({
        showErrors: function(errorMap, errorList) {
            $(".errormsg2").html($.map(errorList, function (el) {
                return el.message;
            }).join(", "));
        },
        wrapper: "span",
        rules: {
        	daterange1: "required",
        	daterange2: "required",
        	party_id: "required",
            
        },
        messages: {
        	daterange1: "Select from date",
        	daterange2: "Select to date",
        	party_id: "Select A Party",
            
            
        }
    });
});

</script>			 
	 

