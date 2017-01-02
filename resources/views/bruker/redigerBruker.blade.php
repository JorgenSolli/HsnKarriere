@extends('layout', ['avatar' => $brukerinfo->profilbilde])
@include('includes.studier')

@section('content')
  <div class="container p-t-md">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-default panel-profile m-b-md">
          <div class="panel-heading" style="background-image: url(assets/img/iceland.jpg);"></div>
          <div class="panel-body text-center">
            <a href="profile/index.html">
              <img
                class="panel-profile-img"
                src="/uploads/img/{{ $brukerinfo->profilbilde }}">
            </a>

            <h5 class="panel-title">
              <a class="text-inherit" href="profile/index.html">{{ $brukerinfo->fornavn }} {{ $brukerinfo->etternavn }}</a>
            </h5>

            <p class="m-b-md">I wish i was a little bit taller, wish i was a baller, wish i had a girl… also.</p>

            <ul class="panel-menu">
              <li class="panel-menu-item">
                <a href="#userModal" class="text-inherit" data-toggle="modal">
                  Friends
                  <h5 class="m-y-0">12M</h5>
                </a>
              </li>

              <li class="panel-menu-item">
                <a href="#userModal" class="text-inherit" data-toggle="modal">
                  Enemies
                  <h5 class="m-y-0">1</h5>
                </a>
              </li>
            </ul>
          </div>
        </div>

        <div class="panel panel-default visible-md-block visible-lg-block">
          <div class="panel-body">
            <h5 class="m-t-0">About <small>· <a href="#">Edit</a></small></h5>
            <ul class="list-unstyled list-spaced">
              <li><span class="text-muted icon icon-calendar m-r"></span>Went to <a href="#">Oh, Canada</a>
              <li><span class="text-muted icon icon-users m-r"></span>Became friends with <a href="#">Obama</a>
              <li><span class="text-muted icon icon-github m-r"></span>Worked at <a href="#">Github</a>
              <li><span class="text-muted icon icon-home m-r"></span>Lives in <a href="#">San Francisco, CA</a>
              <li><span class="text-muted icon icon-location-pin m-r"></span>From <a href="#">Seattle, WA</a>
            </ul>
          </div>
        </div>

         <div class="panel panel-default visible-md-block visible-lg-block">
          <div class="panel-body">
            <h5 class="m-t-0">Photos <small>· <a href="#">Edit</a></small></h5>
            <div data-grid="images" data-target-height="150">
              <div>
                <img data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_5.jpg">
              </div>

              <div>
                <img data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_6.jpg">
              </div>

              <div>
                <img data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_7.jpg">
              </div>

              <div>
                <img data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_8.jpg">
              </div>

              <div>
                <img data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_9.jpg">
              </div>

              <div>
                <img data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_10.jpg">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <ul class="list-group media-list media-list-stream">
          <li class="media list-group-item p-a">
            <div class="media-left">
              <span class="media-object fa fa-align-left"></span>
            </div>
            <div class="media-body">
              <div class="media-heading">
                <small class="pull-right text-muted">Kort om deg</small>
                <h4>Biografi</h4>
              </div>
              <textarea class="form-control" placeholder="Kort om deg"></textarea>
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
                <form>
                  <div class="form-group">
                    <label for="fornavn">Navn</label>
                    <div class="row">
                      <div class="col-xs-6 p-r-0">
                        <input type="text" class="form-control" id="fornavn" placeholder="Fornavn">
                      </div>
                      <div class="col-xs-6">
                        <input type="text" class="form-control" id="etternavn" placeholder="Etternavn">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="adresse">Bosted</label>
                    <div class="row">
                      <div class="col-xs-5 p-r-0">
                        <input type="text" class="form-control" id="adresse" placeholder="Adresse">
                      </div>
                      <div class="col-xs-2 p-r-0">
                        <input type="text" class="form-control" id="postnr" placeholder="PostNr">
                      </div>
                      <div class="col-xs-5">
                        <input type="text" class="form-control" id="poststed" placeholder="Poststed">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="epost">Epost</label>
                    <input type="email" class="form-control" id="epost" placeholder="Epost">
                  </div>
                  <div class="form-group">
                    <label for="dob">Fødselsdato</label>
                    <div class="input-group date">
                      <input type="text" class="form-control" placeholder="Fødselsdato"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="facebook">Sosiale medier</label>
                    <div class="row">
                      <div class="col-xs-6 p-r-0">
                        <div class="form-group has-feedback">
                          <input type="text" class="form-control" id="facebook" placeholder="Facebook">
                          <i class="fa fa-facebook form-control-feedback"></i>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group has-feedback">
                          <input type="text" id="linkedin" class="form-control" placeholder="LinkedIn">
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
                  <select id="studiested" class="form-control">
                    <option value="bø">Bø</option>
                    <option value="notodden">Notodden</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="studieretning">Studieretning</label>
                  @yield('selectStudieretning')
                </div>
                <div id="studieretningValg">
                  <hr>
                  <div class="form-group">
                    <input class="form-control" name="studretning[]" value="studretning">
                  </div> 
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-5 form-group p-r-0">
                        <select class="form-control" name="campus[]">
                            <option selected disabled>Campus</option>
                            <option value="Campus Bø">Bø</option>
                            <option value="Campus Porsgrunn">Porsgrunn</option>
                        </select>
                      </div>
                      <div class="col-xs-3 form-group p-r-0">
                        <select class="form-control" name="datoFra[]" class="datoFra">
                            <option selected disabled>Fra</option>
                            <option value=""></option>
                        </select>
                      </div>
                      <div class="col-xs-3 form-group">
                        <select class="form-control" name="datoTil[]" class="datoTil">
                            <option selected disabled>Til</option>
                            <option value=""></option>
                        </select>
                      </div>
                      <div class="col-xs-1">
                        <span onclick="return slettRad(this)" class="icon slettRad scaryRed-color">
                            <span class="fa fa-close fa-lg pointer"></span>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-md-3">
        <div class="alert alert-warning alert-dismissible hidden-xs" role="alert">
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
@stop
@section('script')
  <script>
    $('.input-group.date').datepicker({
      endDate: "today",
      startView: 3,
      maxViewMode: 3,
      format: "dd/mm/yyyy",
      language: "no",
      autoclose: true
    });
  </script>
@stop