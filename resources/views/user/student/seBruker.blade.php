@extends('layout', ['avatar' => Auth::User()->profilbilde])

@section('content')
<div class="profile-header text-center" style="background-image: url(/uploads/{{ $brukerinfo->forsidebilde }}); ">
  <div class="container-fluid">
    <div class="container-inner">
      <img class="img-circle media-object" src="/uploads/{{ $brukerinfo->profilbilde }}">
      <p class="h3 profile-header-user">{{ $brukerinfo->fornavn }} {{ $brukerinfo->etternavn }}</p>
      @if ($brukerinfo->facebook != "")
        <a href="{{ $brukerinfo->facebook }}" class="p-r-s"><span class="social_icons fa fa-facebook-official fa-2x"></span></a>
      @endif
      @if ($brukerinfo->linkedin != "")
        <a href="{{ $brukerinfo->linkedin }}" class="p-r-s"><span class="social_icons fa fa-linkedin-square fa-2x"></span></a>
      @endif
      @if ($brukerinfo->nettside != "")
        <a href="{{ $brukerinfo->nettside }}"><span class="social_icons fa fa-home fa-2x"></span></a>
      @endif
      <p class="profile-header-bio">Student ved campus {{ $brukerinfo->student_campus }} </p>
    </div>
  </div>
</div>
        
<div class="container">
  <div class="row m-t">
    <div class="col-sm-5 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-file-text-o"></span> Bio</p>
        <p>{{ $brukerinfo->bio }}</p>
      </div>
    </div>
    <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-8 p-r-s p-l-s">
          <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
            <p class="h4"><span class="fa fa-graduation-cap"></span> Studerer/studerte</p>
            @unless ($student_studerer == "")
              @foreach ($student_studerer as $studerer)
                <p>{{ $studerer->studie }} ved {{ $studerer->campus }} fra {{$studerer->fra }} til {{ $studerer->til }}</p>
              @endforeach
            @else
              <p>Ingen studier spesifisert</p>
            @endunless
          </div>
        </div>
        <div class="col-sm-4 p-r-s p-l-s">
          <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
            <p class="h4"><span class="fa fa-phone"></span> Telefon</p>
            <p>{{ $brukerinfo->telefon }}</p>
          </div>
        </div>
      </div> {{-- row studerte og telefon --}}
      <div class="row">
        <div class="col-sm-6 p-r-s p-l-s">
          <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
            <p class="h4"><span class="fa fa-envelope-o"></span> Epost</p>
            <p>{{ $brukerinfo->email }}</p>
          </div>
        </div>
        <div class="col-sm-6 p-r-s p-l-s">
          <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
            <p class="h4"><span class="fa fa-home"></span> Adresse</p>
            <p>{{ $brukerinfo->adresse }}, {{ $brukerinfo->postnr }}, {{ $brukerinfo->poststed }}</p>
          </div>
        </div>
      </div> {{-- row (epost og adresse) --}}
    </div> {{-- col-sm-6 --}}
  </div>

  <div class="row">
  {{-- 
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-calendar"></span> Fødselsdato</p>
        <p>{{ $brukerinfo->dob }}</p>
      </div>
    </div>
  --}}
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="/uploads/{{-- $brukerinfo->student_cv --}}" class="a-no-dec" style="width: 100%" data-toggle="modal" data-target="#seAttester">
        <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
          <span class="fa fa-file-pdf-o fa-2x"></span>
          <p class="h4 m-t-xs m-b-0">Se attester</p>
        </div>
      </a>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="/uploads/{{-- $brukerinfo->student_cv --}}" class="a-no-dec" style="width: 100%">
        <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
          <span class="text-center fa fa-download fa-2x"></span>
          <p class="h4 m-t-xs m-b-0 text-center">Last ned CV</p>
        </div>
      </a>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="/innboks#send{{ $brukerinfo->id }}" class="a-no-dec" style="width: 100%">
        <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
          <span class="fa fa-commenting-o fa-2x"></span>
          <p class="h4 m-t-xs m-b-0">Send {{ $brukerinfo->fornavn }} en melding</p>
        </div>
      </a>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a class="a-no-dec cursor" style="width: 100%" data-toggle="modal" data-target="#startSamarbeid">
        <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
          <span class="fa fa-handshake-o fa-2x"></span>
          <p class="h4 m-t-xs m-b-0">Start et samarbeid med {{ $brukerinfo->fornavn }}</p>
        </div>
      </a>
    </div>
  </div> {{-- end row  --}}
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
