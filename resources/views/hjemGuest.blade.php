@extends('layout')

@section('content')
    @if (Auth::guest())
        @extends('auth.login')
        <div class="hero is-fullheight video">
            <div class="overlay"></div>
            <div class="hero-video">
                <div class="video-overlay"></div>
                <video poster="img/velkommen-bg-mobile.jpg" id="bgvid" playsinline="" autoplay="" muted="" loop="">
                    <source src="img/BGvid.webm" type="video/webm">
                    <source src="img/BGvid.mp4" type="video/mp4">
                </video>
            </div>
            <div class="container hero-body">
                <div class="headerTitle">
                    <div class="textbox">
                        <h1>Velkommen til <br>Studentsamarbeid.no</h1>
                        <hr align="left" class="is-hidden-mobile">
                        <h3>Møteplassen mellom din bedrift og <br>studenter fra Høgskolen i Sørøst-Norge</h3>
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

        <div id="registrer" class="shadow hvemErDu">
            <div class="registrer-container">  
                <!-- Hvem er du? -->
                <div id="index-hvemerdu" style="display: block;">
                    <div class="text-center">
                        <p class="h1 opprettTitle">Opprett din profil</p>
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
                                        <span class="placeholder" id="studRegFnavn-jumper" style="font-size: 1.3em; margin-top: 15px;">Fornavn</span>
                                        <input onblur="sjekkFNavn(id, 'student')" onchange="sjekkFNavn(id, 'student')" class="form-control input-newstyle" name="studRegFnavn" id="studRegFnavn" type="text" placeholder="" style="background-repeat: repeat; background-image: none; background-position: 0% 0%; border-bottom: 1px solid rgb(227, 81, 82);">
                                        <span id="fnavnErr-ny" class="help is-danger">Fornavn kan ikke være blank</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="placeholder" id="studRegEnavn-jumper" style="font-size: 1.3em; margin-top: 15px;">Etternavn</span>
                                        <input onblur="sjekkENavn(id, 'student')" onchange="sjekkENavn(id, 'student')" class="form-control input-newstyle" name="studRegEnavn" id="studRegEnavn" type="text" placeholder="" style="background-repeat: repeat; background-image: none; background-position: 0% 0%; border-bottom: 1px solid rgb(227, 81, 82);">
                                        <span id="enavnErr-ny" class="help is-danger">Etternavn kan ikke være blank</span>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a class="button container" id="studentStep1To0">
                                        <span class="icon">
                                            <i class="fa fa-angle-left"></i>
                                        </span>
                                        <span>Tilbake</span>
                                    </a>

                                    <a class="button container" id="studentStep1To2" onclick="return studentValStep1()">
                                        <span>Gå videre</span>
                                        <span class="icon">
                                            <i class="fa fa-angle-right"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>

                            <div id="studentStep2" class="hidden">
                                <div class="header text-center">
                                    <p class="title is-4">Skriv in eposten din så sender vi deg videre instrukser</p><br>
                                </div>
                                <div id="student-group-campus" class="control is-grouped is-fullwidth">
                                    <p class="control is-expanded">
                                        <span class="placeholder" id="studRegEpost-jumper">studnr@student.hit.no</span>
                                        <input onblur="sjekkEpost(this.value, 'student')" onchange="sjekkEpost(this.value, 'student')" name="studRegEpost" id="studRegEpost" class="input input-newstyle" type="email">
                                        <span id="studpostError" class="help is-danger"></span><span id="studpostSjekk" class="help is-danger"></span>
                                    </p>
                                    <p class="control is-expanded">
                                        <span class="select input-newstyle is-fullwidth">
                                            <select name="studsted" id="regStudsted">
                                                <option value="Campus" selected="">Campus</option>
                                                <option value="Bø">Bø</option>
                                                <option value="Porsgrunn">Porsgrunn</option>
                                                <option value="Annen">Annen</option>
                                            </select>
                                        </span>
                                        <span id="campusError" class="help is-danger"></span>
                                    </p>
                                </div>

                                <div class="text-center">
                                    <a id="studentStep2To1" class="button container">
                                        <span class="icon">
                                            <i class="fa fa-angle-left"></i>
                                        </span>
                                        <span>Tilbake</span>
                                    </a>

                                    <input type="submit" name="registrerBtn-student" class="button is-success" value="Opprett konto">
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
                                    <!--<img class="regStepImg" src="img/registerProcess.png">-->
                                </div>
                                <br>
                                <div id="bedrift-group" class="control is-grouped">
                                    <p class="control is-expanded">
                                        <span class="placeholder" id="bedRegNavn-jumper">Bedriftsnavn </span>
                                        <input onblur="sjekksjekkBedNavn(id)" onchange="sjekksjekkBedNavn(id)" class="input input-newstyle" name="bedRegNavn" id="bedRegNavn" type="text" placeholder="">
                                        <span id="bednavnErr" class="help is-danger"></span>
                                    </p>
                                    <p class="control is-expanded">
                                        <span class="placeholder" id="bedRegEpost-jumper">Bedriftsmail </span>
                                        <input onblur="sjekkEpost(this.value, 'bedrift')" onchange="sjekkEpost(this.value, 'bedrift')" class="input input-newstyle" name="bedRegEpost" id="bedRegEpost" type="text" placeholder="">
                                        <span id="bedpostError" class="help is-danger"></span><span id="bedpostSjekk" class="help is-danger"></span>
                                    </p>
                                </div>
                                <div class="text-center">
                                    <a class="button container" id="bedriftStep1To0">
                                        <span class="icon">
                                            <i class="fa fa-angle-left"></i>
                                        </span>
                                        <span>Tilbake</span>
                                    </a>

                                    <a class="button container" id="bedriftStep1To2" onclick="return bedriftValStep1()">
                                        <span>Gå videre</span>
                                        <span class="icon">
                                            <i class="fa fa-angle-right"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>

                            <div id="bedriftStep2" class="hidden">
                                <div class="header text-center">
                                    <p class="title is-4">Tilhører du en avdeling?</p><br>
                                </div>
                                <div class="control is-grouped is-fullwidth">
                                    <span class="placeholder" id="bedRegAvd-jumper">Har bedriften din avdeliger? Hvis ikke, la være blank. </span>
                                    <input name="bedRegAvd" id="bedRegAvd" type="text" class="input input-newstyle" placeholder="">
                                </div>

                                <div class="text-center">
                                    <a id="bedriftStep2To1" class="button container">
                                        <span class="icon">
                                            <i class="fa fa-angle-left"></i>
                                        </span>
                                        <span>Tilbake</span>
                                    </a>

                                    <input type="submit" name="registrerBtn-bedrift" id="registrerBtn-bedrift" class="button is-success" value="Opprett konto">
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

                                    <a class="button container" id="studentStep1To2" onclick="return faglarerValStep1()">
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
    @endif
@stop

@section('script')
    <script src="js/hjem.js"></script>
@stop