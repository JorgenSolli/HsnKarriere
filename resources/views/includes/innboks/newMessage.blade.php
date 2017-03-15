<ul class="list-group media-list media-list-stream">	
	<li class="media list-group-item">
    <div class="media-body">
			<p class="h4"><span class="fa fa-envelope-open-o m-r-s"></span> Ny melding</p>
    </div>
  </li>
  <li class="media list-group-item p-a">
    <div class="media-body">
      <div class="media-body-text">
      	<form action="/innboks/sendNewMessage" method="POST">
      		{{ csrf_field() }}
        	<div class="form-group">
            <label for="mottakere">Mottaker(e)</label>
            <select name="mottakere[]" id="mottakere" 
            class="select select2 js-example-basic-multiple is-fullwidth form-control"
            multiple="multiple">
              <option disabled>Velg en eller flere mottakere</option>
              @if ($forelesere)
                @foreach ($forelesere as $foreleser)
                  @if ($foreleser->user_id == Request::get('reciepment'))
                    <option selected value="{{ $foreleser->user_id }}">
                  @else
                    <option value="{{ $foreleser->user_id }}">
                  @endif
                  {{ $foreleser->fornavn }} {{ $foreleser->etternavn }}
                  </option>
                @endforeach
              @endif
              @if ($bedrifter)
                @foreach ($bedrifter as $bedrift)
                  @if ($bedrift->user_id == Request::get('reciepment'))
                    <option selected value="{{ $bedrift->user_id }}">
                  @else
                    <option value="{{ $bedrift->user_id }}">
                  @endif
                		@if ($bedrift->bedrift_navn != "")
                			{{ $bedrift->bedrift_navn }}
                		@else
                			{{ $bedrift->fornavn }} {{ $bedrift->etternavn }}
                		@endif
                	</option>
                @endforeach
              @endif
            </select>
          </div>
          <div class="form-group">
            <label for="tittel">Emne</label>
              <input name="tittel" id="tittel" type="text" class="form-control" placeholder="Emne på meldingen">
          </div>
          <div class="form-group">
          	<label for="melding">Melding</label>
          	<textarea id="melding" class="form-control" name="melding" placeholder="Din melding..."></textarea>
        	</div>
        	<button class="btn btn-success pull-right" type="submit">SEND</button>
      	</form>
      </div>
    </div>
  </li>
</ul>