@if (session('status'))
	<div class="growl">
	  <div class="alert alert-success alert-dismissable" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	      <span aria-hidden="true">×</span>
	    </button>
	    {{ session('status') }}
	  </div>
	</div>
@endif