@if ($forelesere)
@php $row = 0 @endphp
<!-- Card sort -->
<div class="row">
  @foreach ($forelesere as $foreleser)
    <div class="col-md-3 m-t-md">
        <div class="panel panel-default panel-profile">
          <div class="panel-heading" style="background-image: url(/uploads/{{ $foreleser->forsidebilde }});"></div>
          <div class="panel-body text-center">
            <input type="hidden" name="loc" value="{{ $foreleser->poststed }}">
            <img class="panel-profile-img" src="/uploads/{{ $foreleser->profilbilde }}">
            <p class="h5 panel-title">{{ $foreleser->fornavn }} {{ $foreleser->etternavn }}</p>
            <p class="m-b-md">
              <span class="fa fa-envelope-o"></span> {{ $foreleser->email }}
              <br>
              <span class="fa fa-phone"></span> {{ $foreleser->telefon }}
            </p>
            <a class="btn btn-primary-outline btn-sm m-r-s" href="/bruker/{{ $foreleser->user_id }}">
              <span class="icon icon-user"></span> Se profil
            </a>
            <a class="btn btn-primary-outline btn-sm" href="/innboks/#send{{ $foreleser->user_id }}">
              <span class="fa fa-commenting-o"></span> Send melding
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
@endif