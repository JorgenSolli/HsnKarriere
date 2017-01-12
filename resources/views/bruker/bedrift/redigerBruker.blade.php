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
            <h5 class="panel-title">
              <a class="text-inherit" href="profile/index.html">{{ $brukerinfo->bedrift_navn }}</a>
            </h5>

            <p class="m-b-md">{{ $brukerinfo->bio }}</p>

            <ul class="panel-menu">
              <li class="panel-menu-item">
                <a href="#userModal" class="text-inherit" data-toggle="modal">
                  Noe
                  <h5 class="m-y-0">120</h5>
                </a>
              </li>

              <li class="panel-menu-item">
                <a href="#userModal" class="text-inherit" data-toggle="modal">
                  Annet
                  <h5 class="m-y-0">5</h5>
                </a>
              </li>
            </ul>
          </div>
        </div>

        <div class="panel panel-success panel-hover-success cursor">
          <div class="panel-body text-center">
            <span class="fa fa-briefcase fa-3x"></span>
            <h4 class="m-t-s text-center">Utlys stilling</h4>
          </div>
        </div>

        <div class="panel panel-info panel-hover-info cursor">
          <div class="panel-body text-center">
            <span class="fa fa-file-pdf-o fa-3x"></span> 
            <h4 class="m-t-s text-center">Legg til mMsteroppgave</h4>
          </div>
        </div>

        <div class="panel panel-info panel-hover-info cursor">
          <div class="panel-body text-center">
            <span class="fa fa-file-pdf-o fa-3x"></span>
            <h4 class="m-t-s text-center">Legg til Bacheloroppgave</h4>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <form method="POST" action="/bruker/{{ $brukerinfo->id }}" enctype="multipart/form-data">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}
          <ul class="list-group media-list media-list-stream">
            <li class="media list-group-item p-a">
              <div class="media-left">
                <span class="media-object fa fa-align-left"></span>
              </div>
              <div class="media-body">
                <div class="media-heading">
                  <small class="pull-right text-muted">Kort om bedriften</small>
                  <h4>Litt om {{ $brukerinfo->bedrift_navn }}</h4>
                </div>
                <textarea name="bio" class="form-control" placeholder="Du trenger ikke skrive så mye.">{{ $brukerinfo->bio }}</textarea>
              </div>
            </li>

            <li class="media list-group-item p-a">
              <div class="media-left">
                <span class="media-object fa fa-info"></span>
              </div>
              <div class="media-body">
                <div class="media-body-text">
                  <div class="media-heading">
                    <small class="pull-right text-muted">Bare litt...</small>
                    <h4>Generel informasjon</h4>
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
                      <label for="adresse">Bedriftens adresse</label>
                      <div class="row">
                        <div class="col-xs-5 p-r-0">
                          <input name="adresse" type="text" class="form-control" id="adresse" placeholder="Adresse" 
                          value="{{ $brukerinfo->adresse }}">
                        </div>
                        <div class="col-xs-2 p-r-0">
                          <input name="postnr" type="text" class="form-control" id="postnr" placeholder="Postnr" 
                          value="{{ $brukerinfo->postnr }}">
                        </div>
                        <div class="col-xs-5">
                          <input name="poststed" type="text" class="form-control" id="poststed" placeholder="Poststed" 
                          value="{{ $brukerinfo->poststed }}">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="fagFelt">Bedriftens fagområde</label>
                      <select name="fagFelt[]" id="fagFelt" 
                      class="select select2 js-example-basic-multiple is-fullwidth form-control"
                      multiple="multiple">
                        <option value="" disabled>Hva driver bedriften din med?</option>
                        @include('includes.selects.fagomraader')
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="avdeling">Avdeling</label>
                        <input name="avdeling" id="avdeling" type="text" class="form-control" placeholder="Hvilken avdeling tillhører du?" value="{{ $brukerinfo->bedrift_avdeling }}">
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
                    <div class="form-group">
                      <label for="nettside">Nettside</label>
                      <input name="nettside" type="text" class="form-control" id="nettside" placeholder="Din nettside" value="{{ $brukerinfo->nettside }}">
                    </div>
                    <div class="form-group">
                      <label for="facebook">Sosiale medier</label>
                      <div class="row">
                        <div class="col-xs-6 p-r-0">
                          <div class="form-group has-feedback">
                            <input name="facebook" type="text" class="form-control" id="facebook" placeholder="Facebook" 
                            value="{{ $brukerinfo->facebook }}">
                            <i class="fa fa-facebook form-control-feedback"></i>
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="form-group has-feedback">
                            <input name="linkedin" type="text" id="linkedin" class="form-control" placeholder="LinkedIn" 
                            value="{{ $brukerinfo->linkedin }}">
                            <i class="fa fa-linkedin form-control-feedback"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </li>

            <li class="media list-group-item p-a">
              <div class="media-left">
                <span class="media-object fa fa-graduation-cap"></span>
              </div>
              <div class="media-body">
                <div class="media-heading">
                  <small class="pull-right text-muted">Hmmm</small>
                  <h4>Studenter</h4>
                </div>
                <div class="form-group">
                  <div class="form-group">
                    <label for="bedrift_ser_etter">Hvilke studenter ser du etter?</label>
                    <select name="bedrift_ser_etter[]" id="bedrift_ser_etter" class="select select2 js-example-basic-multiple is-fullwidth form-control"
                            multiple="multiple">
                      <option value="" disabled>Hvilke studenter er dere på jakt etter?</option>
                      @include('includes.selects.studier')
                    </select>
                  </div>
                </div>
              </div>
            </li>
            <li class="media list-group-item p-a">
              <div class="media-left">
                <span class="media-object fa fa-disk"></span>
              </div> <!-- end media-left -->
              <div class="media-body">
                <div class="form-group">
                  <a href="/bruker" class="btn btn-danger pull-right">Avbryt</a>
                  <button type="submit" class="btn btn-success pull-right m-r">Lagre</button>
                </div>
              </div> <!-- end media-body -->
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
          <h5 class="m-t-0">Passende Studenter <small>· <a href="#">Se Alle</a></small></h5>
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
            © 2017 Link Telemark
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
  <div id="nyttForsidebildeModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><span class="fa fa-picture-o"></span> Nytt forsidebilde</h4>
        </div>
        <form method="POST" action="/bruker/uploads/forsidebilde" enctype="multipart/form-data"> 
          <div class="modal-body">
            {{ csrf_field() }}
            <input id="forsidebilde-input" name="forsidebilde" type="file" multiple data-min-file-count="1">
            <br>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Last opp</button>
            <button type="reset" class="btn btn-default">Nullstill</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div id="nyttProfilbildeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-image-o"></span> Nytt profilbilde</h4>
        </div>
        <form method="POST" action="/bruker/uploads/profilbilde" enctype="multipart/form-data"> 
          <div class="modal-body">
            {{ csrf_field() }}
            <input id="profilbilde-input" name="profilbilde" type="file" multiple data-min-file-count="1">
            <br>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Last opp</button>
            <button type="reset" class="btn btn-default">Nullstill</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@stop
@section('script')
  <script src="/js/redigerBruker.js"></script>
@stop