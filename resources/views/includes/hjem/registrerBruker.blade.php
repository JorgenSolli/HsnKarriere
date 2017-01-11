@section('registrerBruker')
<!-- Student -->
<div id="index-student-box" class="hero-body" style="display: none">
  <div class="container">
    <form method="post" class="focusJump" action="{{ url('register') }}" onsubmit="return studentValStep2()" _lpchecked="1">
      {{ csrf_field() }}
      <div id="studentStep1">
        <div class="header text-center">
          <p class="h4">Opprett din profil på under 2 minutter</p>
          <p class="lead">Søk etter bedrifter relatert til din studieretning, og kom i kontakt med potensielle arbeidsgivere interessert i studentsamarbeid lokalt i Telemark.</p>
        </div>
        <br>
        <div id="student-group-navn" class="row">
          <div class="col-sm-6">
            <label for="studRegFnavn" class="placeholder" id="studRegFnavn-jumper" style="font-size: 1.3em; margin-top: 15px;">Fornavn</label>
            <input onblur="sjekkFNavn(id, 'student')" onchange="sjekkFNavn(id, 'student')" class="form-control input-newstyle" name="studRegFnavn" id="studRegFnavn" type="text">
            <small id="fnavnErr-ny" class="help is-danger"></small>
          </div>
          <div class="col-sm-6">
            <label for="studRegEnavn" class="placeholder" id="studRegEnavn-jumper" style="font-size: 1.3em; margin-top: 15px;">Etternavn</label>
            <input onblur="sjekkENavn(id, 'student')" onchange="sjekkENavn(id, 'student')" class="form-control input-newstyle" name="studRegEnavn" id="studRegEnavn" type="text">
            <span id="enavnErr-ny" class="help is-danger"></span>
          </div>
        </div>
        <div class="text-center m-t-s">
          <a class="btn btn-primary m-r-s" id="studentStep1To0">
            <i class="fa fa-angle-left"></i>
            Tilbake
          </a>

          <a class="btn btn-primary" id="studentStep1To2" onclick="return studentValStep1()">
            Gå videre
            <i class="fa fa-angle-right"></i>
          </a>
        </div>
      </div>

      <div id="studentStep2" style="display: none">
        <div class="header text-center">
          <p class="title is-4">Skriv in eposten din så sender vi deg videre instrukser</p><br>
        </div>
        <div id="student-group-campus" class="row">
          <div class="col-sm-6">
            <span class="placeholder" id="studRegEpost-jumper">studnr@student.hit.no</span>
            <input onblur="sjekkEpost(this.value, 'student')" onchange="sjekkEpost(this.value, 'student')" name="email" id="studRegEpost" class="form-control input-newstyle" type="email">
            <span id="studpostError" class="help is-danger"></span><span id="studpostSjekk" class="help is-danger"></span>
          </div>
          <div class="col-sm-6">
            <select name="campus" id="regStudsted" class="form-control input-newstyle">
              <option value="Campus" selected>Campus</option>
              <option value="Bø">Bø</option>
              <option value="Porsgrunn">Porsgrunn</option>
              <option value="Annen">Annen</option>
            </select>
            <span id="campusError" class="help is-danger"></span>
          </div>
        </div>
        <input type="hidden" name="bruker_type" value="student">

        <div class="text-center">
          <a id="studentStep2To1" class="btn btn-primary">
            <i class="fa fa-angle-left"></i>
            <span>Tilbake</span>
          </a>

          <button type="submit" class="btn btn-success">
            <i class="fa fa-check"></i> 
            Opprett konto
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Bedrift -->
<div class="hero-body" id="index-bedrift-box" style="display: none;">
  <div class="container">
    <form method="post" class="focusJump" action="registrer.php?type=bedrift" onsubmit="return bedriftVal()">
      <div id="bedriftStep1">
        <div class="header text-center">
          <p class="title is-4">Opprett din profil på under 2 minutter!</p>
          <p class="subtitle">Søk etter studenter innen din bransje, og kom i kontakt med potensielle studenter interessert i bedriftssamarbeid lokalt i Telemark.</p>
        </div>
        <br>
        <div id="bedrift-group-navn" class="row">
          <div class="col-sm-6">
            <label for="bedRegNavn" class="placeholder" id="bedRegNavn-jumper">Bedriftsnavn </label>
            <input onblur="sjekksjekkBedNavn(id)" onchange="sjekksjekkBedNavn(id)" class="form-control input-newstyle" name="bedRegNavn" id="bedRegNavn" type="text" placeholder="">
            <small id="bednavnErr" class="is-danger"></small>
          </div>
          
          <div class="col-sm-6">
            <label for="bedRegEpost" class="placeholder" id="bedRegEpost-jumper">Bedriftsmail </label>
            <input onblur="sjekkEpost(this.value, 'bedrift')" onchange="sjekkEpost(this.value, 'bedrift')" class="form-control input-newstyle" name="bedRegEpost" id="bedRegEpost" type="text" placeholder="">
            <span id="bedpostError" class="help is-danger"></span>
            <span id="bedpostSjekk" class="help is-danger"></span>
          </div>
        </div>
        <p class="text-center">
          <span id="bedrift_next_error" class="help is-danger text-center"></span>
        </p>

        <div class="text-center m-t-s">
          <a class="btn btn-primary m-r-s" id="bedriftStep1To0">
            <i class="fa fa-angle-left"></i>
            Tilbake
          </a>

          <a class="btn btn-primary" id="bedriftStep1To2" onclick="return bedriftValStep1()">
            Gå videre
            <i class="fa fa-angle-right"></i>
          </a>
        </div>
      </div>

      <div id="bedriftStep2" style="display: none">
        <div class="header text-center">
          <p class="title is-4">Tilhører du en avdeling?</p><br>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label for="bedRegAvd" class="placeholder" id="bedRegAvd-jumper">Har bedriften din avdeliger? Hvis ikke, la være blank. </label>
            <input name="bedRegAvd" id="bedRegAvd" type="text" class="form-control input-newstyle">
          </div>
        </div>
        <div class="text-center">
          <a id="bedriftStep2To1" class="btn btn-primary">
            <i class="fa fa-angle-left"></i>
            Tilbake
          </a>

          <button type="submit" class="btn btn-success">
            <i class="fa fa-check"></i> 
            Opprett konto
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Faglærer -->
<div class="hero-body" id="index-faglarer-box" style="display: none;">
  <div class="container">
    <form method="post" class="focusJump" action="registrer.php?type=faglarer" onsubmit="return faglarerValStep2()">
      <div id="faglarerStep1">
        <div class="header text-center">
          <p class="title is-4">Opprett din profil på under 2 minutter</p>
          <p class="subtitle">Hold oversikt over aktive samarbeid mellom dine studenter og bedrifter i Telemark.</p>
        </div>
        <br>
        <div id="larer-group-navn" class="control is-grouped">
          <p class="control is-expanded">
            <span class="placeholder" id="faglarerRegFnavn-jumper">Fornavn</span>
            <input onblur="sjekkFNavn(id, 'faglarer')" onchange="sjekkFNavn(id, 'faglarer')" class="input input-newstyle" name="faglarerRegFnavn" id="faglarerRegFnavn" type="text" placeholder="">
            <span id="faglarer-fnavnErr" class="help is-danger"></span>
          </p>
          <p class="control is-expanded">
            <span class="placeholder" id="faglarerRegEnavn-jumper">Etternavn</span>
            <input onblur="sjekkENavn(id, 'faglarer')" onchange="sjekkENavn(id, 'faglarer')" class="input input-newstyle" name="faglarerRegEnavn" id="faglarerRegEnavn" type="text" placeholder="">
            <span id="faglarer-enavnErr" class="help is-danger"></span>
          </p>
        </div>
        <div class="text-center">
          <a class="button container" id="faglarerStep1To0">
            <span class="icon">
                <i class="fa fa-angle-left"></i>
            </span>
            <span>Tilbake</span>
          </a>

          <a class="button container" id="faglarerStep1To2" onclick="return faglarerValStep1()">
            <span>Gå videre</span>
            <span class="icon">
                <i class="fa fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div id="faglarerStep2" class="hidden">
        <div class="header text-center">
            <p class="title is-4">Skriv in eposten din så sender vi deg videre instrukser</p><br>
        </div>
        <div id="larer-group-epost" class="control is-grouped is-fullwidth">
          <p class="control is-expanded">
            <span class="placeholder" id="faglarerRegEpost-jumper">Din epost</span>
            <input onblur="sjekkEpost(this.value, 'faglarer')" onchange="sjekkEpost(this.value, 'faglarer')" name="faglarerRegEpost" id="faglarerRegEpost" class="input input-newstyle" type="email">
            <span id="faglarerPostError" class="help is-danger"></span><span id="faglarerPostSjekk" class="help is-danger"></span>
          </p>
          <p class="control is-expanded">
            <span class="select input-newstyle is-fullwidth">
              <select name="studsted" id="faglarerRegStudsted">
                <option value="Campus" selected="">Campus</option>
                <option value="Bø">Bø</option>
                <option value="Porsgrunn">Porsgrunn</option>
              </select>
            </span>
            <span id="faglarerCampusError" class="help is-danger"></span>
          </p>
        </div>

        <div class="text-center">
          <a class="button container" id="faglarerStep2To1">
            <span class="icon">
                <i class="fa fa-angle-left"></i>
            </span>
            <span>Tilbake</span>
          </a>

          <input class="button is-success" type="submit" name="registrerBtn-faglarer" value="Opprett konto">
        </div>
      </div>
    </form>
  </div>
</div>
@stop