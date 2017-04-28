<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('fornavn') ? ' has-error' : '' }}">
          <label for="fornavn" class="col-md-4 control-label">Fornavn</label>

          <div class="col-md-6">
            <input id="fornavn" type="text" class="form-control" name="fornavn" value="{{ old('fornavn') }}" required autofocus>

            @if ($errors->has('fornavn'))
              <span class="help-block">
                <strong>{{ $errors->first('fornavn') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('etternavn') ? ' has-error' : '' }}">
          <label for="fornavn" class="col-md-4 control-label">Etternavn</label>

          <div class="col-md-6">
            <input id="etternavn" type="text" class="form-control" name="etternavn" value="{{ old('etternavn') }}" required autofocus>

            @if ($errors->has('etternavn'))
              <span class="help-block">
                <strong>{{ $errors->first('etternavn') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">E-post Adrese</label>

          <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Passord</label>

          <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label for="password-confirm" class="col-md-4 control-label">Bekreft Passord</label>

          <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
            <button id="form-back" class="btn btn-default">
              <span class="fa fa-angle-left"></span> Tilbake
            </button>
            <button type="submit" class="btn btn-primary">
              <span class="fa fa-check"></span> Registrer
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>