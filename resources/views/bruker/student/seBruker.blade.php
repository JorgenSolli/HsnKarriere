@extends('layout', ['avatar' => Auth::User()->profilbilde])

@section('content')
<div class="profile-header text-center" style="background-image: url(/uploads/{{ $brukerinfo->forsidebilde }}); ">
  <div class="container-fluid">
    <div class="container-inner">
      <img class="img-circle media-object" src="/uploads/{{ $brukerinfo->profilbilde }}">
      <h3 class="profile-header-user">{{ $brukerinfo->fornavn }} {{ $brukerinfo->etternavn }}</h3>
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
    <div class="col-sm-6 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <h4><span class="fa fa-file-text-o"></span> Bio</h4>
        <p>{{ $brukerinfo->bio }}</p>
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <h4><span class="fa fa-graduation-cap"></span> Studerer/studerte</h4>
        @unless ($student_studerer == "")
          @foreach ($student_studerer as $studerer)
          <p>{{ $studerer[0] }} ved {{ $studerer[1] }} fra {{$studerer[2] }} til {{ $studerer[3] }}</p>
          @endforeach
        @else
          <p>Ingen studier spesifisert</p>
        @endunless
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <h4><span class="fa fa-phone"></span> Telefon</h4>
        <p>{{ $brukerinfo->telefon }}</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <h4><span class="fa fa-envelope-o"></span> Epost</h4>
        <p>{{ $brukerinfo->email }}</p>
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <h4><span class="fa fa-calendar"></span> Fødselsdato</h4>
        <p>{{ $brukerinfo->dob }}</p>
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <h4><span class="fa fa-home"></span> Adresse</h4>
        <p>{{ $brukerinfo->adresse }}, {{ $brukerinfo->postnr }}, {{ $brukerinfo->poststed }}</p>
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="/uploads/{{ $brukerinfo->student_cv }}" class="a-no-dec" style="width: 100%">
        <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
          <span class="text-center fa fa-download fa-2x"></span>
          <h4 class="m-t-xs m-b-0 text-center">Last ned CV</h4>
        </div>
      </a>
    </div>
  </div> <!-- end row  -->
  <div class="row">
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="/uploads/{{ $brukerinfo->student_cv }}" class="a-no-dec" style="width: 100%" data-toggle="modal" data-target="#seAttester">
        <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
          <span class="fa fa-file-pdf-o fa-2x"></span>
          <h4 class="m-t-xs m-b-0">Se attester</h4>
        </div>
      </a>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="/innboks" class="a-no-dec" style="width: 100%">
        <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
          <span class="fa fa-commenting-o fa-2x"></span>
          <h4 class="m-t-xs m-b-0">Send {{ $brukerinfo->fornavn }} en melding</h4>
        </div>
      </a>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="/innboks" class="a-no-dec" style="width: 100%">
        <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
          <span class="fa fa-handshake-o fa-2x"></span>
          <h4 class="m-t-xs m-b-0">Start et samarbeid med {{ $brukerinfo->fornavn }}</h4>
        </div>
      </a>
    </div>
  </div>
</div>
@stop