$(function () {
    // Legger til nye rader per studieretning
    $("#studieretning").on('change', function () {
        // Finner studieretningen
        var val = $("#studieretning").val();

        // Legger til nye inputfields
        studvalgInput(val);

        var myDate = new Date();
        var year = myDate.getFullYear();
    });

    $(document).on('click', '.slettRad', function () {
        // Slette value og fjerner feltet
        $(this).closest('.studieretningValg').empty().hide(); 
    });

    /* Nytt/endre forsidebilde */
    function forsidebildeBtn() {
        var container = "#nyttForsidebilde";
        var txt = "#nyttForsidebilde small";
        var btn = "#nyttForsidebilde span";

        /* Viser */
        $(document).on('mouseover', '#forsidebildeContainer, #nyttForsidebilde', function() {
            $(txt).stop().fadeIn(100);
            $(container).addClass("imgBtn");
            $(btn).removeClass("fa-lg");
        });
        /* Skjuler */
        $(document).on('mouseout', '#forsidebildeContainer, #nyttForsidebilde', function() {
            $(txt).stop().fadeOut(150);
            $(container).removeClass("imgBtn");
            $(btn).addClass("fa-lg");
        });
    }
    forsidebildeBtn();

    /* Nytt/endre profilbilde */
    /* Todo: Fix the lenghty clickable space the the image produces! */
    function profilbildeBtn() {
        var btn = "#nyttProfilbilde";
        /* Viser */
        $(document).on('mouseover', '#profilbildeContainer, #nyttProfilbilde', function() {
            $(btn).stop().fadeIn(100);
        });
        /* Skjuler */
        $(document).on('mouseout', '#_profilbildeContainer > *', function() {
            $(btn).stop().fadeOut(150);
        });
    }
    profilbildeBtn();

    /* Datepicker for DOB */
    $('.input-group.date').datepicker({
      endDate: "today",
      startView: 3,
      maxViewMode: 3,
      format: "dd/mm/yyyy",
      language: "no",
      autoclose: true
    });

    /* Uploads */
    /* Todo: make sure images (specifically the avatar) is SQARE! Can probably fix this with CSS */
    $('#forsidebilde-input, #profilbilde-input').fileinput({
        language: 'no',
        uploadUrl: '#',
        maxFileSize: 2000,
        allowedFileExtensions : ['jpg', 'png','gif'],
    });

});

function studvalgInput (studretning) {
    var myDate = new Date();
    var year = myDate.getFullYear();
    var datoFra = [];
    var datoTil = [];
    // For later use;
    var currStudSted = $('#studiested').val();

    for(var i = 2000; i <= year+1; i++){
        datoFra.push("<option value=" + i + ">" + i + "</option>");
    }

    for(var i = year+5; i >= 2000; i--){
        datoTil.push("<option value=" + i + ">" + i + "</option>");
    }

    var input = '<div class="studieretningValg">' +
       '<hr>' + 
       '<div class="form-group">' +
         '<input class="form-control" name="student_studerer[]" value="' + studretning + '">' +
       '</div>' +
       '<div class="form-group">' +
            '<div class="row">' +
                '<div class="col-xs-5 form-group p-r-0">' +
                    '<select class="form-control" name="campus[]">' +
                        '<option selected disabled>Campus</option>' +
                        '<option value="Bø">Campus Bø</option>' +
                        '<option value="Porsgrunn">Campus Notodden</option>' +
                    '</select>' +
                '</div>' +
                '<div class="col-xs-3 form-group p-r-0">' +
                    '<select class="form-control" name="datoFra[]" class="datoFra">' +
                        '<option selected disabled>Fra</option>' +
                        datoFra + 
                    '</select>' +
                '</div>' +
                '<div class="col-xs-3 form-group">' +
                    '<select class="form-control" name="datoTil[]" class="datoTil">' +
                        '<option selected disabled>Til</option>' +
                        datoTil + 
                    '</select>' +
                '</div>' +
                '<div class="col-xs-1">' +
                    '<span class="slettRad scaryRed-color">' +
                    '<span class="fa fa-close fa-lg cursor"></span>' +
                    '</span>' +
                '</div>' +
           '</div>' +
        '</div>' +
    '</div';
    $("#studieretningValg").append(input);
}