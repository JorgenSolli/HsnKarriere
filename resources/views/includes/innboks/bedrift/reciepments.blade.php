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
  @foreach ($studenter as $student)
    @if ($reciepment['data'] && in_array($student->user_id, $reciepment['data']))
      <option selected value="{{ $student->user_id }}">
    @else
      <option value="{{ $student->user_id }}">
    @endif
  		{{ $student->fornavn }} {{ $student->etternavn }}
  	</option>
  @endforeach
@endsection
