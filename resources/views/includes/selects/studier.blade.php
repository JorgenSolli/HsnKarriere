@if ($brukerinfo->bruker_type == "bedrift")
    <optgroup label="Dine valg">
      @foreach ($company as $studie)
        <option selected value="{{ $studie->studie_id }}">{{ $studie->study }} </option>
      @endforeach
    </optgroup>

    @foreach ($studies as $study)
        <option value="{{ $study->id }}">{{ $study->study }}</option>
    @endforeach

@elseif ($brukerinfo->bruker_type == "faglarer")
    @foreach ($studies as $study)
        {{ $study->study }}
    @endforeach

@elseif ($brukerinfo->bruker_type == "student")
    <select name="mottakere[]" id="mottakere" class="select select2 js-example-basic-multiple is-fullwidth form-control">
      <option disabled>Velg en eller flere mottakere</option>
      @unless ($kontakter == null)
        @foreach ($kontakter as $kontakt)
          @if ($kontakt->user_id == Request::get('reciepment'))
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
      @endunless
    </select>
    @foreach ($studies as $study)
        <option value="{{ $study->study }}">{{ $study->study }} - {{ $study->type }}</option>
    @endforeach
@endif