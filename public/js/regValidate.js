/*                                       */
/*  Funksjoner for "backend" validering  */
/*                                       */

function valNavn(verdi) {
    var ptn = /^[A-Za-z0-9øæåØÆÅ_ ]+( [A-Za-z0-9øæåØÆÅ_ ]+)*$/;
    return ptn.test(verdi);
}

function valStudEpost(verdi) {
    var ptn = /^(([0-9]{6})+@+(student)+.|([a-zA-Z]+.+[a-zA-Z]+@))+(hit|usn|hbv)+.(no)$/;
    return ptn.test(verdi)
}

function valEpost(verdi) {
    var ptn = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return ptn.test(verdi)
}

function valStudpost(verdi) {
    var ptn = /^(([0-9]{6})+@+(student)+.|([a-zA-Z]+.+[a-zA-Z]+@))+(hit|usn|hbv)+.(no)$/;
    return ptn.test(verdi)
}

function valCampus(verdi) {
    return verdi === "Bø" || verdi === "Porsgrunn";
}

function valPassord(verdi) {
    /*
     * RegEx forklart
     * Passordet MÅ inneholde:
     * x antall karakterer mellom a-z (lower case)
     * x antall karakterer mellom a-z (upper case)
     * x antall siffer mellom 0-9
     * All of the above er KRAV. De må til sammen tilsvare en lengde på 6+
     * Det godtaes også noen spesialtegn som (!, @, $, ?, %, *, #, og &). Dise er ikke påkrevet.
     * */
    var ptn = /^(?=.*[a-z])(?=.*[A-Z])(?=.+[0-9])[a-zA-Z0-9-$@!%*?#&,._|="¤()/]{6,}$/;
    return ptn.test(verdi);
}

/*                                    */
/*  Funksjoner for visuel validering  */
/*                                    */
function sjekkFNavn (verdi, type) {
    var errorID = "";
    if (type === "student") {
        errorID = "fnavnErr-ny";
    }

    else if (type === "faglarer") {
        errorID = "faglarer-fnavnErr";
    }
    
    var ptn = /^[A-Za-z0-9øæåØÆÅ_ ]+( [A-Za-z0-9øæåØÆÅ_ ]+)*$/;
    var fnavn = document.getElementById(verdi).value;

    if (fnavn == "") {
        document.getElementById(errorID).innerHTML = "Fornavn kan ikke være blank";
        document.getElementById(verdi).style.borderBottom = 'solid 1px #e35152';
    }
    else {
        if (ptn.test(fnavn)) {
            document.getElementById(errorID).innerHTML = "";
            document.getElementById(verdi).style.borderBottom = 'solid 1px #60bb80';
            return true;
        }
        else {
            document.getElementById(errorID).innerHTML = "Fornavnet har ugyldige karakterer";
            document.getElementById(verdi).style.borderBottom = 'solid 1px #e35152';
        }
    }
}

function sjekkENavn (verdi, type) {
    var errorID = "";
    if (type === "student") {
        errorID = "enavnErr-ny";
    }

    else if (type === "faglarer") {
        errorID = "faglarer-enavnErr";
    }
    
    var ptn = /^[A-Za-z0-9øæåØÆÅ_ ]+( [A-Za-z0-9øæåØÆÅ_ ]+)*$/;
    var enavn = document.getElementById(verdi).value;

    if (enavn == "") {
        document.getElementById(errorID).innerHTML = "Etternavn kan ikke være blank";
        document.getElementById(verdi).style.borderBottom = 'solid 1px #e35152';
    }
    else {
        if (ptn.test(document.getElementById(verdi).value)) {
            document.getElementById(errorID).innerHTML = "";
            document.getElementById(verdi).style.borderBottom = 'solid 1px #60bb80';
            return true;
        }
        else {
            document.getElementById(errorID).innerHTML = "Etternavn har ugyldige karakterer";
            document.getElementById(verdi).style.borderBottom = 'solid 1px #e35152';
        }
    }
}

function sjekksjekkBedNavn (verdi) {
    var ptn = /^[A-Za-z0-9øæåØÆÅ_ ]+( [A-Za-z0-9øæåØÆÅ_ ]+)*$/;
    var enavn = document.getElementById(verdi).value;

    if (enavn == "") {
        document.getElementById("bednavnErr").innerHTML = "Bedriftsnavnet kan ikke være blank";
        document.getElementById(verdi).style.borderBottom = 'solid 1px #e35152';
    }
    else {
        if (ptn.test(document.getElementById(verdi).value)) {
            document.getElementById("bednavnErr").innerHTML = "";
            document.getElementById(verdi).style.borderBottom = 'solid 1px #60bb80';
            return true;
        }
        else {
            document.getElementById("bednavnErr").innerHTML = "Bedriftsnavnet har ugyldige karakterer";
            document.getElementById(verdi).style.borderBottom = 'solid 1px #e35152';
        }
    }
}

function sjekkEpost(epost, type) {
    /*
     * RegEx forklart
     * Enten:    6 på rad mellom 0-9 + "@" + ordet "student" etterfulgt av punktum.
     * Eller:    x antall bokstaver a-z etterfulgt av punktum etterfulgt av x antall bokstaver igjen a-z + "@"
     * Deretter: hit eller usn eller hbn etterfulgt av punktum etterfulgt av "no"
     * */

    var ptn = "";
    var epostID = "";
    var epostSjekk = "";
    var epostErr = "";

    if (type === "bedrift") {
        ptn = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        epostID = "bedRegEpost";
        epostSjekk = "bedpostSjekk";
        epostErr = "bedpostError";
    }

    else if (type === "student") {
        ptn = /^(([0-9]{6})+@+(student)+.|([a-zA-Z]+.+[a-zA-Z]+@))+(hit|usn|hbv)+.(no)$/;
        epostID = "studRegEpost";
        epostSjekk = "studpostSjekk";
        epostErr = "studpostError";
    }

    else if (type === "faglarer") {
        ptn = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        epostID = "faglarerRegEpost";
        epostSjekk = "faglarerPostSjekk";
        epostErr = "faglarerPostError";
    }

    if (epost == 0) {
        document.getElementById(epostErr).innerHTML = "Epost kan ikke være blank";
        document.getElementById(epostID).style.borderBottom = 'solid 1px #e35152';
        return false;
    } else {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(epostSjekk).innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "includes/sjekkinfo.php?epost=" +epost, true);
        xmlhttp.send();

        var resultat = document.getElementById(epostSjekk).innerHTML;

        if (resultat.indexOf("er tatt!") >= 0) {
            document.getElementById(epostErr).innerHTML = "";
            document.getElementById(epostSjekk).style.display = "block";
            document.getElementById(epostID).style.borderBottom = '1px solid #e35152';
            return false;
        }
        else {
            if (resultat.indexOf("er ledig") >= 0) {
                document.getElementById(epostSjekk).style.display = "";
            }

            if (type === "student") {
                if (ptn.test(epost)) {
                    document.getElementById(epostErr).innerHTML = "";
                    document.getElementById(epostID).style.borderBottom = '1px solid #60bb80';
                    return true;
                } else {
                    document.getElementById(epostID).style.borderBottom = '1px solid #e35152';
                    document.getElementById(epostErr).innerHTML = "Eposten må være en gyldig student epost!";
                    return false;
                }
            } else {
                if (ptn.test(epost)) {
                    document.getElementById(epostErr).innerHTML = "";
                    document.getElementById(epostID).style.borderBottom = 'solid 1px #60bb80';
                    return true;
                } else {
                    document.getElementById(epostID).style.borderBottom = 'solid 1px #e35152';
                    document.getElementById(epostErr).innerHTML = "Eposten må være en gyldig epost!";
                    return false;
                }
            }
        }
    }
}

