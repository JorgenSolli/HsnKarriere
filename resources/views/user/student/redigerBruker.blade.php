@extends('layout', ['avatar' => $brukerinfo->profilbilde])

<!-- REDIGER BRUKER STUDENT -->

@section('content')
  <div class="container p-t-md">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-default panel-profile m-b-md">
          {{-- 
            <div id="nyttForsidebilde" class="pos-a m-a cursor" data-toggle="modal" data-target="#nyttForsidebildeModal">
                                <span class="fa fa-camera fa-lg"></span>
                                <small style="display: none">Endre forsidebilde</small>
            </div> 
          --}}
          <div id="forsidebildeContainer" class="panel-heading" style="background-image: url(/uploads/{{ $brukerinfo->forsidebilde }});"></div>
          <div class="panel-body text-center">
            <div class="profilbildeRelative pos-r">
              <a id="_profilbildeContainer">
                <img id="profilbildeContainer" class="cursor panel-profile-img" src="/uploads/{{ $brukerinfo->profilbilde }}"
                data-toggle="modal" data-target="#nyttProfilbildeModal" alt="Profilbilde">
                <span id="nyttProfilbilde" class="pos-a fa fa-camera fa-2x" style="display: none"
                data-toggle="modal" data-target="#nyttProfilbildeModal"></span>
              </a>
            </div>
            <p class="h5 panel-title">
              <a class="text-inherit" href="profile/index.html">{{ $brukerinfo->fornavn }} {{ $brukerinfo->etternavn }}</a>
            </p>

            {!! $brukerinfo->bio !!}

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

        
        @if ($cv)
          <div class="panel panel-success panel-hover-success cursor m-b-xs" data-toggle="modal" data-target="#seeCv">
            <div class="panel-body">
              <p class="h4 m-t-s text-center"><span class="fa fa-upload"></span> Se/endre din CV</p>
            </div>
          </div>
        @else 
          <div class="panel panel-success panel-hover-success cursor m-b-xs" data-toggle="modal" data-target="#uploadCv">
            <div class="panel-body">
              <p class="h4 m-t-s text-center"><span class="fa fa-upload"></span> Last opp CV</p>
            </div>
          </div>
        @endif

        <div class="panel panel-info panel-hover-info cursor m-t-md m-b-xs">
          <div class="panel-body">
            <p class="h4 m-t-s text-center"><span class="fa fa-upload"></span> Last opp Attester</p>
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
                <div class="media-heading">
                  <span class="fa fa-align-left pull-left media-left-icon"></span>
                  <small class="pull-right text-muted">Kort om deg</small>
                  <p class="h4">Biografi</p>
                </div>
                <p id="loadingTinyMce" class="text-center">
                  <span class="fa fa-circle-o-notch fa-spin"></span><br>
                  Laster editor...
                </p>
                <textarea name="bio" id="bio" style="height: 0px; width: 0px; resize: none; border: none">
                  {!! $brukerinfo->bio !!}
                </textarea>
              </div>
            </li>

            <li class="media list-group-item p-a">
              <div class="media-body">
                <div class="media-body-text">
                  <div class="media-heading">
                    <span class="fa fa-info pull-left media-left-icon"></span>
                    <small class="pull-right text-muted">Bare litt...</small>
                    <p class="h4">Litt om deg</p>
                  </div>
                    <div class="form-group">
                      <label for="fornavn">Navn</label>
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
                      <label for="adresse">Bosted</label>
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
                      <label for="epost">Epost</label>
                      <input name="email" type="email" class="form-control" id="epost" placeholder="Epost" value="{{ $brukerinfo->email }}">
                    </div>
                    <div class="form-group">
                      <label for="telefon">Telefon</label>
                      <input name="telefon" type="number" class="form-control" id="telefon" placeholder="Telefonnummer" 
                      value="@unless ($brukerinfo->telefon == 0){{ $brukerinfo->telefon }}@endunless">
                    </div>
                    <div class="form-group">
                      <label for="dob">Fødselsdato</label>
                      <div class="input-group date dateDob">
                        <input name="dob" id="dob" type="text" class="form-control" placeholder="Fødselsdato" value="{{ $brukerinfo->dob }}"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
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
              <div class="media-body">
                <div class="media-heading">
                  <span class="fa fa-graduation-cap pull-left media-left-icon"></span>
                  <small class="pull-right text-muted">Studier og tider</small>
                  <p class="h4">Dine studier</p>
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
                  <label for="studieretning">Studieretning</label>
                  <select name="studieretning" id="studieretning" class="form-control">
                  </select>
                </div>
                <div id="studieretningValg">
                  @foreach ($student_studerer as $study)
                    <div class="studieretningValg">
                      <input type="hidden" name="studyId[]" value="{{ $study->id }}">
                      <hr>
                      <div class="form-group">
                         <input class="form-control" name="study[]" value="{{ $study->study }} - {{ $study->type }}">
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <div class="col-xs-5 form-group p-r-0">
                                  <select class="form-control" name="campus[]">
                                      <option selected value="{{ $study->campus }}">{{ $study->campus }}</option>
                                  </select>
                              </div>
                              <div class="col-xs-3 form-group p-r-0">
                                  <select class="form-control datoFra" name="datoFra[]">
                                      <option selected value="{{ $study->fra }}">{{ $study->fra }}</option>
                                  </select>
                              </div>
                              <div class="col-xs-3 form-group">
                                  <select class="form-control datoTil" name="datoTil[]">
                                      <option selected value="{{ $study->til }}">{{ $study->til }}</option>
                                  </select>
                              </div>
                              <div class="col-xs-1">
                                  <span class="slettRad danger-color">
                                  <span class="fa fa-close fa-lg cursor"></span>
                                  </span>
                              </div>
                         </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </li>
            <li class="media list-group-item p-a">
              <div class="media-body">
                <div class="form-group">
                  <a href="/bruker" class="btn btn-danger pull-right">Avbryt</a>
                  <button type="submit" class="btn btn-success pull-right m-r">Lagre</button>
                </div>
              </div>
            </li>
          </ul>
        </form>
      </div>
      <div class="col-md-3">
        <div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <a class="alert-link"><span id="profileStatus"></span></a>
          <div class="m-b"></div>
          <div class="progress m-b-0">
            <div id="profileStr" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
            </div>
          </div>
        </div>

        <div class="panel panel-default m-b-md hidden-xs">
          <div class="panel-body">
          <p class="h5 m-t-0">Passende Bedrifter <small>· <a href="#">Se Alle</a></small></p>
          <ul class="media-list media-list-stream">
            <li class="media m-b">
              <a class="media-left" href="#">
                <img
                  class="media-object img-circle"
                  src="/uploads/{{ $brukerinfo->profilbilde }}"
                  alt="Profilbilde">
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
                  src="/uploads/{{ $brukerinfo->profilbilde }}"
                  alt="Profilbilde">
              </a>
              <div class="media-body">
                <strong>Drangedal kommune</strong> · Drangedal
                <div class="media-body-actions">
                  <button class="btn btn-primary-outline btn-xs">
                    <span class="fa fa-info"></span> Se profil</button>
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
  {{--
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
              <button type="submit" class="pull-right btn btn-primary">Last opp</button>
            </form>
              @if ($brukerinfo->forsidebilde != "img/forsidebilder/student_forsidebilde.jpg")
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
  --}}

  @if ($cv)
    <div id="seeCv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div id="listMastersAjax"></div>
      <div id="listMastersParent" class="modal-dialog" role="document">
        <div id="showMasters" class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-file-image-o"></span> Mine utlyste stillinger</p>
          </div>
          <div class="modal-body">
            <ul id="listMasters" class="media-list media-list-stream list-items-border m-b-0">
              <li class="media">
                <div class="media-body">
                  <strong>{{ $cv->title }}</strong> · {{ $cv->filnavn }}
                  <div class="media-body-actions">
                    <a href="/uploads/{{ $cv->cv }}" class="btn btn-primary-outline btn-xs m-r-s">
                      <span class="edit fa fa-file-pdf-o"></span> Se CV
                    </a>
                    <a href="/bruker/rediger/cv/{{ $cv->id }}" class="btn btn-danger-outline btn-xs">
                      <span class="delete fa fa-close"></span> Slett
                    </a>
                  </div>
                </div>
              </li>
            </ul>
            <div class="alert alert-info">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>OBS!</strong> Du kan kun ha en aktiv CV. Ønsker du å laste opp en ny CV? Slett denen først.
            </div>
          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" aria-label="Close" class="btn btn-primary">Lukk</button>
          </div>
        </div>
      </div>
    </div>
  @else
    <div id="uploadCv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-paper-plane"></span> Last opp CV</p>
        </div>
          <form method="POST" action="/bruker/uploadCv" enctype="multipart/form-data"> 
            <div class="modal-body">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="cv_tittel">Tittel</label>
                <input name="cv_tittel" id="cv_tittel" type="text" class="form-control" placeholder="Tittel">
              </div>

              <label for="cv_file">Last opp CV (kun pdf tillatt)</label>

              <input id="cv_file" name="cv_file" type="file">
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
  @endif

  <div id="uploadRecommendation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-paper-plane"></span> Last opp CV</p>
        </div>
          <form method="POST" action="/bruker/uploadCv" enctype="multipart/form-data"> 
            <div class="modal-body">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="cv_tittel">Tittel</label>
                <input name="cv_tittel" id="cv_tittel" type="text" class="form-control" placeholder="Tittel">
              </div>

              <label for="cv_file">Last opp CV (kun pdf tillatt)</label>

              <input id="cv_file" name="cv_file" type="file">
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

  <div id="seeRecommendation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-paper-plane"></span> Last opp CV</p>
        </div>
          <form method="POST" action="/bruker/uploadCv" enctype="multipart/form-data"> 
            <div class="modal-body">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="cv_tittel">Tittel</label>
                <input name="cv_tittel" id="cv_tittel" type="text" class="form-control" placeholder="Tittel">
              </div>

              <label for="cv_file">Last opp CV (kun pdf tillatt)</label>

              <input id="cv_file" name="cv_file" type="file">
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
            <div class="slim"
               data-ratio="1:1"
               data-size="640,640">
              <input type="file" name="avatar"/>
            </div>
            <br>
          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" aria-label="Close" class="pull-left btn btn-danger">Avbryt</button>
            <button type="submit" class="pull-right btn btn-primary">Last opp</button>
          </form>
          @if ($brukerinfo->profilbilde != "img/profilbilder/student_profilbilde.png")
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
  <script src="/js/dist/slim.kickstart.min.js"></script>
  <script src="/js/dist/tinymce/tinymce.min.js"></script>
  <script type="text/javascript">
    // Gets the profilestrength
    var bar = $("#profileStr");
    var filledFields = 0;
    var emptyFields = 0;

    if ($("#bio").text() > "") {
      filledFields++;
    } else { emptyFields ++ }
    if ($("#fornavn").val() > "") {
      filledFields++;
    } else { emptyFields ++ }
    if ($("#etternavn").val() > "") {
      filledFields++;
    } else { emptyFields ++ }
    if ($("#adresse").val() > "") {
      filledFields++;
    } else { emptyFields ++ }
    if ($("#postnr").val() > "") {
      filledFields++;
    } else { emptyFields ++ }
    if ($("#epost").val() > "") {
      filledFields++;
    } else { emptyFields ++ }
    if ($("#poststed").val() > "") {
      filledFields++;
    } else { emptyFields ++ }
    if ($("#telefon").val() > "") {
       filledFields++;
    } else { emptyFields ++ }
    if ($("#dob").val() > "") {
      filledFields++;
    } else { emptyFields ++ }
    if ($("#nettside").val() > "") {
      filledFields++;
    } else { emptyFields ++ }
    if ($("#facebook").val() > "") {
      filledFields++;
    } else { emptyFields ++ }
    if ($("#linkedin").val() > "") {
      filledFields++;
    } else { emptyFields ++ }

    var str =  100 - (emptyFields / filledFields * 100);
    var statusTxt = "";
    bar.css('width', str + '%');
    bar.html(Math.floor(str) + "%");

    if (str >= 0 &&  str <= 33) {
      statusTxt = "Profilen din mangler viktig data!";
    } else if (str > 33 && str < 66) {
      statusTxt = "Profilen din mangler trolig relevant data!";
    } else if (str >= 66 && str < 80) {
      statusTxt = "Profilen din er i OK stand";
    } else {
      statusTxt = "Profilen din er i god stand";
    }

    $("#profileStatus").html(statusTxt);

    // Loads TinyMCE
    var editor_config = {
      path_absolute : "{{ URL::to('/') }}/",
      plugins: "paste",
      paste_as_text: true,
      selector : "textarea",
      toolbar: "undo redo | styleselect | bold italic | bullist numlist | link",
      relative_urls: false,
      style_formats: [
        { title: "Overskrift", 
          inline: "span", 
          styles: {
            "font-family": "Open Sans, Helvetica Neue, Helvetica, Arial, sans-serif",
            "font-size": "18px"
          } 
        },
        { 
          title: "Paragraf" ,
          styles: {
            "font-family": "-apple-system,BlinkMacSystemFont, Segoe UI, Roboto, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol",
            "font-size": "14px"
          }
        },
      ],
      extended_valid_elements: "p, b, i, em",
      invalid_elements: "h1,h2,h3,h4,h5,em,i",
      height: 200,
      menubar: false,
      statusbar: false,
      language: "nb_NO",

      setup: function(ed) {
        ed.on('init', function(args) {
          $("#loadingTinyMce").hide();
        });
      }
    };

    tinymce.init(editor_config);
  </script>
  <script src="/js/redigerBruker.js"></script>
@stop