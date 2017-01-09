$(document).ready(function () {
    // Scroller til student, bedrift og foreleser. Setter boksen vertikalt midt i skjermen!.
    $('#index-hvemerdu a').on('click', function(e) {
        e.preventDefault();

        var el = $("#registrer");
        var elOffset = el.offset().top;
        var elHeight = el.height();
        var windowHeight = $(window).height();
        var offset;

        if (elHeight < windowHeight) {
            offset = elOffset - ((windowHeight / 2) - (elHeight / 2));
        }
        else {
            offset = elOffset;
        }

        // alert("height: " + elHeight + " and offset: " + offset + " and windowHeight: " + windowHeight);


        $.smoothScroll({
          speed: 700,
          offset: offset,
          scrollTarget: '#registrer'
        });
    });

    $(".hvemErDuStudent, #hvemErDuStudentA, .hvemErDuBedrift, #hvemErDuBedriftA, .hvemErDuLarer, #hvemErDuLarerA").on('click', function () {
        $(".overlay, .video-overlay").fadeIn(500);
    });
    $("#studentStep1To0, #bedriftStep1To0, #faglarerStep1To0").on('click', function () {
        $(".overlay, .video-overlay").fadeOut(500);
    });

    $(".overlay, .video-overlay").on('click', function () {
        $(".overlay, .video-overlay").fadeOut(500);
        $("#index-student-box").hide();
        $("#index-bedrift-box").hide();
        $("#index-faglarer-box").hide();
        $("#index-hvemerdu").show();
    });

    /* Viser boks for student eller bedrift */
    $("#btns-hvemerdu").on ("click", "a", function () {
        var box = "#" + $(this).attr('class') + "-box";
        $(box).show();
        $(box).siblings().hide();
    });

    /* Student kontrolerer steps 0-2 */
    $("#studentStep1To0").click(function () {
        $("#index-student-box").hide();
        $("#index-hvemerdu").show();
    });

    $("#studentStep2To1").click(function () {
        $("#studentStep2").hide();
        $("#studentStep1").show();
    });

    /* Bedrift kontrolerer steps 0-1 */
    $("#bedriftStep1To0").click(function () {
        $("#index-bedrift-box").hide();
        $("#index-hvemerdu").show();
    });

    /* Bedrift kontrolerer steps 0-2 */
    $("#faglarerStep1To0").click(function () {
        $("#index-faglarer-box").hide();
        $("#index-hvemerdu").show();
    });

    $("#bedriftStep2To1").click(function () {
        $("#bedriftStep2").hide();
        $("#bedriftStep1").show();
    });

    $("#faglarerStep2To1").click(function () {
        $("#faglarerStep2").hide();
        $("#faglarerStep1").show();
    });

    $("#index-hvemerdu-btn, #regBtn").on('click', function(event) {
        if (this.hash !== "") {
            event.preventDefault();

            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){
                window.location.hash = hash;
            });
        }
    });

    $("#regStudsted").on('change', function () {

        if ($("#regStudsted").val() == "Annen") {
            $("#interesse-box").addClass('is-active');
        }
    });

    /* Form Placeholder Jump */
    $(".focusJump input").focus(function () {
        var input = $(this).attr('id');
        var span = "#" + input + "-jumper";
        // alert (span);
        $(span).stop().animate({"margin-top": "-15px", "font-size": "1em"}, 50, "linear");

        $(".focusJump input").blur(function () {
            if ($("#" + input).val() === "") {
                $(span).stop().animate({"margin-top": "15px", "font-size": "1.3em"}, 50, "linear");
            }
        });
    });

    /* jQuery mobile optimizer */
    (function($) {
        $(window).resize(function resize() {
            if ($(window).width() < 514) {
                return $("#larer-group-epost, #larer-group-navn, #bedrift-group, #student-group-navn, #student-group-campus").removeClass('is-grouped');
            }

            $("#larer-group-epost, #larer-group-navn, #bedrift-group, #student-group-navn, #student-group-campus").addClass('is-grouped');
        }).trigger('resize');
    })(jQuery);

    /* Validation Registration */
    
});