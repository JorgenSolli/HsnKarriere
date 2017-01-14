@unless ($bedrifter == null)
@php $row = 0 @endphp
<!-- Card sort -->
<div class="row">
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
      </div> <!-- col-md-3 -->
    @php $row++ @endphp
    @if ($row == 4)
      @php $row = 0 @endphp
      </div>
      <div class="row">
    @endif
    @endforeach
  </div>
@else
<p>Det finnes ingen bedrifter som passer til din bedrift</p>
@endunless