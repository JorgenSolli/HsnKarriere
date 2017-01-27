@foreach ($faglarere as $faglarer)
	<option value="{{ $faglarer['user_id'] }}">
		{{ $faglarer['fornavn'] }} {{ $faglarer['etternavn'] }}
	</option>
@endforeach