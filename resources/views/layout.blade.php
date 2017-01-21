<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- These meta tags come first. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HSN Karriere</title>

        <!-- styles -->
        <link rel="stylesheet" href="/css/dist/select2.min.css">
        <link rel="stylesheet" href="/css/dist/fileinput.min.css">
        <link rel="stylesheet" href="/css/dist/font-awesome.min.css">
        <link rel="stylesheet" href="/css/dist/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="/css/app.css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body class="with-top-navbar">
        <div class="growl" id="app-growl"></div>
        @yield('logginn')
        <nav class="navbar navbar-inverse navbar-fixed-top app-navbar">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-main">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">
                        <!-- <img src="../assets/img/brand-white.png" alt="brand"> -->
                        HSN KARRIERE
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbar-collapse-main">

                    <ul class="nav navbar-nav hidden-xs">
                        <li><a href="/">Hjem</a></li>
                        <li><a href="/kalender">Kalender</a></li>
                        <li><a href="/innboks">Innboks</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mer info <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/student">For student</a></li>
                                <li><a href="/bedrift">For bedrift</a></li>
                            </ul>
                        </li>
                    </ul>
                    @if (Auth::Guest())
                        <ul class="nav navbar-nav navbar-right m-r-0 hidden-xs">
                            <li>
                                <a href="#registrer" class="btn-success-outline">
                                    <span class="fa fa-user-plus"></span> Opprett profil
                                </a>
                            </li>
                            <li>
                                <a href="#logginn" data-toggle="modal" data-target="#loggInnModal">
                                    <span class="fa fa-sign-in fa-lg"></span> Logg inn
                                </a>
                            </li>
                        </ul>
                    @else
                        <ul id="popoverNav" class="nav navbar-nav navbar-right m-r-0 hidden-xs">
                          <li>
                            <a class="app-notifications cursor" data-toggle="nfPopover">
                              <span class="icon icon-bell">
                                  <small id="notificationAmount"  style="display: none;" class="pos-a text-center"></small>
                              </span>
                            </a>
                          </li>
                          <li>
                            <button class="btn btn-default navbar-btn navbar-btn-avitar" data-toggle="popover">
                              <img class="img-circle" src="/uploads/{{ $avatar }}"
                                alt="Profilbilde">
                            </button>
                          </li>
                        </ul>

                        <form class="navbar-form navbar-right app-search" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" data-action="grow" placeholder="Søk">
                            </div>
                        </form>
                    @endif

                    <ul class="nav navbar-nav hidden-sm hidden-md hidden-lg">
                        <li><a href="/">Hjem</a></li>
                        <li><a href="/kalender">Kalender</a></li>
                        <li><a href="/innboks">Innboks</a></li>
                        <li><a href="">Mer info</a></li>
                        @if (Auth::guest())
                            <li>
                                <a href="#registrer" class="btn-success-outline">
                                    <span class="fa fa-user-plus"></span> Opprett profil
                                </a>
                            </li>
                            <li>
                                <a href="#logginn" data-toggle="modal" data-target="#loggInnModal">
                                    <span class="fa fa-sign-in fa-lg"></span> Logg inn
                                </a>
                            </li>
                        @else 
                            <li><a href="/bruker">Min profil</a></li>
                            <li><a href="/bruker/rediger">Rediger profil</a></li>
                            <li>
                                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logg ut</a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>   
                        @endif
                    </ul>

                    <!-- Popover submenu -->
                    @unless (Auth::guest())
                      <!-- Notifications popover -->
                      <!-- loads from AJAX -->

                      <!-- Min bruker popover -->
                      <ul class="nav navbar-nav hidden">
                        <li><a href="/bruker"><span class="fa fa-user"></span> Min profil</a></li>
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
                    @endunless
                </div>
            </div>
        </nav>
        
        @yield('content')

        <!-- Footer -->
        <footer class="container text-center">
            <div class="row">
                <div class="col-sm-3">
                    <p class="h3">Samarbeidspartnere</p>
                    <a class="samarbeidspartnere" href="https://usn.no">
                        <img src="/img/usn.png"
                        alt="usn logo">
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