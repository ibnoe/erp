<!-- Delete Confirm Dialog -->
<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delete Parmanently</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure about this ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirm">Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Delete Confirm Dialog -->

<!-- Error Dialog -->
<div class="modal fade" id="prb_delete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delete Status</h4>
      </div>
      <div class="modal-body">
        <p id="modal_body"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Error Dialog -->


<!-- Dialog show event handler -->
<script type="text/javascript">

  $('#confirmDelete').on('show.bs.modal', function (e) {
    $message = $(e.relatedTarget).attr('data-message');
    $(this).find('.modal-body p').text($message);
    $title = $(e.relatedTarget).attr('data-title');
    $(this).find('.modal-title').text($title);
  })

  <!-- Pass form reference to modal for submission on yes/ok -->
  $('#confirmDelete').on('show.bs.modal', function (e) {
      var id = $(e.relatedTarget).data("id");
      $('#url_id').html(id);
         
     
  });

  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
      
	  	$('#confirmDelete').modal('hide');
	  	
	  	var a_href = $('#url_id').html();
	  	var url_address = $('#url_address').html();	  
	  	var csrf_hash = $('#csrf_hash').html();
	  	
	  	$.ajax({
   	        
		     type: "POST",
		     url:  url_address,
		     data: {id : a_href, ci_csrf_token: csrf_hash},
		     success: function(server_response)
		     {
			     	if(server_response == '1')
				     {
				     	location.reload();
				     } 
			     	else
				     {	
			     		$('#modal_body').html(server_response);
			     		$('#prb_delete').modal('show')	
					     
					 }
		     }										   
		 });	//$.ajax ends here


	  	
  });
</script>
