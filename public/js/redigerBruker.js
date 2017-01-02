// Legger til nye rader per studieretning
$("#studieretning").on('change', function () {
    var val = $("#studieretning").val();

    $("#studieretningValg").append('<div class="studieretningValg control flex-form">' +
        '<p class="control is-expanded">' +
        '<input class="input is-disabled" type="text" value="' + val + '">' +
        '<input type="hidden" name="studretning[]" value="' + val + '">' +
        '</p>' +
        '<span class="select control">' +
        '<select name="campus[]">' +
        '<option disabled selected>Campus</option>' +
        '<option value="Campus Bø">Bø</option>' +
        '<option value="Campus Porsgrunn">Porsgrunn</option>' +
        '</select>' +
        '</span>' +
        '<span class="control select">' +
        '<select name="datoFra[]" class="datoFra">' +
        '<option disabled selected>Fra</option>' +
        '</select>' +
        '</span>' +
        '<span class="select control">' +
        '<select name="datoTil[]" class="datoTil">' +
        '<option disabled selected>Til</option>' +
        '</select>' +
        '</span>' +
        '<span onclick="return slettRad(this)" class="icon slettRad scaryRed-color">' +
        '<i class="fa fa-close pointer"></i>' +
        '</span>' +
        '</div>'
    );

    var myDate = new Date();
    var year = myDate.getFullYear();

    for(var i = 2000; i <= year+1; i++){
        $("#studieretningValg .datoFra").append("<option value=" + i + ">" + i + "</option>");
    }

    for(var i = year+5; i >= 2000; i--){
        $("#studieretningValg .datoTil").append("<option value=" + i + ">" + i + "</option>");
    }
    $(".studieretningValg:last-child").fadeIn(150).fadeOut(150).fadeIn(150).fadeOut(150).fadeIn(150).fadeOut(150).fadeIn(150);
});

function slettRad(value) {
    $(value).parent().empty(); // Slette value
    $(value).parent().hide(); // Skjuler raden
}