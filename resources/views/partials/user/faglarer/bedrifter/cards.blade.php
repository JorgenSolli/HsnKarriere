@if ($bedrifter)
  @foreach (array_chunk($bedrifter->all(), 4) as $chunk)
    <div class="row">
      @foreach ($chunk as $bedrift)
        <div class="col-md-3">
          <div class="panel panel-default panel-profile">
            <div class="panel-heading" style="background-image: url(/uploads/{{ $bedrift->forsidebilde }});"></div>
            <div class="panel-body text-center">
              <img class="panel-profile-img" src="/uploads/{{ $bedrift->profilbilde }}">
              <p class="h5 panel-title">{{ $bedrift->bedrift_navn }}</p>
              <p class="m-b-md">
                <span class="fa fa-envelope-o"></span> {{ $bedrift->email }}
                <br>
                <span class="fa fa-phone"></span> {{ $bedrift->telefon }}
              </p>
              <a class="btn btn-primary-outline btn-sm" href="/bruker/{{ $bedrift->user_id }}">
                <span class="icon icon-user"></span> Se profil
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endforeach
@else
  <p>Det finnes ingen bedrifter som passer til din bedrift</p>
@endif