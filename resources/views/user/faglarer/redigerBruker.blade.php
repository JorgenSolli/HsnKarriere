@extends('layout', ['avatar' => $brukerinfo->profilbilde])

<!-- REDIGER BRUKER BEDRIFT -->
@section('content')
  <div class="container p-t-md">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-default panel-profile m-b-md">
          <div id="nyttForsidebilde" class="pos-a m-a cursor" data-toggle="modal" data-target="#nyttForsidebildeModal">
            <span class="fa fa-camera fa-lg"></span>
            <small style="display: none">Endre forsidebilde</small>
          </div>
          <div id="forsidebildeContainer" class="panel-heading" style="background-image: url(/uploads/{{ $brukerinfo->forsidebilde }});"></div>
          <div class="panel-body text-center">
            <div class="profilbildeRelative pos-r">
              <a id="_profilbildeContainer">
                <img id="profilbildeContainer" class="cursor panel-profile-img" src="/uploads/{{ $brukerinfo->profilbilde }}"
                alt="Profilbilde"
                data-toggle="modal" data-target="#nyttProfilbildeModal">
                <span id="nyttProfilbilde" class="pos-a fa fa-camera fa-2x" style="display: none"
                data-toggle="modal" data-target="#nyttProfilbildeModal"></span>
              </a>
            </div>
            <p class="h5 panel-title">
              <a class="text-inherit" href="profile/index.html">{{ $brukerinfo->fornavn }} {{ $brukerinfo->etternavn }}</a>
            </p>

            <p class="m-b-md">Foreleser ved campus <i>{{ $brukerinfo->student_campus }}</i></p>

            <ul class="panel-menu">
              <li class="panel-menu-item">
                <a href="/bruker#mine-studenter" class="text-inherit" data-toggle="modal">
                  Studenter
                  <p class="h5 m-y-0">{{ $nrStudents }}</p>
                </a>
              </li>

              <li class="panel-menu-item">
                <a href="/bruker#bedrifter" class="text-inherit" data-toggle="modal">
                  Bedrifter
                  <p class="h5 m-y-0">{{ $nrCompanies }}</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <form method="POST" action="/bruker/{{ $brukerinfo->id }}" enctype="multipart/form-data">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}
          <ul class="list-group media-list media-list-stream">
            <li class="media list-group-item p-a">
              <div class="media-body">
                <div class="media-body-text">
                  <div class="media-heading">
                    <span class="fa fa-info pull-left media-left-icon"></span>
                    <small class="pull-right text-muted">Bare litt...</small>
                    <p class="h4">Generel informasjon</p>
                  </div>
                    <div class="form-group">
                      <label for="fornavn">Kontaktperson</label>
                      <div class="row">
                        <div class="col-xs-6 p-r-0">
                          <input name="fornavn" type="text" class="form-control" id="fornavn" placeholder="Fornavn" 
                          value="{{$brukerinfo->fornavn}}">
                        </div>
                        <div class="col-xs-6">
                          <input name="etternavn" type="text" class="form-control" id="etternavn" placeholder="Etternavn" 
                          value="{{ $brukerinfo->etternavn }}">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="studiested">Studiested</label>
                      <select name="student_campus" id="studiested" class="form-control">
                        @foreach ($campuses as $campus)
                          @if ($campus->campus == $brukerinfo->student_campus)
                            <option 
                              value="{{ $campus->campus }}" selected>
                              Campus {{ $campus->campus }}
                            </option>
                          @else
                            <option 
                              value="{{ $campus->campus }}">
                              Campus {{ $campus->campus }}
                            </option>
                          @endif
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="studie">Hvilket studie tilhører du?</label>
                      @if ($brukerinfo->student_campus)
                        <select name="studie[]" id="studie" class="form-control">
                          @foreach ($studier as $studie)
                            @if ($myStudies && $myStudies->studie_id == $studie->id)
                              <option selected value="{{ $studie->id }}">{{ $studie->study }} - {{ $studie->type }}</option>
                            @else
                              <option value="{{ $studie->id }}">{{ $studie->study }} - {{ $studie->type }}</option>
                            @endif
                          @endforeach
                        </select>
                      @else
                        <input class="form-control" type="text" disabled value="Oppdater profilen din med studiested først!">
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="avdeling">RomNr.</label>
                        <input name="avdeling" id="avdeling" type="text" class="form-control" placeholder="Hvilket romNr har kontoret ditt?" value="{{ $brukerinfo->foreleser_rom_nr }}">
                    </div>
                    <div class="form-group">
                      <label for="epost">Epost</label>
                      <input name="email" type="email" class="form-control" id="epost" placeholder="Epost" value="{{ $brukerinfo->email }}">
                    </div>
                    <div class="form-group">
                      <label for="telefon">Telefon</label>
                      <input name="telefon" type="number" class="form-control" id="telefon" placeholder="Telefonnummer" 
                      value="@unless ($brukerinfo->telefon == 0){{ $brukerinfo->telefon }}@endunless">
                    </div>
                </div>
              </div>
            </li>
            <li class="media list-group-item p-a">
              <div class="media-body">
                <div class="form-group">
                  <a href="/bruker" class="btn btn-danger pull-right">AVBRYT</a>
                  <button type="submit" class="btn btn-success pull-right m-r">LAGRE</button>
                </div>
              </div>
            </li>
          </ul>
        </form>
      </div>
      <div class="col-md-3">
        <div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <a class="alert-link">Din profil er i god stand!</a>
          <div class="m-b"></div>
          <div class="progress m-b-0">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
              <span class="sr-only">90% Fullført profil</span>
            </div>
          </div>
        </div>

        <div class="panel panel-default m-b-md hidden-xs">
          <div class="panel-body">
          <p class="h5 m-t-0">Passende Studenter <small>· <a href="#">Se Alle</a></small></p>
          <ul class="media-list media-list-stream">
            <li class="media m-b">
              <a class="media-left" href="#">
                <img
                  class="media-object img-circle"
                  src="/uploads/{{ $brukerinfo->profilbilde }}"
                  alt="Profilbilde">
              </a>
              <div class="media-body">
                <strong>Jørgen Solli</strong> · Bø
                <div class="media-body-actions">
                  <button class="btn btn-primary-outline btn-xs">
                    <span class="fa fa-info"></span> Se profil</button>
                </div>
              </div>
            </li>
            <li>
              <hr class="m-a-0">
            </li>
            <li class="media">
              <a class="media-left" href="#">
                <img
                  class="media-object img-circle"
                  src="/uploads/{{ $brukerinfo->profilbilde }}"
                  alt="profilbilde">
              </a>
              <div class="media-body">
                <strong>Sigurd Sørensen</strong> · Kina
                <div class="media-body-actions">
                  <button class="btn btn-primary-outline btn-xs">
                    <span class="fa fa-info"></span> Se profil
                  </button>
                </div>
              </div>
            </li>
          </ul>
          </div>
          <div class="panel-footer">
            Gå tilbake til profilen din for komplett oversikt over bedrifter og kontakter.
          </div>
        </div>

        <div class="panel panel-default panel-link-list">
          <div class="panel-body">
            © 2017 HSN Karriere
            <a href="#">Om</a> ·
            <a href="#">Hjelp</a> ·
            <a href="#">tos</a> ·
            <a href="#">Personvern</a> ·
            <a href="#">Cookies</a>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- MODALS -->
