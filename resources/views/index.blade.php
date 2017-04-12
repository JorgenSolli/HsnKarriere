@extends('layout')

@section('content')
  <div class="hero is-fullheight main-bg">
    <div class="container hero-body">
      <div class="headerTitle">
        <div class="textbox">
          <h1 class="white-color">Velkommen til <br>Studentsamarbeid.no</h1>
          <hr align="left" class="is-hidden-mobile">
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
          <img class="img-responsive" src="img/building.png">
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
          <img class="img-responsive" src="img/school.png">
        </div>
      </div>
    </div>
  </div>


  <div id="rakettfart" class="jumbotron gray shadow">
    <div class="container">
      <div class="rows">
        <div class="col-sm-6 is-centered-mobile">
          <h1>Kom i gang nå og utvid ditt nettverk med rakettfart!</h1>
          <a id="index-hvemerdu-btn" href="#registrer" class="rakettfart-btn btn btn-lg is-outlined">
              Opprett profil
          </a>
        </div>
        <div class="col-sm-6">
          <img class="img-responsive" src="img/fastChair.png">
        </div>
      </div>
    </div>
  </div>
@stop

@section('script')
  <script src="js/hjem.js"></script>
  
  @if (session('logginn'))
    <script>
      $("#loggInnModal").modal();
    </script>
  @endif
  
@endsection