@section('bedrifter')
	<div class="text-center clearfix m-b sort-field">
		<div class="pull-left">
			<p class="pull-left p-r-s">Velg visning</p>
			<div class="sort-icons pull-left p-r pos-r">
				<span class="cursor fa fa-th-large fa-lg p-r-s"></span>
				<span class="cursor fa fa-th-list fa-lg"></span>
			</div>
		</div>
		<div class="pull-left">
			<small class="seperator pull-left p-r pos-r">|</small>
			<p class="pull-left m-a-0 p-r-s">Sorter etter</p>
			<select class="pull-left custom-select custom-select-sm">
			  <option>Relevans</option>
			  <option>Alfabetisk</option>
			  <option>Nærmest deg</option>
			</select>
		</div>
	</div>
	<div class="row">
	  @unless ($bedrifter == null)
	    @foreach ($bedrifter as $bedrift)
	      <div class="col-md-3">
	        <div class="panel panel-default panel-profile">
	          <div class="panel-heading" style="background-image: url(/uploads/{{ $bedrift->forsidebilde }});"></div>
	          <div class="panel-body text-center">
	            <img class="panel-profile-img" src="/uploads/{{ $bedrift->profilbilde }}">
	            <h5 class="panel-title">{{ $bedrift->bedrift_navn }}</h5>
	            <p class="m-b-md">
	              <span class="fa fa-envelope-o"></span> {{ $bedrift->email }}
	              <br>
	              <span class="fa fa-phone"></span> {{ $bedrift->telefon }}
	            </p>
	            <a class="btn btn-primary-outline btn-sm" href="/bruker/{{ $bedrift->id }}">
	              <span class="fa fa-user"></span> Se profil
	            </a>
	          </div>
	        </div>
	      </div> col-md-3 -->
	    @endforeach
	  @else
	    <p>Ingen bedrifter passer deg</p>
	  @endunless
	</div>
	<ul class="media-list media-list-users list-group col-md-6">
	  <li class="list-group-item">
	    <div class="media">
	      <a class="media-left" href="/bruker/{{ $bedrift->id }}">
	        <img class="media-object img-circle" src="/uploads/{{ $bedrift->profilbilde }}">
	      </a>
	      <div class="media-body">
	        <a href="/bruker/{{ $bedrift->id }}" class="btn btn-primary-outline btn-sm pull-right">
	          <span class="icon icon-add-user"></span> Se profil
	        </a>
	        <strong>{{ $bedrift->bedrift_navn }}</strong>
	        <small>@ {{ $bedrift->email }}</small>
	      </div>
	    </div>
	  </li>
	</ul>
@stop