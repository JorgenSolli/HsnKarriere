@if (session('status'))
	<div id="seAttester" class="modal fade activ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span> Takk for at du registrerte deg!</h4>
	      </div>
	      <div class="modal-body">
	        
	      </div>
	      <div class="modal-footer">
	        <button type="reset" class="btn btn-default" data-dismiss="modal" aria-label="close">Lukk</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="growl">
  <div class="alert alert-success alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <strong>Takk for at du registrerte deg!</strong> {{ session('status') }}
  </div>
</div>
@endif