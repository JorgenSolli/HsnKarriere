
<div class="row">
  @unless ($studenter == null)
    @foreach ($studenter as $student)
      <div class="col-md-3">
        <div class="panel panel-default panel-profile">
          <div class="panel-heading" style="background-image: url(/uploads/{{ $student->forsidebilde }});">
          </div>
          <div class="panel-body text-center">
            <img class="panel-profile-img" src="/uploads/{{ $student->profilbilde }}">
            <h5 class="panel-title">{{ $student->fornavn }} {{ $student->etternavn }}</h5>
            <p class="m-b-md">
              <span class="fa fa-envelope-o"></span> {{ $student->email }}
              <br>
              <span class="fa fa-phone"></span> {{ $student->telefon }}
            </p>
            <a class="btn btn-primary-outline btn-sm" href="/bruker/{{ $student->id }}">
              <span class="fa fa-user"></span> Se profil
            </a>
          </div>
        </div>
      </div> <!-- col-md-3 -->
    @endforeach
  @else
    <p>Det finnes ingen studenter som passer til din bedrift</p>
  @endunless
</div>