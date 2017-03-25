@extends('includes.innboks.newMessage')
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
@section('reciepments')

