@extends('layout')
@include('includes.hjem.registrerBruker')
@section('content')
  @if (Auth::guest())
    @extends('auth.login')
      <div class="hero is-fullheight video">

          <div class="container hero-body">
            <div class="headerTitle">
              <div class="textbox">
                <h1 class="white-color">Velkommen til <br>Studentsamarbeid.no</h1>
                <hr class="is-hidden-mobile">
                <p class="h3 white-color">Møteplassen mellom din bedrift og <br>studenter fra Høgskolen i Sørøst-Norge</p>
              </div>
              <div class="registrerBtn">
                <a id="index-hvemerdu-btn" href="#registrer" class="smoothScrollRegistrer registrer-btn btn btn-lg btn-primary mar-right">
                    Opprett profil
                </a>
                <p class="gratis">Våre tjenester er gratis</p>
              </div>
            </div>
          </div>
          <div class="hero-foot">
            <div class="text-center">
              <span class="cursor icon is-large arrow-down">
                <i id="arrow-down-reg" class="fa fa-angle-down fa-2x"></i>
              </span>
            </div>
          </div>
        </div>

        <div id="registrer" class="jumbotron m-b-0 shadow hvemErDu">
          <div class="registrer-container">  
            <!-- Hvem er du? -->
            <div id="index-hvemerdu" style="display: block;">
              <div class="text-center">
                  <p class="h1 opprettTitle p-b-md">Opprett din profil</p>
              </div>
              <div id="btns-hvemerdu" class="text-center">
                <div class="rows text-center">
                  <div class="col-sm-4 text-center">
                    <a class="index-student">
                      <div class="hvemErDuStudent image-is-circle center-block"></div>
                    </a>
                    <a id="hvemErDuStudentA" class="index-student">Student</a>
                  </div>

                  <div class="col-sm-4">
                    <div class="is-inline-block">
                      <a class="index-bedrift">
                        <div class="hvemErDuBedrift image-is-circle center-block"></div>
                      </a>
                    </div>
                    <a id="hvemErDuBedriftA" class="index-bedrift">Bedrift</a>
                  </div>

                  <div class="col-sm-4">
                    <div class="is-inline-block">
                      <a class="index-faglarer">
                        <div class="hvemErDuLarer image-is-circle center-block"></div>
                      </a>
                    </div>
                    <a id="hvemErDuLarerA" class="index-faglarer">Foreleser</a>
                  </div>
                </div>
              </div>
            </div>
            @yield('registrerBruker')
          </div> <!-- end registrer-container -->  
        </div> 
    <div class="overlay"></div>
    <div id="bedriftsamarbeid" class="jumbotron jumbotron-marless has-shadow">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h2>Dette betyr et samarbeid for din bedrift</h2>
            <p>For din bedrift er dette en enkel måte å komme i kontakt med, og få innsyn i
                Høgskolen, samt en gyllen mulighet for å teste ut fremtidige arbeidstagere uten at
                det trenger å påløpe store ekstrakostnader.</p>
            <a href="/bedrift" class="bedriftsamarbeid-btn btn btn-lg">Les mer om bedriftssamarbeid</a>
          </div>
          <div class="col-sm-6 samarbeidBilde">
            <img class="img-responsive" src="img/building.png" alt="Kontorbygning">
          </div>
        </div>
      </div>
    </div>

    <div id="studentsamarbeid" class="jumbotron jumbotron-marless gray shadow">
      <div class="container">
        <div class="rows">
          <div class="col-sm-6">
            <h2>Dette betyr et samarbeid for deg som student</h2>
            <p>Som student vil du kunne dra nytte av høyaktuell praktisk erfaring og skape
                kontaktnettverk i det lokale næringslivet, som senere kan vise seg å være veien inn i fast jobb.</p>
            <a href="/student" class="studentsamarbeid-btn btn btn-lg">Les mer om studentsamarbeid</a>
          </div>
          <div class="col-sm-6 samarbeidBilde">
            <img class="img-responsive" src="img/school.png" alt="Høykole">
          </div>
        </div>
      </div>
    </div>


    <div id="rakettfart" class="jumbotron gray shadow">
      <div class="container">
        <div class="rows">
          <div class="col-sm-6 is-centered-mobile">
            <h1>Kom i gang nå og utvid ditt nettverk med rakettfart!</h1>
            <a href="#registrer" class="rakettfart-btn btn btn-lg is-outlined">
                Opprett profil
            </a>
          </div>
          <div class="col-sm-6">
            <img class="img-responsive" src="img/fastChair.png" alt="Kontorstol">
          </div>
        </div>
      </div>
    </div>
  @endif
  <!-- Melding etter registrering -->
  @include('notifications.checkMailAndLogIn')
@stop

@section('script')
  @if (session('logginn'))
    <script>
      $("#loggInnModal").modal();
    </script>
  @endif
  <script src="/js/hjem.js"></script>
  <script src="/js/regValidate.js"></script>
@stop