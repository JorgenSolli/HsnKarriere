@extends('includes.innboks.newMessage')

@section('reciepments')
  <option disabled>Velg en eller flere mottakere</option>
  {{-- Loops through professors. Selects one if its in the message array --}}
  @foreach ($forelesere as $foreleser)
    @if ($reciepment['data'] && in_array($foreleser->user_id, $reciepment['data']))
      <option selected value="{{ $foreleser->user_id }}">
    @else
      <option value="{{ $foreleser->user_id }}">
    @endif
        {{ $foreleser->fornavn }} {{ $foreleser->etternavn }}
      </option>
  @endforeach

  {{-- Loops through companies. Selects one if its in the message array --}}
  @if ($bedrifter)
    @foreach ($bedrifter as $bedrift)
      @if ($reciepment['data'] && in_array($bedrift->user_id, $reciepment['data']))
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
@endsection
