<select class="form-control">
  @foreach ($users as $user)
  	@if ($user->bruker_Type == "bedrift")
  		<option value="{{ $user->id }}">{{ $user->bedrift_navn }}</option>
  	@else
			<option value="{{ $user->id }}">
				{{ $user->fornavn }} 
				{{ $user->etternavn }}
			</option>
  	@endif
  @endforeach
</select>