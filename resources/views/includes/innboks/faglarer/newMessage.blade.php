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
              @unless ($kontakterStudenter == null)
                <optgroup label="Studenter">
                  @foreach ($kontakterStudenter as $kontakt)
                    @if ($kontakt->user_id == Request::get('reciepment') || $kontakt->user_id == Request::get('reciepmentTwo'))
                      <option selected value="{{ $kontakt->user_id }}">
                    @else
                      <option value="{{ $kontakt->user_id }}">
                    @endif
                  		@if ($kontakt->bedrift_navn != "")
                  			{{ $kontakt->bedrift_navn }}
                  		@else
                  			{{ $kontakt->fornavn }} {{ $kontakt->etternavn }}
                  		@endif
                  	</option>
                  @endforeach
                </optgroup>
              @endunless
              @unless ($kontakterBedrifter == null)
                <optgroup label="Bedrifter">
                  @foreach ($kontakterBedrifter as $kontakt)
                    @if ($kontakt->user_id == Request::get('reciepment') || $kontakt->user_id == Request::get('reciepmentTwo'))
                      <option selected value="{{ $kontakt->user_id }}">
                    @else
                      <option value="{{ $kontakt->user_id }}">
                    @endif
                    
                      @if ($kontakt->bedrift_navn != "")
                        {{ $kontakt->bedrift_navn }}
                      @else
                        {{ $kontakt->fornavn }} {{ $kontakt->etternavn }}
                      @endif
                    </option>
                  @endforeach
                </optgroup>
              @endunless

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