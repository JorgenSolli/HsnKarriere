@extends('layout', ['avatar' => $brukerinfo->profilbilde])
@include('includes.studier')

@section('content')

  <div class="container p-t-md">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-default panel-profile m-b-md">
          <div id="nyttForsidebilde" class="pos-a m-a cursor" data-toggle="modal" data-target="#nyttProfilbildeModal">
            <span class="fa fa-camera fa-lg"></span>
            <small style="display: none">Endre forsidebilde</small>
          </div>
          <div id="forsidebildeContainer" class="panel-heading" style="background-image: url($brukerinfo->forsidebilde);"></div>
          <div class="panel-body text-center">
            <a href="profile/index.html">
              <div id="nyttProfilbilde" class="pos-a m-a cursor">
                <span class="fa fa-camera fa-lg"></span>
                <small style="display: none">Endre forsidebilde</small>
              </div>
              <img class="panel-profile-img" src="/uploads/img/{{ $brukerinfo->profilbilde }}">
            </a>

            <h5 class="panel-title">
              <a class="text-inherit" href="profile/index.html">{{ $brukerinfo->fornavn }} {{ $brukerinfo->etternavn }}</a>
            </h5>

            <p class="m-b-md">{{ $brukerinfo->bio }} [ ... bio ... ]</p>

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

        <div class="panel panel-default visible-md-block visible-lg-block">
          <div class="panel-body">
            <h5 class="m-t-0">CV</h5>
            <p>Last opp CV</p>
          </div>
        </div>

         <div class="panel panel-default visible-md-block visible-lg-block">
          <div class="panel-body">
            <h5 class="m-t-0">Attester</h5>
            <p>Last opp attester</p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <ul class="list-group media-list media-list-stream">
          <form action="rediger/{{ $brukerinfo->id }}" method="POST">
            <li class="media list-group-item p-a">
              <div class="media-left">
                <span class="media-object fa fa-align-left"></span>
              </div>
              <div class="media-body">
                <div class="media-heading">
                  <small class="pull-right text-muted">Kort om deg</small>
                  <h4>Biografi</h4>
                </div>
                <textarea name="bio" class="form-control" placeholder="Kort om deg"></textarea>
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
                    <h4>Litt om deg</h4>
                  </div>
                    <div class="form-group">
                      <label for="fornavn">Navn</label>
                      <div class="row">
                        <div class="col-xs-6 p-r-0">
                          <input name="fornavn" type="text" class="form-control" id="fornavn" placeholder="Fornavn">
                        </div>
                        <div class="col-xs-6">
                          <input name="etternavn" type="text" class="form-control" id="etternavn" placeholder="Etternavn">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="adresse">Bosted</label>
                      <div class="row">
                        <div class="col-xs-5 p-r-0">
                          <input name="adresse" type="text" class="form-control" id="adresse" placeholder="Adresse">
                        </div>
                        <div class="col-xs-2 p-r-0">
                          <input name="postNr" type="text" class="form-control" id="postnr" placeholder="PostNr">
                        </div>
                        <div class="col-xs-5">
                          <input name="poststed" type="text" class="form-control" id="poststed" placeholder="Poststed">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="epost">Epost</label>
                      <input name="email" type="email" class="form-control" id="epost" placeholder="Epost">
                    </div>
                    <div class="form-group">
                      <label for="dob">Fødselsdato</label>
                      <div class="input-group date">
                        <input name="dob" type="text" class="form-control" placeholder="Fødselsdato"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="facebook">Sosiale medier</label>
                      <div class="row">
                        <div class="col-xs-6 p-r-0">
                          <div class="form-group has-feedback">
                            <input name="facebook" type="text" class="form-control" id="facebook" placeholder="Facebook">
                            <i class="fa fa-facebook form-control-feedback"></i>
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="form-group has-feedback">
                            <input name="linkedin" type="text" id="linkedin" class="form-control" placeholder="LinkedIn">
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
                  <small class="pull-right text-muted">Studier og tider</small>
                  <h4>Dine studier</h4>
                </div>
                <div class="form-group">
                  <label for="studiested">Studiested</label>
                  <select name="student_campus" id="studiested" class="form-control">
                    <option value="bø">Bø</option>
                    <option value="notodden">Notodden</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="studieretning">Studieretning</label>
                  @yield('selectStudieretning')
                </div>
                <div id="studieretningValg"></div>
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
            {{ csrf_field() }}
            <!-- <input type="hidden" name="_method" value="put"> -->
          </form>
        </ul>
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
          <h5 class="m-t-0">Passende Bedrifter <small>· <a href="#">Se Alle</a></small></h5>
          <ul class="media-list media-list-stream">
            <li class="media m-b">
              <a class="media-left" href="#">
                <img
                  class="media-object img-circle"
                  src="/uploads/img/{{ $brukerinfo->profilbilde }}">
              </a>
              <div class="media-body">
                <strong>Step Media</strong> · Bø
                <div class="media-body-actions">
                  <button class="btn btn-primary-outline btn-xs">
                    <span class="fa fa-info"></span> Se profil</button>
                </div>
              </div>
            </li>
             <li class="media">
              <a class="media-left" href="#">
                <img
                  class="media-object img-circle"
                  src="/uploads/img/{{ $brukerinfo->profilbilde }}">
              </a>
              <div class="media-body">
                <strong>Drangedal kommune</strong> · Drangedal
                <div class="media-body-actions">
                  <button class="btn btn-primary-outline btn-xs">
                    <span class="fa fa-info"></span> Se profil</button></button>
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

            <a href="#">About</a>
            <a href="#">Help</a>
            <a href="#">Terms</a>
            <a href="#">Privacy</a>
            <a href="#">Cookies</a>
            <a href="#">Ads </a>

            <a href="#">info</a>
            <a href="#">Brand</a>
            <a href="#">Blog</a>
            <a href="#">Status</a>
            <a href="#">Apps</a>
            <a href="#">Jobs</a>
            <a href="#">Advertise</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- MODALS -->
  <div id="nyttProfilbildeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><span class="fa fa-picture-o"></span> Nytt forsidebilde</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="#" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input id="forsidebilde-input" type="file" multiple data-min-file-count="1">
            <br>
            <button type="submit" class="btn btn-primary">Last opp</button>
            <button type="reset" class="btn btn-default">Nullstill</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@stop
@section('script')
  <script src="/js/redigerBruker.js"></script>
@stop