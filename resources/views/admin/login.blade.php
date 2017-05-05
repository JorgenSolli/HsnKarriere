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
  <body class="container-fill-height m-b-0">
    <div class="container-content-middle">
      <form role="form" action="/admin/login" method="post" class="m-x-auto text-center app-login-form">

        {{ csrf_field() }}

        <a href="/admin" class="app-brand m-b-lg h4">
          HSN Karriere Admin
        </a>

        <div class="form-group m-t-md">
          <input class="form-control" placeholder="Username">
        </div>

        <div class="form-group m-b-md">
          <input type="password" class="form-control" placeholder="Password">
        </div>

        <div class="row m-b-s">
          <div class="col-lg-6">
            <a href="/" type="submit" class="btn btn-default w-full">
              <span class="fa fa-angle-left"></span> 
              Tilbake
            </a>
          </div>
          <div class="col-lg-6">
            <button type="submit" class="btn btn-primary w-full">
              <span class="fa fa-sign-in"></span> 
              Logg Inn
            </button>
          </div>
        </div>
        <div class="screen-login">
          <a href="#" class="text-muted">Glemt passord</a>
        </div>
      </form>
    </div>
  </body>
</html>