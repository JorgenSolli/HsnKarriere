@extends('layout', ['avatar' => $brukerinfo->profilbilde])

@section('content')
<div class="container m-a">
  <div class="row">
    <div class="col-md-4">
  		
    </div> <!-- end col-md-4 -->
    <div class="col-md-8">
  	  <ul class="media-list media-list-conversation c-w-md panel panel-default p-a-s">
	  <li class="media media-current-user m-b-md">
	    <div class="media-body">
	      <div class="media-body-text">
	        Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Sed posuere consectetur est at lobortis.
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
	      <img class="img-circle media-object" src="/uploads/{{ $brukerinfo->profilbilde }}">
	    </a>
	    <div class="media-body">
	      <div class="media-body-text">
	       Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
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
	  </ul>
    </div> <!-- end col-md-8 -->
  </div>
</div> <!-- end container -->

@stop