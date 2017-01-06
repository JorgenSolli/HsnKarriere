@extends('layout', ['avatar' => $brukerinfo->profilbilde])

@section('content')
<div class="container m-t">
  <div class="row">
    <div class="col-md-4">
  		<div class="panel panel-info">
				<div class="panel-heading p-t-0 p-b-0 clearfix">
					<h3 class="m-t-s pull-left">Meldinger</h3>
					<button type="button" class="pull-right btn btn-sm btn-default m-t-s"><span class="fa fa-plus-square-o"></span> Ny melding</button>
				</div>
		 		<ul class="list-group">
			    <a href="#" class="list-group-item active">
			    	<div class="row">
		    			<div class="col-sm-1">
					    	<span class="fa fa-envelope-open-o fa-lg p-t-s"></span>
		    			</div>
		    			<div class="col-sm-11">
		            <small class="pull-right">Sigurd, deg</small>
		            <b>Hei, Sigurd</b>
		            <p>Dette er bare en testmelding :)</p>
		    			</div>
	    			</div>
		    	</a>
		    	<a href="#" class="list-group-item">
			    	<div class="row">
		    			<div class="col-sm-1">
					    	<span class="fa fa-envelope-o fa-lg p-t-s"></span>
		    			</div>
		    			<div class="col-sm-11">
		            <small class="pull-right">John, deg</small>
		            <b>Hei, John</b>
		            <p>Dette er bare enda en testmelding med litt lengr...</p>
		    			</div>
	    			</div>
		    	</a>
			  </ul>
  		</div>
    </div> <!-- end col-md-4 -->

    <!-- Messeges -->
    <div class="col-md-8">
  	  <ul class="media-list media-list-conversation c-w-md panel panel-default">
	    	<!-- Participands -->
	    	<div class="panel-heading clearfix">
	    		<p>2 personer er med i denne samtalen</p>
		  	  <ul class="avatar-list">
					  <li class="avatar-list-item">
					    <img class="img-circle" src="/uploads/{{ $brukerinfo->profilbilde }}">
					  </li>
					  <li class="avatar-list-item">
					    <img class="img-circle" src="/uploads/img/profilbilder/57cff8c706228_id190BM5R1241.jpg">
					  </li>
					  <li class="avatar-list-item">
					    <span class="fa fa-plus-circle add-user-icon cursor" data-toggle="modal" data-target="#add-user-to-chat"></span>
					  </li>
					</ul>
				</div>
				<div class="panel-body">
				  <li class="media media-current-user m-b-md">
				    <div class="media-body">
				      <div class="media-body-text">
				        Dette er bare en testmelding :)
				      </div>
				      <div class="media-footer">
				        <small class="text-muted">
				          <a href="#">Jørgen Solli </a><span class="fa fa-clock-o"></span> 16:43
				        </small>
				      </div>
				    </div>
				    <a class="media-right" href="#">
				      <img class="img-circle media-object" src="/uploads/{{ $brukerinfo->profilbilde }}">
				    </a>
				  </li>
				  <li class="media m-b-md">
				    <a class="media-left" href="#">
				      <img class="img-circle media-object" src="/uploads/img/profilbilder/57cff8c706228_id190BM5R1241.jpg">
				    </a>
				    <div class="media-body">
				      <div class="media-body-text">
				       Heihei :)
				      </div>
				      <div class="media-body-text">
				       Vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum nulla sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nullam quis risus eget urna mollis ornare vel eu leo. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
				      </div>
				      <div class="media-body-text">
				       Cras mattis consectetur purus sit amet fermentum. Donec sed odio dui. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus.
				      </div>
				      <div class="media-footer">
				        <small class="text-muted">
				          <a href="#">Sigurd Sørensen </a><span class="fa fa-clock-o"></span> 18:21
				        </small>
				      </div>
				    </div>
				  </li>
			  </div>
	  	</ul>
    </div> <!-- end col-md-8 -->
  </div>
</div> <!-- end container -->



<!-- MODALS -->
<div id="add-user-to-chat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-user"></span> Legg til person i denne samtalen</h4>
      </div>
      <form method="POST" action="/bruker/uploads/forsidebilde" enctype="multipart/form-data"> 
        <div class="modal-body">
          {{ csrf_field() }}
          <select class="form-control">
          	<option>Ola Nordmann</option>
          </select>
          <br>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Legg til</button>
          <button type="reset" class="btn btn-default" data-dismiss="modal">Avbryt</button>
        </div>
      </form>
    </div>
  </div>
</div>

@stop