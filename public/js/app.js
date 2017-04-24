$(function () {
  // Notification with timerCheck
  // Function for notifying user when a new event happens
  var checkNewEvents = function () {
    $.ajax({
      methor: 'GET',
      url: '/notification/check',
      success: function (data) {
        if (data['data'] != 0) {
          $("#notificationAmount").show().html(data['data']);
        }
      }
    });
  }
  checkNewEvents(); // On load
  setInterval(checkNewEvents(), 10000); //Re-check every 10 seconds


  // This function is called whenever the used OPENS the popover.
  var checkNotifications = function () {
    var data = "<div class='text-center'><span class='fa fa-circle-o-notch fa-spin fa-2x'></span></div>";
    $.ajax({
      method: 'GET',
      url: '/notification',
      success: function (data) {
        data = $("#notification-data").html(data['data']);
      }
    });
    return data;
  }

  // Popover for avatar click in nav-menu
  function getRight(popover) {
    return ($(window).width() - ($('[data-toggle="' + popover + '"]').offset().left + $('[data-toggle="' + popover + '"]').outerWidth()))
  }

  $(window).on('resize', function () {
    var instance = $('[data-toggle="nfPopover"]').data('bs.popover')
    if (instance) {
      instance.options.viewport.padding = getRight("nfPopover")
    }
  })

  // Bruker har nettopp forsøkt å nå en side der han/hun ikke har tillgang. Ber brukeren logge seg inn
  if (window.location.hash.substr(1) == "logginn") {
      $("#loggInnModal").modal();
  }

  $(window).on('resize', function () {
    var instance = $('[data-toggle="popover"]').data('bs.popover')
    if (instance) {
      instance.options.viewport.padding = getRight("popover")
    }
  })

  // Notification popover
  if ($("#notifications").length) {
    $('[data-toggle="nfPopover"]').popover({
      template: '<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-content p-x-0"></div></div>',
      title: '',
      html: true,
      trigger: 'manual',
      placement:'bottom',
      viewport: {
        selector: 'body',
        padding: getRight("nfPopover")
      },
      content: function () {
        return '<div id="notification-data" class="nav nav-stacked" style="width: 260px">' + checkNotifications() + '</div>'
      }
    })
  
    $('[data-toggle="nfPopover"]').on('click', function (e) {
      e.stopPropagation()

      if ($('[data-toggle="nfPopover"]').data('bs.popover').tip().hasClass('in')) {
        $('[data-toggle="nfPopover"]').popover('hide')
        $(document).off('click.app.popover')

      } else {
        $('[data-toggle="nfPopover"]').popover('show')

        setTimeout(function () {
          $(document).one('click.app.popover', function () {
            $('[data-toggle="nfPopover"]').popover('hide')
          })
        }, 1)
      }
    })
  }

  // Menu items popover
  if ($("#nav-items").length) {
    $('[data-toggle="popover-menu"]').popover({
      template: '<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-content p-x-0"></div></div>',
      title: '',
      html: true,
      trigger: 'manual',
      placement:'bottom',
      viewport: {
        selector: 'body'
      },
      content: function () {
        var $nav = $('#nav-items-data').clone()
        return '<div class="nav nav-stacked" style="width: 200px">' + $nav.html() + '</div>'
      }
    })
  
    $('[data-toggle="popover-menu"]').on('click', function (e) {
      e.stopPropagation()

      if ($('[data-toggle="popover-menu"]').data('bs.popover').tip().hasClass('in')) {
        $('[data-toggle="popover-menu"]').popover('hide')
        $(document).off('click.app.popover')

      } else {
        $('[data-toggle="popover-menu"]').popover('show')

        setTimeout(function () {
          $(document).one('click.app.popover', function () {
            $('[data-toggle="popover-menu"]').popover('hide')
          })
        }, 1)
      }

      // Menu sub-items popover
      $('[data-toggle="popover-mer-info"]').popover({
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-content p-x-0"></div></div>',
        title: '',
        html: true,
        trigger: 'manual',
        placement:'right',
        viewport: {
          selector: 'body'
        },
        content: function () {
          var $subnav = $('#nav-mer-info-data').clone()
          return '<div class="nav nav-stacked" style="width: 200px">' + $subnav.html() + '</div>'
        }
      })
    
      $(document).on('click', '[data-toggle="popover-mer-info"]', function(e) {
        e.stopPropagation()

        $('[data-toggle="popover-mer-info"]').popover('show')

        setTimeout(function () {
          $(document).one('click.app.popover', function () {
            $('[data-toggle="popover-mer-info"]').popover('hide')
          })
        }, 1)
      })
    })
  }

  // Logg inn popover
  if ($("#logg-inn").length) {
    $('[data-toggle="logg-inn-popover"]').popover({
      template: '<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-content p-x-0"></div></div>',
      title: '',
      html: true,
      trigger: 'manual',
      placement:'bottom',
      viewport: {
        selector: 'body',
        padding: getRight("logg-inn-popover")
      },
      content: function () {
        var $nav = $('#logg-inn-popover-data').clone()
        return '<div class="nav nav-stacked" style="width: 200px">' + $nav.html() + '</div>'
      }
    })
  
    $('[data-toggle="logg-inn-popover"]').on('click', function (e) {
      e.stopPropagation()

      if ($('[data-toggle="logg-inn-popover"]').data('bs.popover').tip().hasClass('in')) {
        $('[data-toggle="logg-inn-popover"]').popover('hide')
        $(document).off('click.app.popover')

      } else {
        $('[data-toggle="logg-inn-popover"]').popover('show')

        setTimeout(function () {
          $(document).one('click.app.popover', function () {
            $('[data-toggle="logg-inn-popover"]').popover('hide')
          })
        }, 1)
      }
    })
  }

  // User menu popover
  if ($("#notifications").length) {
    $('[data-toggle="user-popover"]').popover({
      template: '<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-content p-x-0"></div></div>',
      title: '',
      html: true,
      trigger: 'manual',
      placement:'bottom',
      viewport: {
        selector: 'body',
        padding: getRight("user-popover")
      },
      content: function () {
        var $nav = $('#user-popover-data').clone()
        return '<div class="nav nav-stacked" style="width: 200px">' + $nav.html() + '</div>'
      }
    })
  
    $('[data-toggle="user-popover"]').on('click', function (e) {
      e.stopPropagation()

      if ($('[data-toggle="user-popover"]').data('bs.popover').tip().hasClass('in')) {
        $('[data-toggle="user-popover"]').popover('hide')
        $(document).off('click.app.popover')

      } else {
        $('[data-toggle="user-popover"]').popover('show')

        setTimeout(function () {
          $(document).one('click.app.popover', function () {
            $('[data-toggle="user-popover-data"]').popover('hide')
          })
        }, 1)
      }
    })
  }
})