function sjekkPass(verdi) {
    var ptn = /^(?=.*[a-z])(?=.*[A-Z])(?=.+[0-9])[a-zA-Z0-9$@$!%*?&]{6,}$/;

    var pw = document.getElementById(verdi).value;
    if (pw == 0) {
        document.getElementById("passErr").innerHTML = "Passordet kan ikke være blank";
        document.getElementById(verdi).style.border = 'solid 1px #e35152';
    } else {
        if (pw.length < 6) {
            document.getElementById('passErr').innerHTML = "Passordet må ha minst 6 karakterer.";
            document.getElementById(verdi).style.border = 'solid 1px #e35152';
            document.getElementById('passErr').style.display = "block"
        }
        else if (ptn.test(document.getElementById(verdi).value)) {
            document.getElementById("passErr").innerHTML = "";
            document.getElementById(verdi).style.border = 'solid 1px #60bb80';
            return true;
        }
        else {
            document.getElementById('passErr').innerHTML = "Passordet må minst ha en stor bokstav og ett tall. Noen spesielle karakterer kan også gi feilmelding.";
            document.getElementById(verdi).style.border = 'solid 1px #e35152';
            document.getElementById('passErr').style.display = "block";
        }
    }
}

function sjekkPassTo(verdi) {
    var pass1 = document.getElementById('reg-pass').value;
    var pass2 = document.getElementById('reg-pass-two').value;

    if (pass2 == pass1) {
        document.getElementById('passTwoErr').innerHTML = "";
        document.getElementById(verdi).style.border = "solid 1px #60bb80";
        return true;
    } else {
        document.getElementById(verdi).style.border = "solid 1px #e35152";
        document.getElementById('passTwoErr').innerHTML = "Passordene er ikke like!";
    }
}

function studentValStep1() {
    var fornavn = document.getElementById('studRegFnavn').value;
    var etternavn = document.getElementById('studRegEnavn').value;

    var ok = 0;

    if (valNavn(fornavn)) {
        ok += 1;
    }

    if (valNavn(etternavn)) {
        ok += 1;
    }

    if (ok === 2) {
        $("#studentStep2").show();
        $("#studentStep1").hide();
    } else {
        return false;
    }
}

