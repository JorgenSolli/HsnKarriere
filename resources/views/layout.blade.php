<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- These meta tags come first. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HSN Karriere</title>

    {{-- Pace loading --}}
    <script src="/js/dist/pace.min.js"></script>
    <link rel="stylesheet" href="/css/pace.css">

    <script>
      paceOptions = {
        elements: true,
        restartOnPushState: false,
        restartOnRequestAfter: false
      }
    </script>

    <!-- styles -->
    <link rel="stylesheet" href="/css/dist/slim.min.css">
    <link rel="stylesheet" href="/css/dist/select2/select2.min.css">
    <link rel="stylesheet" href="/css/dist/select2/select2-bootstrap.css">
    <link rel="stylesheet" href="/css/dist/fileinput.min.css">
    <link rel="stylesheet" href="/css/dist/font-awesome.min.css">
    <link rel="stylesheet" href="/css/dist/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/css/app.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
      window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
      ]) !!};
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  </head>
  <body>
    @include('notifications.notifications')
    <div class="growl" id="app-growl"></div>
    @yield('logginn')
    <nav class="navbar app-navbar">
      <div class="container">
        <div class="row">
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <ul id="nav-items" class="nav navbar-nav">
              <li>
                <a class="nav-menu-bars" data-toggle="popover-menu">
                  <span class="fa fa-bars"></span>
                  <span class="bars-text">Meny</span>
                </a>
              </li>
            </ul>
          </div>

          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
            <ul class="nav navbar-nav nav-logo-ul">
              <li>
                <a class="nav-logo h3" href="/">
                  HSN <span class="hidden-xs">KARRIERE</span>
                </a>
              </li>
            </ul>
          </div>

          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            @if (Auth::Guest())
              <ul id="logg-inn" class="nav navbar-nav navbar-right m-r-0 hidden-xs">
                <li>
                  <a class="cursor" data-toggle="logg-inn-popover">
                    <span class="fa fa-user-circle fa-lg"></span> Logg inn
                  </a>
                </li>
              </ul>

              <!-- Logg inn popover -->
              <ul id="logg-inn-popover-data" class="nav navbar-nav hidden">
                <li><a href="/auth/facebook"><span class="fa fa-graduation-cap"></span> Som student</a></li>
                <li><a class="cursor" data-toggle="modal" data-target="#loggInnModal-bedrift"><span class="fa fa-building-o"></span> Som bedrift</a></li>
                <li><a href="/auth/github"><span class="fa fa-user"></span> Som foreleser</a></li>
              </ul>

              <div id="loggInnModal-bedrift" class="modal modal-login fade in" role="dialog">
                <div class="modal-dialog">

                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
                      <p class="h3 modal-title"><i class="fa fa-sign-in"></i> Logg inn som bedrift</p>
                    </div>

                    <div class="modal-body">
                      <a href="/auth/google" class="social-login-btn btn btn-google">
                        <i class="fa fa-google"></i> Google
                      </a>
                      <a href="/auth/linkedin" class="social-login-btn btn btn-linkedin">
                        <i class="fa fa-linkedin"></i> LinkedIn
                      </a>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary-outline is-fullwidth" data-dismiss="modal">
                        Lukk
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            @else
              <ul id="notifications" class="nav navbar-nav navbar-right m-r-0">
                <li>
                  <a class="app-notifications cursor" data-toggle="nfPopover">
                    <span class="icon icon-bell">
                      <small id="notificationAmount"  style="display: none;" class="pos-a text-center"></small>
                    </span>
                  </a>
                </li>
                <li>
                  <button class="btn btn-default navbar-btn navbar-btn-avitar" data-toggle="user-popover">
                    <img class="img-circle" src="/uploads/{{ $avatar }}"
                      alt="Profilbilde">
                  </button>
                </li>
              </ul>

              <!-- Popover submenu -->
              <!-- Notifications popover -->
              <!-- loads from AJAX -->

              <!-- Min bruker popover -->
              <ul id="user-popover-data" class="nav navbar-nav hidden">
                <li><a href="/bruker"><span class="fa fa-user"></span> Min profil</a></li>
                <li><a href="/innboks"><span class="fa fa-inbox"></span> Innboks</a></li>
                <li><a href="/oversikt"><span class="fa fa-tasks"></span> Min oversikt</a></li>
                <li><a href="/bruker/rediger"><span class="fa fa-cog"></span> Rediger profil</a></li>
                <li>
                  <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-popover').submit();">
                    <span class="fa fa-sign-out"></span> Logg ut
                  </a>
                  <form id="logout-form-popover" action="{{ url('/logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            @endif
          </div>
        </div>
      </div>

      <ul id="nav-items-data" class="nav navbar-nav hidden">
        <li><a href="/">Hjem</a></li>
        <li><a href="">Mer info</a></li>
      </ul>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="text-center">
      <section class="container">
        <div class="row">
          <div class="col-sm-3">
            <p class="h3">Samarbeidspartnere</p>
            <a class="samarbeidspartnere" href="https://usn.no">
              <img src="/img/usn.png" alt="usn logo">
            </a>
          </div>
          <div class="col-sm-3">
            <p class="h3">Bidragsytere</p>
            <div>
              <a class="bidragsytere" href="http://www.mtnu.no/"><img class="mar-bot-sm" src="/img/MTNU_Logo.svg" alt="MTNU"></a>
              <a class="bidragsytere" href="http://vig.no/"><img src="/img/VIG_Logo.svg" alt="VIG"></a>
            </div>
          </div>
          <div class="col-sm-3">
            <p class="h3">Kontakt</p>
            <p class="wrap">admin@studentsamarbeid.no</p>
            <a href="https://www.facebook.com/LinkTelemark/" class="no_link">
                <i class="fa fa-facebook-official fa-2x"></i>
            </a>
          </div>
          <div class="col-sm-3">
            <p class="h3">Support</p>
            <p><a href="https://www.studentsamarbeid.no/personvern">Personvern</a></p>
            <p><a href="https://www.studentsamarbeid.no/cookies">Bruk av cookies</a></p>
          </div>
        </div> <!-- end footer.row -->
        <hr>
        <div class="text-center">
            <p>Utviklet av <a href="https://jorgensolli.no">Jørgen Solli</a></p>
        </div>
      </section>
    </footer>
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/dist/bootstrap-datepicker.min.js"></script>
    <script src="/js/dist/toolkit.min.js"></script>
    <script src="/js/dist/jquery.smooth-scroll.js"></script>
    <script src="/js/dist/select2/select2.full.min.js"></script>
    <script src="/js/dist/select2/i18n/nb.js"></script>
    <script src="/js/dist/fileinput.min.js"></script>
    <script src="/js/dist/locales/no.js"></script>
    <script src="/js/app.js"></script>
    @yield('script')
  </body>
</html>