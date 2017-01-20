<ul class="media-list media-list-conversation c-w-md panel panel-default">
	<!-- Participands -->
	<div class="panel-heading clearfix">
		<div class="pull-right">
		  <ul class="avatar-list">
			  <li class="avatar-list-item">
			    <img class="img-circle" src="/uploads/{{ $sender_info->profilbilde }}">
			  </li>
			  <li class="avatar-list-item">
			    <span class="fa fa-plus-circle add-user-icon cursor" data-toggle="modal" data-target="#add-user-to-chat"></span>
			  </li>
			</ul>
		</div>
		<p class="h4 pull-left">Emne:  {{ $message->subject }}</p>
	</div>
	<div class="panel-body">
		@php $currUser = $message->user_id @endphp
		@if ($message->user_id == Auth::id())
			<!-- SENDER BODY -->
		  <li class="media media-current-user m-b-s">
		    <div class="media-body">
		      <div class="media-body-text">
		        {{ $message->message }}
		      </div>
		      <div class="media-footer">
		        <small class="text-muted">
		          <a href="#">{{ $message->user_name }} </a><span class="fa fa-clock-o"></span> {{ $message->created_at }}
		        </small>
		      </div>
		    </div>
	      <a class="media-right" href="#">
		      <img class="img-circle media-object" src="/uploads/{{ $sender_info->profilbilde }}">
		    </a>
	    </li>
	  @else
	  	<li class="media m-b-s">
    		<a class="media-left" href="#">
		      <img class="img-circle media-object" src="/uploads/{{ $sender_info->profilbilde }}">
		    </a>
		    <div class="media-body">
		      <div class="media-body-text">
		      	{{ $message->message }}
		      </div>

		      <div class="media-footer">
		        <small class="text-muted">
		          <a href="#">{{ $message->user_name }} </a><span class="fa fa-clock-o"></span> {{ $message->created_at }}
		        </small>
		      </div>
		    </div>
		  </li>
	  @endif
	  <!-- ALL REPLIES FOLLOWS -->
	  @for ($i = 0; $i < count($replies); $i++)
	  	@if ($replies[$i]->user_id == Auth::id())
	      <li class="media media-current-user m-b-s">
		    <div class="media-body">
		      <div class="media-body-text">
		        {{ $replies[$i]->message }}
		      </div>
		      <div class="media-footer">
		        <small class="text-muted">
		          <a href="#">{{ $replies[$i]->user_name }} </a><span class="fa fa-clock-o"></span> {{ $replies[$i]->created_at }}
		        </small>
		      </div>
		    </div>
	      <a class="media-right" href="#">
		      <img class="img-circle media-object" src="/uploads/{{ $replies[$i]->profilbilde }}">
		    </a>
	    </li>
	  	@else
	  		<li class="media m-b-s">
	  			<a class="media-left" href="#">
			      <img class="img-circle media-object" src="/uploads/{{ $replies[$i]->profilbilde }}">
			    </a>
			    <div class="media-body">
			      <div class="media-body-text">
			        {{ $replies[$i]->message }}
			      </div>
			      <div class="media-footer">
			        <small class="text-muted">
			          <a href="#">{{ $replies[$i]->user_name }} </a><span class="fa fa-clock-o"></span> {{ $replies[$i]->created_at }}
			        </small>
			      </div>
			    </div>
  		@endif
	  	@php $currUser = $replies[$i]->user_id @endphp
  	@endfor

	  <!-- REPLY TO THE CONVERSATION -->
	  <li class="media">
	  	<hr>
      <div class="media-body">
        <form action="innboks/replyMessage/{{ $message->id }}" method="POST">
	      	<div class="form-group">
		        <div class="media-heading">
		          <small class="text-muted">Svar</small>
		        </div>
		        <textarea name="reply" id="svar" class="form-control" placeholder="Svar på denne samtalen."></textarea>
	        </div>
        	{{ csrf_field() }}
        	<button type="submit" class="btn btn-success pull-right">SEND</button>
        </form>
      </div>
    </li>
  </div>
</ul>