$(document).ready(function() {
  // Mare SURE the user wants to do this action
  $(document).on('click', '.submitBtn', function(e) {
    var form = $(this).closest('form');
    var msg  = $(form).children('.confirmMsg').val();

    bootbox.confirm({
      size: 'small',
      message: '<p class="h4">' + msg + '<p>',
      buttons: {
        confirm: {
          label: 'Jeg er sikker',
          className: 'btn-success'
        },
        cancel: {
          label: 'Avbryt',
          className: 'btn-danger'
        }
      },
      callback: function(result) {
        if (result) {
          form.submit();
        }
      }
    });
  });
});

// Grow search bar (nav)
$(document).on('click', '[data-action=growl]', function (e) {
  e.preventDefault()

  $('#app-growl').append(
    '<div class="alert alert-dark alert-dismissible fade in" role="alert">'+
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
        '<span aria-hidden="true">×</span>'+
      '</button>'+
      '<p>Click the x on the upper right to dismiss this little thing. Or click growl again to show more growls.</p>'+
    '</div>'
  )
})

$(document).on('focus', '[data-action="grow"]', function () {
  if ($(window).width() > 1000) {
    $(this).animate({
      width: 300
    })
  }
})

$(document).on('blur', '[data-action="grow"]', function () {
  if ($(window).width() > 1000) {
    var $this = $(this).animate({
      width: 180
    })
  }
})