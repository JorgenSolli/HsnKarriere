<div id="listMastersParent" class="modal-dialog" role="document">
	<div id="showMasters" class="modal-content">
		<form method="POST" action="/bruker/editMaster/{{ $assignment->id }}" enctype="multipart/form-data">
      <div class="modal-header">
  		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  			  <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-briefcase"></span> {{ $assignment->tittel }}</p>
			</div>
      <div class="modal-body">
      	{{ method_field('PATCH') }}
        {{ csrf_field() }}

      <div class="form-group">
        <label for="master_tittel">Tittel</label>
        <input name="master_tittel" id="master_tittel" type="text" class="form-control" value="{{ $assignment->tittel }}">
      </div>

      <div class="form-group">
        <label for="master_fagfelt">Tilhørende fagfelt</label>
        <select id="master_fagfelt" name="master_fagfelt" class="form-control">
          @foreach ($bedrift_fagfelt as $fagfelt)
          	@if ($assignment->fagfelt == $fagfelt)
            	<option value="{{ $fagfelt }}" selected>{{ $fagfelt }} </option>
        		@else
        			<option value="{{ $fagfelt }}">{{ $fagfelt }} </option>
          	@endif
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="master_info">Kort om oppgaven</label>
        <textarea name="master_info" id="master_info" class="form-control">{{ $assignment->info }}</textarea>
      </div>

      <div class="form-group">
	      <label for="masteroppgave-file">
	      	Last opp oppgave (kun pdf tillatt)
	      	<small class="danger-text">La denne være blank hvis du ikke ønsker å endre fil</small>
	    	</label>

	      <input id="masteroppgave-file" name="masteroppgave-file" type="file">
      </div>

      <label>Nåværende fil</label>
      <a href="/uploads/{{ $assignment->fil }}">{{ $assignment->filnavn }}</a>
    </div>
    <div class="modal-footer">
      <button id="tilbakeSeeMasters" class="pull-left btn btn-danger">Avbryt</button>
      <button type="submit" class="pull-right btn btn-success">Last opp</button>
    </div>
  </form>
  </div>
</div>