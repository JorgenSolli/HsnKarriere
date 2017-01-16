<div id="listJobsParent" class="modal-dialog" role="document">
	<div id="showJobs" class="modal-content">
		<form method="POST" action="/bruker/editJob/{{ $job->id }}" enctype="multipart/form-data">
      <div class="modal-header">
  		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  			  <h4 class="modal-title" id="myModalLabel"><span class="fa fa-briefcase"></span> {{ $job->stilling_tittel }}</h4>
  		</div>
      <div class="modal-body">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="form-group">
          <label for="stilling_sted">Sted</label>
          <input name="stilling_sted" id="stilling_sted" type="text" class="form-control" 
          value="{{ $job->sted }}">
        </div>

        <div class="form-group">
          <label for="stilling_varighetInt">Varighet</label>
          <div class="input-group is-fullwidth">
            <input name="stilling_varighetInt" id="stilling_varighetInt" type="number" class="form-control" value="{{ $job->varighet_int }}">
            <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
            <select id="stilling_varighetPrefix" name="stilling_varighetPrefix" class="form-control">
            	@if ($job->varighet_prefix == "År")
              	<option value="years" selected>År</option>
              	<option value="months">Måneder</option>
            	@else
              	<option value="months" selected>Måneder</option>
            		<option value="years">År</option>
            	@endif
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="stilling_type">Type</label>
          <select id="stilling_type" id="stilling_type" name="stilling_type" class="form-control">
          @if ($job->type == "praksis")
          	<option value="praksis" selected>Praksis</option>
            <option value="deltidsjobb">Deltidsjobb</option>
            <option value="sommerjobb">Sommerjobb</option>
          @elseif ($job->type == "deltidsjobb")
            <option value="deltidsjobb" selected>Deltidsjobb</option>
          	<option value="praksis">Praksis</option>
            <option value="sommerjobb">Sommerjobb</option>
          @else
            <option value="sommerjobb" selected>Sommerjobb</option>
          	<option value="deltidsjobb">Deltidsjobb</option>
          	<option value="praksis">Praksis</option>
          @endif
          </select>
        </div>

        <div class="form-group">
          <label for="stilling_frist">Frist</label>
          <div class="input-group date dateJob">
            <input name="stilling_frist" id="stilling_frist" type="text" class="form-control" value="{{ $job->frist }}">
            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
          </div>
        </div>

        <div class="form-group">
          <label for="stilling_tittel">Stillingstittel</label>
          <input name="stilling_tittel" id="stilling_tittel" type="text" class="form-control" value="{{ $job->stilling_tittel }}">
        </div>

        <div class="form-group">
          <label for="stilling_bransje">Bransje</label>
          <select id="stilling_bransje" name="stilling_bransje" class="form-control">
            @foreach ($bedrift_fagfelt as $fagfelt)
            	@if ($job->bransje == $fagfelt)
              	<option value="{{ $fagfelt }}" selected>{{ $fagfelt }} </option>
            	@else
              	<option value="{{ $fagfelt }}">{{ $fagfelt }} </option>
            	@endif
            @endforeach
          </select>
        </div>

        <label for="stilling_info">Om stillingen</label>
        <textarea name="stilling_info" id="stilling_info" class="form-control">{{ $job->info }}</textarea>

      </div>
      <div class="modal-footer">
        <button id="tilbakeSeeJobs" class="pull-left btn btn-danger">Tilbake</button>
        <button type="submit" class="pull-right btn btn-primary">Lagre</button>
      </div>
    </form>
  </div>
</div>