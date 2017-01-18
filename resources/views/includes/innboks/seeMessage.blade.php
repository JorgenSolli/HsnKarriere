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
		<p class="h4 pull-left">Emne:  {{ $message->tittel }}</p>
	</div>
	<div class="panel-body">
		<!-- SENDER BODY -->
	  <li class="media media-current-user m-b-md">
	    <div class="media-body">
	      <div class="media-body-text">
	        {{ $message->innhold }}
	      </div>
	      <div class="media-footer">
	        <small class="text-muted">
	          <a href="#">{{ $message->fra_bruker_navn }} </a><span class="fa fa-clock-o"></span> {{ $message->created_at }}
	        </small>
	      </div>
	    </div>
	    <a class="media-right" href="#">
	      <img class="img-circle media-object" src="/uploads/{{ $sender_info->profilbilde }}">
	    </a>
	  </li>

	  <!-- ALL REPLIES FOLLOWS -->
	  <li class="media m-b-md">
	    <a class="media-left" href="#">
	      <img class="img-circle media-object" src="/uploads/{{ $reciepment_one_info->profilbilde }}">
	    </a>
	    <div class="media-body">
	      <div class="media-body-text">
	       Heihei :)
	      </div>
	      <div class="media-body-text">
	       reply msg
	      </div>
	      <div class="media-body-text">
	       another reply by same person
	      </div>
	      <div class="media-footer">
	        <small class="text-muted">
	          <a href="#">Sigurd Sørensen </a><span class="fa fa-clock-o"></span> 18:21
	        </small>
	      </div>
	    </div>
	  </li>

	  <!-- REPLY TO THE CONVERSATION -->
	  <li class="media">
	  	<hr>
      <div class="media-body">
      	<div class="form-group">
	        <div class="media-heading">
	          <small class="text-muted">Svar</small>
	        </div>
	        <textarea name="reply" class="form-control" placeholder="Svar på denne samtalen."></textarea>
        </div>
        <form action="innboks/replyMessage/{{ $message->id }}" method="POST">
        	<button type="submit" class="btn btn-success pull-right">SEND</button>
        </form>
      </div>
    </li>
  </div>
</ul>