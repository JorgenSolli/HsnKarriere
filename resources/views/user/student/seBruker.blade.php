@extends('layout', ['avatar' => Auth::User()->profilbilde])

@section('content')
<div class="profile-header text-center" style="background-image: url(/uploads/{{ $brukerinfo->forsidebilde }}); ">
  <div class="container-fluid">
    <div class="container-inner">
      <img class="img-circle media-object" src="/uploads/{{ $brukerinfo->profilbilde }}">
      <p class="h3 profile-header-user">{{ $brukerinfo->fornavn }} {{ $brukerinfo->etternavn }}</p>
      @if ($brukerinfo->facebook != "")
        <a href="{{ $brukerinfo->facebook }}" target="_blank" class="p-r-s"><span class="social_icons fa fa-facebook-official fa-2x"></span></a>
      @endif
      @if ($brukerinfo->linkedin != "")
        <a href="{{ $brukerinfo->linkedin }}" target="_blank" class="p-r-s"><span class="social_icons fa fa-linkedin-square fa-2x"></span></a>
      @endif
      @if ($brukerinfo->nettside != "")
        <a href="{{ $brukerinfo->nettside }}" target="_blank"><span class="social_icons fa fa-home fa-2x"></span></a>
      @endif
      <p class="profile-header-bio">Student ved campus {{ $brukerinfo->student_campus }} </p>
    </div>
  </div>
</div>
        
<div class="container">
  @include ('partials/user/student/min-bruker')
</div> {{-- end container --}}

{{-- MODALS --}}
<div id="startSamarbeid" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-handshake-o"></span> Du er i ferd med å initiere et samarbeid med studenten {{ $brukerinfo->fornavn }} {{ $brukerinfo->etternavn }}
        </p>
        <small class="danger-text m-t-xs">Vi minner om at det er viktig å ta kontakt med bedriften før et samarbeid blir forespurt</small>
      </div>
      <form method="POST" action="/bruker/uploads/forsidebilde" enctype="multipart/form-data"> 
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="type">Hva slags type samarbeid er dette?</label>
            <select id="type" name="type" class="form-control">
              <option value="praksis">Praksis</option>
              <option value="bachelor">Bacheloroppgave</option>
              <option value="master">Masteroppgave</option>
            </select>
          </div>
          <div class="form-group">
            <label for="faglarer">Hvilken faglærer skal håndtere dette samarbeidet?</label>
            <select id="faglarer" name="faglarer" class="form-control">
              @foreach ($faglarere as $faglarer)
                <option value="{{ $faglarer->id }}">{{ $faglarer->fornavn }} {{ $faglarer->etternavn }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger pull-left" data-dismiss="modal">Avbryt</button>
          <button type="submit" class="btn btn-success">Forespør samarbeid!</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop
