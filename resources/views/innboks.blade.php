@extends('layout', ['avatar' => $brukerinfo->profilbilde])

@section('content')
@include('notifications.notifications')
<div class="container m-t">
  <div class="row">
    <div class="col-md-4">
  		<div class="panel panel-info">
				<div class="panel-heading p-t-0 p-b-0 clearfix">
					<p class="h3 m-t-s pull-left">Meldinger</p>
					<button id="newMessage" type="button" class="pull-right btn btn-sm btn-default m-t-s"><span class="fa fa-plus-square-o"></span> Ny melding</button>
				</div>
		 		<ul id="messages" class="list-group">
		 			@if ($messages->isEmpty())
		 				<p class="list-group-item">
		 				Ingen meldinger å vise
			    	</p>
		 			@else
            @foreach ($messages as $message)
              <a id="{{ $message['id'] }}" class="list-group-item cursor">
                <div class="row">
                  <div class="col-sm-1">
                    <span class="fa fa-envelope-o fa-lg p-t-s"></span>
                  </div>
                  <div class="col-sm-11">
                    <small class="pull-right">
                      @foreach ($message['participants'] as $participant)
                        @if ($participant->bruker_type == "bedrift")
                          {{ $participant->bedrift_navn }}
                        @else
                          {{ $participant->fornavn }}
                        @endif

                        @unless ($loop->last)
                          · 
                        @endunless
                      @endforeach
                    </small>
                    <b> {{ $message['subject'] }} </b>
                    <p> {{ $message['message'] }} </p>
                  </div>
                </div>
              </a>
            @endforeach
			 			
		    	@endif
			  </ul>
  		</div>
    </div> <!-- end col-md-4 -->

    <!-- Messeges -->
    <div class="col-md-8">
    	<div class="ajaxLoading text-center m-t-md m-b-md" style="display: none;">
    		<span class="fa fa-circle-o-notch fa-spin fa-4x"></span>
  		</div>
    	<div id="newOrRead"></div>
    </div> <!-- end col-md-8 -->
  </div>
</div> <!-- end container -->

<!-- MODALS -->
<div id="add-user-to-chat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-user"></span> Legg til person i denne samtalen</p>
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
@section('script')
	<script src="/js/innboks.js"></script>
@stop