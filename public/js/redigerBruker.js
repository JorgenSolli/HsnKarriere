$(function () {
    // Select2 load
    $('.select2').select2();

    // Legger til nye rader per studieretning
    $(document).on('change', '#studieretning', function() {
        // Finner studieretningen
        var studie = $("#select2-studieretning-container span").text();
        var campus = $("#studiested").val();
        var studieId = $("#studyId").val();
        // Legger til nye inputfields

        studvalgInput(studieId, studie, campus);

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
    $('.input-group.date.dateDob').datepicker({
      endDate: "today",
      startView: 3,
      maxViewMode: 3,
      format: "dd/mm/yyyy",
      language: "no",
      autoclose: true
    });

    /* Datepicker for Jobs */
    var dateJob = function () {
        $('.input-group.date.dateJob').datepicker({
          startDate: "today",
          startView: 0,
          maxViewMode: 2,
          format: "dd/mm/yyyy",
          language: "no",
          autoclose: true
        });
    } 
    dateJob();

    /* Uploads */
    /* Todo: make sure images (specifically the avatar) are SQARE! Can probably fix this with CSS */
    $('#forsidebilde-input, #profilbilde-input').fileinput({
        language: 'no',
        uploadUrl: '#',
        maxFileSize: 2000,
        allowedFileExtensions : ['jpg', 'png','gif'],
    });

    // See/edit jobs
    $("#listJobs a").on('click', function() {
        var container = $("#listJobs");
        var containerParent = $("#listJobsParent");
        var containerNewContent = $("#listJobsAjax");
        
        var jobBtn = "#" + $(this).attr('id');
        var jobId = jobBtn.slice(6);

        $(jobBtn + ' .edit').removeClass('fa-cog').addClass('fa-circle-o-notch fa-spin');

        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'seeJob/' + jobId, 
            success: function(data) {
                $(".ajaxLoading").remove();
                containerParent.hide();
                containerNewContent.removeClass('hidden').append(data['job']);
                $(jobBtn + ' .edit').removeClass('fa-circle-o-notch fa-spin').addClass('fa-cog');
                dateJob();
            }
        });
    });

    $(document).on('click', '#tilbakeSeeJobs', function () {
        $(".ajaxLoading").remove();
        $("#listJobsAjax div").remove();
        $("#listJobsParent").show();
    });

    // See/edit masters
    $("#listMasters a").on('click', function() {
        var container = $("#listMasters");
        var containerParent = $("#listMastersParent");
        var containerNewContent = $("#listMastersAjax");
        
        var masterBtn = "#" + $(this).attr('id');
        var masterId = masterBtn.slice(9);

        $(masterBtn + ' .edit').removeClass('fa-cog').addClass('fa-circle-o-notch fa-spin');

        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'seeMaster/' + masterId, 
            success: function(data) {
                $(".ajaxLoading").remove();
                containerParent.hide();
                containerNewContent.removeClass('hidden').append(data['assignment']);
                $(masterBtn + ' .edit').removeClass('fa-circle-o-notch fa-spin').addClass('fa-cog');
                dateJob();
            }
        });
    });

    $(document).on('click', '#tilbakeSeeMasters', function () {
        $(".ajaxLoading").remove();
        $("#listMastersAjax div").remove();
        $("#listMastersParent").show();
    });

    // See/edit bachelors
    $("#listBachelors a").on('click', function() {
        var container = $("#listBachelors");
        var containerParent = $("#listBachelorsParent");
        var containerNewContent = $("#listBachelorsAjax");
        
        var bachelorBtn = "#" + $(this).attr('id');
        var bachelorId = bachelorBtn.slice(11);

        $(bachelorBtn + ' .edit').removeClass('fa-cog').addClass('fa-circle-o-notch fa-spin');

        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'seeBachelor/' + bachelorId, 
            success: function(data) {
                $(".ajaxLoading").remove();
                containerParent.hide();
                containerNewContent.removeClass('hidden').append(data['assignment']);
                $(bachelorBtn + ' .edit').removeClass('fa-circle-o-notch fa-spin').addClass('fa-cog');
                dateJob();
            }
        });
    });

    $(document).on('click', '#tilbakeSeeBachelors', function () {
        $(".ajaxLoading").remove();
        $("#listBachelorsAjax div").remove();
        $("#listBachelorsParent").show();
    });

});

function studvalgInput (studieId, studie, campus) {
    var myDate = new Date();
    var year = myDate.getFullYear();
    var datoFra = [];
    var datoTil = [];

    for(var i = 2000; i <= year+1; i++){
        datoFra.push("<option value=" + i + ">" + i + "</option>");
    }

    for(var i = year+5; i >= 2000; i--){
        datoTil.push("<option value=" + i + ">" + i + "</option>");
    }

    var input = '<div class="studieretningValg">' +
        '<input type="hidden" name="studyId[]" value="' + studieId + '">' +
       '<hr>' + 
       '<div class="form-group">' +
         '<input class="form-control disabled" name="study[]" value="' + studie + '">' +
       '</div>' +
       '<div class="form-group">' +
            '<div class="row">' +
                '<div class="col-xs-5 form-group p-r-0">' +
                    '<input class="form-control disabled" name="campus[]" value="' + campus + '">' +
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
                    '<span class="fa fa-close fa-lg cursor danger-color"></span>' +
                    '</span>' +
                '</div>' +
           '</div>' +
        '</div>' +
    '</div';
    $("#studieretningValg").append(input);
}

$(document).ready(function() {
    var campus = function() {
        return $("#studiested").val();
    }

    function formatState (state) {
        if (!state.id) { return state.text; }
        var $state = $(
            '<input type="hidden" id="studyId" value="' + state.id + '"> ' +
            '<span>' + state.study + ' - ' + state.type + '</span>'
        );
        return $state;
    };

    $("#studieretning").select2({
        placeholder: 'Studier for valgt campus',
        ajax: {
            url: '/api/studies',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    campus: campus(),
                    json: true,
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        templateResult: formatState,
        templateSelection: formatState,
        language: "nb",
        theme: "bootstrap"
    });

    $("#studie").select2({
        theme: 'bootstrap'
    });

    $("#email").on('blur', function() {
        var email = $("#email").val();
        $.ajax({
            url: '/api/email',
            method: 'GET',
            data: {
                email: email
            },
            success: function(data) {
                if (data == true) {
                    console.log(data);
                    $("#emailHelper").text('Eposten finnes allerede!')
                    $("#email").css('border-color', '#D64349')
                } else {
                    $("#emailHelper").empty()
                    $("#email").css('border-color', '#d4dbe0')
                }
            }
        });
    });

    $("#postnr").on('keyup', function() {
        var pnr = $("#postnr").val();

        $.ajax({
            url: 'https://api.bring.com/shippingguide/api/postalCode.json',
            method: 'GET',
            data: {
                clientUrl: 'https://hsn-karriere.no',
                pnr: pnr
            },
            success: function(data) {
                $("#poststed").val(data.result);
            }

        })
    });
});