function studentValStep2() {
  var fornavn = document.getElementById('studRegFnavn').value;
  var etternavn = document.getElementById('studRegEnavn').value;
  var epost = document.getElementById('studRegEpost').value;

  var e = document.getElementById("regStudsted");
  var campus = e.options[e.selectedIndex].value;

  var ok = 0;

  if (valNavn(fornavn)) {
    ok += 1;
  }

  if (valNavn(etternavn)) {
    ok += 1;
  }

  if (sjekkEpost(epost, 'student')) {
    ok += 1;
  }

  if (valCampus(campus)) {
      ok +=1;
  } else {
    if (campus == "Campus") {
      document.getElementById("campusError").innerHTML = "Du må velge campus først!";
      $("#regStudsted").css("border-bottom", 'solid 1px #e35152');
    }
  }

  if (ok === 4) {
    return true;
  } else {
    return false;
  }
}

function bedriftValStep1() {
  var bednavn = document.getElementById('bedRegNavn').value;;
  var epost = document.getElementById('bedRegEpost').value;

  var ok = 0;

  if (valNavn(bednavn)) {
    ok += 1;
  }

  if (valEpost(epost)) {
    ok += 1;
  }

  if (ok === 2) {
    $("#bedriftStep2").show();
    $("#bedriftStep1").hide();
  } else {
    return false;
  }
}

function faglarerValStep1() {
  var fornavn = document.getElementById('faglarerRegFnavn').value;
  var etternavn = document.getElementById('faglarerRegEnavn').value;

  var ok = 0;

  if (valNavn(fornavn)) {
    ok += 1;
  }

  if (valNavn(etternavn)) {
    ok += 1;
  }

  if (ok === 2) {
    $("#faglarerStep2").show();
    $("#faglarerStep1").hide();
  } else {
    return false;
  }
}

function faglarerValStep2() {
  var fornavn = document.getElementById('faglarerRegFnavn').value;
  var etternavn = document.getElementById('faglarerRegEnavn').value;
  var epost = document.getElementById('faglarerRegEpost').value;

  var e = document.getElementById("faglarerRegStudsted");
  var campus = e.options[e.selectedIndex].value;

  var ok = 0;

  if (valNavn(fornavn)) {
    ok += 1;
  }

  if (valNavn(etternavn)) {
    ok += 1;
  }

  if (sjekkEpost(epost, 'faglarer')) {
    ok += 1;
  }

  if (valCampus(campus)) {
    ok +=1;
  } else {
    if (campus == "Campus") {
      document.getElementById("faglarerCampusError").innerHTML = "Du må velge campus først!";
      $("#faglarerRegStudsted").parent().css("border-bottom", 'solid 1px #e35152');
    }
  }

  if (ok === 4) {
    return true;
  } else {
    return false;
  }
}

function postRegStep1() {
  var pass1 = document.getElementById("reg-pass").value;
  var pass2 = document.getElementById("reg-pass-two").value;

  if (valPassord(pass1) && valPassord(pass2) && pass1 === pass2) {
    $("#postReg-step1").fadeOut("fast", function () {
      $("#postReg-step2").fadeIn();
    });
  }
}

$("#postRegStudentMore").click(function () {
  $("#postReg-step2").fadeOut("fast", function () {
    $("#postReg-step3").fadeIn();
  });
});

$("#postReg-step3-back").click(function () {
  $("#postReg-step3").fadeOut("fast", function () {
    $("#postReg-step2").fadeIn();
  });
});
$("#postReg-step3-next").click(function () {
  $("#postReg-step3").fadeOut("fast", function () {
    $("#postReg-step4").fadeIn();
  });
});

$("#postReg-step4-back").click(function () {
  $("#postReg-step4").fadeOut("fast", function () {
    $("#postReg-step3").fadeIn();
  });
});
$("#postReg-step4-next").click(function () {
  $("#postReg-step4").fadeOut("fast", function () {
    $("#postReg-step5").fadeIn();
  });
});

$("#postReg-step5-back").click(function () {
  $("#postReg-step5").fadeOut("fast", function () {
    $("#postReg-step4").fadeIn();
  });
});
$("#postReg-step5-next").click(function () {
  $("#postReg-step5").fadeOut("fast", function () {
    $("#postReg-step6").fadeIn();
  });
});

$("#postReg-step6-back").click(function () {
  $("#postReg-step6").fadeOut("fast", function () {
    $("#postReg-step5").fadeIn();
  });
});

// Validerer for nytt passord
// todo: legg til visuell validering
function endrePass() {
  var pass = document.getElementById('reg-pass-ny').value;
  var passTo = document.getElementById('reg-pass-two-ny').value;

  var ok = 0;
  if (valPassord(pass)) {
    ok += 1;
  }

  if (pass === passTo) {
    ok += 1;
  }

  // Hvis alle 2 felter er riktige, send skjema!
  if (ok == 2) {
    return true;
  } else return false;
}
