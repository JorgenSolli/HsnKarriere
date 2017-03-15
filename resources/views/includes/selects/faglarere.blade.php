@foreach ($faglarere as $faglarer)
	<option value="{{ $faglarer->id}}">
		{{ $faglarer->fornavn }} {{ $faglarer->etternavn }}
	</option>
@endforeach