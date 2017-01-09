$(function () {
  
  // Bruker har nettopp forsøkt å nå en side der han/hun ikke har tillgang. Ber brukeren logge seg inn
  if (window.location.hash.substr(1) == "logginn") {
      $("#loggInnModal").modal();
  }

  // Popover for avatar click in nav-menu
  function getRight() {
    return ($(window).width() - ($('[data-toggle="popover"]').offset().left + $('[data-toggle="popover"]').outerWidth()))
  }

  $(window).on('resize', function () {
    var instance = $('[data-toggle="popover"]').data('bs.popover')
    if (instance) {
      instance.options.viewport.padding = getRight()
    }
  })

  if ($("#popoverNav").length) {
    $('[data-toggle="popover"]').popover({
      template: '<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-content p-x-0"></div></div>',
      title: '',
      html: true,
      trigger: 'manual',
      placement:'bottom',
      viewport: {
        selector: 'body',
        padding: getRight()
      },
      content: function () {
        var $nav = $('.app-navbar .navbar-nav:last-child').clone()
        return '<div class="nav nav-stacked" style="width: 200px">' + $nav.html() + '</div>'
      }
    })
  
    $('[data-toggle="popover"]').on('click', function (e) {
      e.stopPropagation()

      if ($('[data-toggle="popover"]').data('bs.popover').tip().hasClass('in')) {
        $('[data-toggle="popover"]').popover('hide')
        $(document).off('click.app.popover')

      } else {
        $('[data-toggle="popover"]').popover('show')

        setTimeout(function () {
          $(document).one('click.app.popover', function () {
            $('[data-toggle="popover"]').popover('hide')
          })
        }, 1)
      }
    })
  }

})

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