<div id="nyttForsidebildeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="forsidebildeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="h4 modal-title" id="forsidebildeModal"><span class="fa fa-picture-o"></span> Nytt forsidebilde</p>
      </div>
      <div class="modal-body">
        <form method="POST" action="/bruker/uploads/forsidebilde" enctype="multipart/form-data"> 
          {{ csrf_field() }}
          <input id="forsidebilde-input" name="forsidebilde" type="file" multiple data-min-file-count="1">
          <br>
      </div>
      <div class="modal-footer">
          <button data-dismiss="modal" aria-label="Close" class="pull-left btn btn-danger">Avbryt</button>
          <button type="submit" class="pull-right btn btn-success">Last opp</button>
          </form>
          @if ($brukerinfo->forsidebilde != "img/forsidebilder/bedrift_forsidebilde.jpg")
            <form method="POST" action="/bruker/rediger/forsidebilde/{{ $brukerinfo->id }}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="pull-right btn btn-danger">Slett nåværende bilde</button>
            </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<div id="nyttProfilbildeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-file-image-o"></span> Nytt profilbilde</p>
      </div>
      <div class="modal-body">
        <form method="POST" action="/bruker/uploads/profilbilde" enctype="multipart/form-data"> 
          {{ csrf_field() }}
          <input id="profilbilde-input" name="profilbilde" type="file" multiple data-min-file-count="1">
          <br>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" aria-label="Close" class="pull-left btn btn-danger">Avbryt</button>
          <button type="submit" class="pull-right btn btn-success">Last opp</button>
        </form>
        @if ($brukerinfo->profilbilde != "img/profilbilder/faglarer_profilbilde.png")
          <form method="POST" action="/bruker/rediger/profilbilde/{{ $brukerinfo->id }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="pull-right btn btn-danger">Slett nåværende bilde</button>
          </form>
        @endif
        </div>
      </div>
    </div>
  </div>
</div>
  
@stop
@section('script')
  <script src="/js/redigerBruker.js"></script>
@stop