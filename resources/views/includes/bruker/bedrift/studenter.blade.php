<div class="text-center clearfix m-b sort-field">
  <div class="pull-left">
    <p class="pull-left p-r-s">Velg visning</p>
    <div class="sort-icons pull-left p-r pos-r">
      <a href="?sort=tiles"><span class="cursor fa fa-th-large fa-lg p-r-s"></span></a>
      <a href="?sort=list"><span class="cursor fa fa-th-list fa-lg"></span></a>
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
  @unless ($studenter == null)
    <!-- Card sort -->
    @if (app('request')->input('sort') == 'tiles')
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
      </div>
    @endforeach
      
    <!-- List sort -->
    @else
      @foreach ($studenter as $student)
        <ul class="media-list media-list-users list-group col-md-6">
          <li class="list-group-item">
            <div class="media">
              <a class="media-left" href="/bruker/{{ $student->id }}">
                <img class="media-object img-circle" src="/uploads/{{ $student->profilbilde }}">
              </a>
              <div class="media-body">
                <a href="/bruker/{{ $student->id }}" class="btn btn-primary-outline btn-sm pull-right">
                  <span class="icon icon-add-user"></span> Se profil
                </a>
                <strong>{{ $student->bedrift_navn }}</strong>
                <small>@ {{ $student->email }}</small>
              </div>
            </div>
          </li>
        </ul>
      @endforeach
    @endif
  @else
    <p>Det finnes ingen studenter som passer til din bedrift</p>
  @endunless
</div>