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
              <a class="text-inherit" href="profile/index.html">{{ $brukerinfo->bedrift_navn }}</a>
            </p>

            <p class="m-b-md">{{ $brukerinfo->bio }}</p>

            <ul class="panel-menu">
              <li class="panel-menu-item">
                <a href="#userModal" class="text-inherit" data-toggle="modal">
                  Noe
                  <p class="h5 m-y-0">120</p>
                </a>
              </li>

              <li class="panel-menu-item">
                <a href="#userModal" class="text-inherit" data-toggle="modal">
                  Annet
                  <p class="h5 m-y-0">5</p>
                </a>
              </li>
            </ul>
          </div>
        </div>

        <div class="panel panel-info panel-hover-info cursor m-b-xs"
          data-toggle="modal" data-target="#utlysStilling">
          <div class="panel-body text-center">
            <span class="fa fa-briefcase fa-3x"></span>
            <p class="h4 m-t-s text-center">Utlys stilling</p>
          </div>
        </div>
        @unless ($jobs->isEmpty())
          <div class="panel panel-info panel-hover-info cursor"
            data-toggle="modal" data-target="#seStillinger">
              <p class="h6 m-t-s text-center">
                <span class="m-r-md fa fa-cogs"></span>Se/endre utlyste stillinger
              </p>
          </div>
        @endunless

        <div class="panel panel-info panel-hover-info cursor m-t-md m-b-xs"
          data-toggle="modal" data-target="#nyMaster">
          <div class="panel-body text-center">
            <span class="fa fa-file-pdf-o fa-3x"></span> 
            <p class="h4 m-t-s text-center">Legg til Masteroppgave</p>
          </div>
        </div>
        @unless ($masters->isEmpty())
          <div class="panel panel-info panel-hover-info cursor"
            data-toggle="modal" data-target="#seMasters">
              <p class="h6 m-t-s text-center">
                <span class="m-r-md fa fa-cogs"></span>Se/endre Masteroppgaver
              </p>
          </div>
        @endunless

        <div class="panel panel-info panel-hover-info cursor m-t-md m-b-xs"
          data-toggle="modal" data-target="#nyBachelor">
          <div class="panel-body text-center">
            <span class="fa fa-file-pdf-o fa-3x"></span>
            <p class="h4 m-t-s text-center">Legg til Bacheloroppgave</p>
          </div>
        </div>
        @unless ($bachelors->isEmpty())
          <div class="panel panel-info panel-hover-info cursor "
            data-toggle="modal" data-target="#seBachelors">
              <p class="h6 m-t-s text-center">
                <span class="m-r-md fa fa-cogs"></span>Se/endre Bacheloroppgaver
              </p>
          </div>
        @endunless
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
                  <p class="h4">Litt om {{ $brukerinfo->bedrift_navn }}</p>
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
                    <p class="h4">Generel informasjon</p>
                  </div>
                    <div class="form-group">
                      <label for="bedrift_navn">Bedriftsnavn</label>
                        <input name="bedrift_navn" id="bedrift_navn" type="text" class="form-control" placeholder="Navn på bedrift" value="{{ $brukerinfo->bedrift_navn }}">
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
                      <label for="bedrift_fagfelt">Bedriftens fagområde</label>
                      <select name="studie_id[]" id="bedrift_fagfelt" 
                      class="select select2 js-example-basic-multiple is-fullwidth form-control"
                      multiple="multiple">
                        <option value="" disabled>Hva driver bedriften din med?</option>
                        @include('includes.selects.studier')
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

            <li class="media list-group-item p-a hidden">
              <div class="media-left">
                <span class="media-object fa fa-graduation-cap"></span>
              </div>
              <div class="media-body">
                <div class="media-heading">
                  <small class="pull-right text-muted">Hmmm</small>
                  <p class="h4">Studenter</p>
                </div>
                <div class="form-group">
                  <div class="form-group">
                    <label for="bedrift_ser_etter">Hvilke studenter ser du etter?</label>
                    <select name="bedrift_ser_etter[]" id="bedrift_ser_etter" class="select select2 js-example-basic-multiple is-fullwidth form-control"
                            multiple="multiple">
                      <option value="" disabled>Hvilke studenter er dere på jakt etter?</option>
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
                  <a href="/bruker" class="btn btn-danger pull-right">AVBRYT</a>
                  <button type="submit" class="btn btn-success pull-right m-r">LAGRE</button>
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
          @if ($brukerinfo->profilbilde != "img/profilbilder/bedrift_profilbilde.png")
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
  
  <div id="utlysStilling" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-briefcase"></span> Utlys stilling</p>
        </div>
        <form method="POST" action="/bruker/addJob/{{ $brukerinfo->id }}" enctype="multipart/form-data">
          <div class="modal-body">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="stilling_sted">Sted</label>
              <input name="stilling_sted" id="stilling_sted" type="text" class="form-control" placeholder="Hvor befinner jobben seg?">
            </div>

            <div class="form-group">
              <label for="stilling_varighetInt">Varighet</label>
              <div class="input-group is-fullwidth">
                <input name="stilling_varighetInt" id="stilling_varighetInt" type="number" class="form-control" placeholder="Hvor lenge varer jobben?">
                <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
                <select id="stilling_varighetPrefix" name="stilling_varighetPrefix" class="form-control">
                  <option value="years">År</option>
                  <option value="months">Måneder</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="stilling_type">Type</label>
              <select id="stilling_type" id="stilling_type" name="stilling_type" class="form-control">
                <option value="praksis">Praksis</option>
                <option value="deltidsjobb">Deltidsjobb</option>
                <option value="sommerjobb">Sommerjobb</option>
              </select>
            </div>

            <div class="form-group">
              <label for="stilling_frist">Frist</label>
              <div class="input-group date dateJob">
                <input name="stilling_frist" id="stilling_frist" type="text" class="form-control" placeholder="Frist">
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
              </div>
            </div>

            <div class="form-group">
              <label for="stilling_tittel">Stillingstittel</label>
              <input name="stilling_tittel" id="stilling_tittel" type="text" class="form-control" placeholder="Stillingstittel">
            </div>

            <div class="form-group">
              <label for="stilling_bransje">Bransje</label>
              <select id="stilling_bransje" name="stilling_bransje" class="form-control">
                @foreach ($company as $fagfelt)
                  <option value="{{ $fagfelt->id }}">{{ $fagfelt->study }} </option>
                @endforeach
              </select>
            </div>

            <label for="stilling_info">Om stillingen</label>
            <textarea name="stilling_info" id="stilling_info" class="form-control" placeholder="Om stillingen..."></textarea>

          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" aria-label="Close" class="pull-left btn btn-danger">Avbryt</button>
            <button type="submit" class="pull-right btn btn-primary">Legg til</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <div id="seStillinger" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div id="listJobsAjax"></div>
    <div id="listJobsParent" class="modal-dialog" role="document">
      <div id="showJobs" class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-file-image-o"></span> Mine utlyste stillinger</p>
        </div>
        <div class="modal-body">
          <ul id="listJobs" class="media-list media-list-stream list-items-border m-b-0">
            @foreach ($jobs as $job)
              <li class="media">
                <div class="media-body">
                  <strong>{{ $job->stilling_tittel }}</strong> · {{ $job->sted }}
                  <div class="media-body-actions">
                    <a id="jobId{{ $job->id }}" class="btn btn-primary-outline btn-xs m-r-s">
                      <span class="edit fa fa-cog"></span> Rediger
                    </a>
                    <a href="destroyJob/{{ $job->id }}" class="btn btn-danger-outline btn-xs">
                      <span class="delete fa fa-close"></span> Slett
                    </a>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" aria-label="Close" class="btn btn-primary">Lukk</button>
        </div>
      </div>
    </div>
  </div>

  <div id="nyMaster" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-paper-plane"></span> Legg til Masteroppgave</p>
        </div>
          <form method="POST" action="/bruker/addMaster/{{ $brukerinfo->id }}" enctype="multipart/form-data"> 
            <div class="modal-body">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="master_tittel">Tittel</label>
                <input name="master_tittel" id="master_tittel" type="text" class="form-control" placeholder="Tittel">
              </div>

              <div class="form-group">
                <label for="master_fagfelt">Tilhørende fagfelt</label>
                <select id="master_fagfelt" name="master_fagfelt" class="form-control">
                  @foreach ($company as $fagfelt)
                    <option value="{{ $fagfelt->id }}">{{ $fagfelt->study }} </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="master_info">Kort om oppgaven</label>
                <textarea name="master_info" id="master_info" class="form-control" placeholder="Om stillingen..."></textarea>
              </div>

              <label for="masteroppgave-file">Last opp oppgave (kun pdf tillatt)</label>

              <input id="masteroppgave-file" name="masteroppgave-file" type="file">
            </div>
            <div class="modal-footer">
              <button data-dismiss="modal" aria-label="Close" class="pull-left btn btn-danger">Avbryt</button>
              <button type="submit" class="pull-right btn btn-success">Last opp</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="seMasters" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div id="listMastersAjax"></div>
    <div id="listMastersParent" class="modal-dialog" role="document">
      <div id="showMasters" class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-file-image-o"></span> Mine utlyste stillinger</p>
        </div>
        <div class="modal-body">
          <ul id="listMasters" class="media-list media-list-stream list-items-border m-b-0">
            @foreach ($masters as $master)
              <li class="media">
                <div class="media-body">
                  <strong>{{ $master->tittel }}</strong> · {{ $master->filnavn }}
                  <div class="media-body-actions">
                    <a id="masterId{{ $master->id }}" class="btn btn-primary-outline btn-xs m-r-s">
                      <span class="edit fa fa-cog"></span> Rediger
                    </a>
                    <a href="destroyMaster/{{ $master->id }}" class="btn btn-danger-outline btn-xs">
                      <span class="delete fa fa-close"></span> Slett
                    </a>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" aria-label="Close" class="btn btn-primary">Lukk</button>
        </div>
      </div>
    </div>
  </div>

  <div id="nyBachelor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-paper-plane"></span> Legg til Bacheloroppgave</p>
        </div>
          <form method="POST" action="/bruker/addBachelor/{{ $brukerinfo->id }}" enctype="multipart/form-data"> 
            <div class="modal-body">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="bachelor_tittel">Tittel</label>
                <input name="bachelor_tittel" id="bachelor_tittel" type="text" class="form-control" placeholder="Tittel">
              </div>

              <div class="form-group">
                <label for="bachelor_fagfelt">Tilhørende fagfelt</label>
                <select id="bachelor_fagfelt" name="bachelor_fagfelt" class="form-control">
                  @foreach ($company as $fagfelt)
                    <option value="{{ $fagfelt->id }}">{{ $fagfelt->study }} </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="bachelor_info">Kort om oppgaven</label>
                <textarea name="bachelor_info" id="bachelor_info" class="form-control" placeholder="Om stillingen..."></textarea>
              </div>

              <label for="bacheloroppgave-file">Last opp oppgave (kun pdf tillatt)</label>

              <input id="bacheloroppgave-file" name="bacheloroppgave-file" type="file">
            </div>
            <div class="modal-footer">
              <button data-dismiss="modal" aria-label="Close" class="pull-left btn btn-danger">Avbryt</button>
              <button type="submit" class="pull-right btn btn-success">Last opp</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="seBachelors" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div id="listBachelorsAjax"></div>
    <div id="listBachelorsParent" class="modal-dialog" role="document">
      <div id="showBachelors" class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-file-image-o"></span> Mine utlyste stillinger</p>
        </div>
        <div class="modal-body">
          <ul id="listBachelors" class="media-list media-list-stream list-items-border m-b-0">
            @foreach ($bachelors as $bachelor)
              <li class="media">
                <div class="media-body">
                  <strong>{{ $bachelor->tittel }}</strong> · {{ $bachelor->filnavn }}
                  <div class="media-body-actions">
                    <a id="bachelorId{{ $bachelor->id }}" class="btn btn-primary-outline btn-xs m-r-s">
                      <span class="edit fa fa-cog"></span> Rediger
                    </a>
                    <a href="destroyBachelor/{{ $bachelor->id }}" class="btn btn-danger-outline btn-xs">
                      <span class="delete fa fa-close"></span> Slett
                    </a>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" aria-label="Close" class="btn btn-primary">Lukk</button>
        </div>
      </div>
    </div>
  </div>

  
@stop
@section('script')
  <script src="/js/redigerBruker.js"></script>
@stop