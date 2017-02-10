@section('logginn')

<div id="loggInnModal" class="modal modal-login fade in" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
        <p class="h3 modal-title"><i class="fa fa-sign-in"></i> Logg inn</p>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 social-login-student-row">
            <p class="h4 text-center m-t-0">For studenter/ansatte</p>
            <a href="{{ url('/auth/feide') }}" class="social-login-btn btn btn-feide">
              <i class="fa fa-unlock-alt"></i> Feide
            </a>
          </div>
          <div class="col-md-6 social-login-bedrift-row">
            <p class="h4 text-center m-t-0">For bedrifter</p>
            <a href="{{ url('/auth/github') }}" class="social-login-btn btn btn-github">
              <i class="fa fa-github"></i> Github
            </a>
            <a href="{{ url('/auth/twitter') }}" class="social-login-btn btn btn-twitter">
              <i class="fa fa-twitter"></i> Twitter
            </a>
            <a href="{{ url('/auth/facebook') }}" class="social-login-btn btn btn-facebook">
              <i class="fa fa-facebook"></i> Facebook
            </a>
            <a href="{{ url('/auth/google') }}" class="social-login-btn btn btn-google">
              <i class="fa fa-google"></i> Google
            </a>
            <a href="{{ url('/auth/linkedin') }}" class="social-login-btn btn btn-linkedin">
              <i class="fa fa-linkedin"></i> LinkedIn
            </a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary-outline is-fullwidth" data-dismiss="modal">
          Lukk
        </button>
      </div>
    </div>
  </div>
</div>


{{-- Commenting out old login box. Replaced with social login
<div id="loggInnModal" class="modal modal-login fade in" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
        <p class="h3 modal-title"><i class="fa fa-sign-in"></i> Logg inn</p>
      </div>

      <div class="modal-body">
        <form role="form" method="POST" action="{{ url('/login') }}">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">
                <i class="fa fa-envelope fa-lg"></i>
              </span>
              <input id="email" type="email" class="form-control" name="email" placeholder="Din epost adresse" value="{{ old('email') }}" required autofocus aria-describedby="basic-addon1">
            </div>

            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>

          <div class="m-b-0 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">
                <i class="fa fa-key fa-lg"></i>
              </span>
              <input id="password" type="password" class="form-control" name="password" placeholder="Ditt passord" required autofocus aria-describedby="basic-addon1">
            </div>

            @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
          </div>

          @if ($errors->has('verified'))
            <div class="has-error text-center">
                <span class="help-block">
                  <strong>{{ $errors->first('verified') }}</strong>
                </span>
            </div>
          @endif
          <div class="form-group">
              <a href="{{ url('/auth/github') }}" class="btn btn-github"><i class="fa fa-github"></i> Github</a>
              <a href="{{ url('/auth/twitter') }}" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
              <a href="{{ url('/auth/facebook') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
              <a href="{{ url('/auth/google') }}" class="btn btn-google"><i class="fa fa-google"></i> Google</a>
              <a href="{{ url('/auth/linkedin') }}" class="btn btn-linkedin"><i class="fa fa-linkedin"></i> LinkedIn</a>
          </div> 
        </div>
        <div class="modal-footer">
          <div class="col-md-9">
            <button type="submit" class="btn btn-success is-fullwidth">
              Logg inn
            </button>
            <div class="checkbox custom-control custom-checkbox text-left">
              <label>
                <input type="checkbox" name="remember">
                <span class="custom-control-indicator"></span> Husk Meg
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-danger is-fullwidth" data-dismiss="modal">
              Avbryt
            </button>
            <a class="p-l-0 m-l-0 text-left btn btn-link" href="{{ url('/password/reset') }}">
              Glemt passordet?
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
--}}
@stop