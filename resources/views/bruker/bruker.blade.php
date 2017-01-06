@extends('layout', ['avatar' => $brukerinfo->profilbilde])

@section('content')
<div class="profile-header text-center" style="background-image: url(/uploads/{{ $brukerinfo->forsidebilde }}); ">
    <div class="container-fluid">
        <div class="container-inner">
            <img class="img-circle media-object" src="/uploads/{{ $brukerinfo->profilbilde }}">
            <h3 class="profile-header-user">{{ $brukerinfo->fornavn }} {{ $brukerinfo->etternavn }}</h3>
            <a href="{{ $brukerinfo->facebook }}" class="p-r-s"><span class="fa fa-facebook-official fa-2x"></span></a>
            <a href="{{ $brukerinfo->linkedin }}" class="p-r-s"><span class="fa fa-linkedin-square fa-2x"></span></a>
            <a href="{{ $brukerinfo->nettside }}"><span class="fa fa-globe fa-2x"></span></a>
            <p class="profile-header-bio">Student ved campus {{ $brukerinfo->student_campus }} </p>
        </div>
    </div>
    <nav class="profile-header-nav">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#min-profil">Min Profil</a></li>
            <li><a href="#mine-kontakter">Mine Kontakter</a></li>
            <li><a href="#bedrifter">Bedrifter</a></li>
        </ul>
    </nav>
</div>
        
<div class="container">
  <div id="bedrifter-container" class="m-t">
    <div class="row">
      @unless ($bedrifter == "")
        @foreach ($bedrifter as $bedrift)
          <div class="col-md-3">
            <div class="panel panel-default panel-profile">
              <div class="panel-heading" style="background-image: url(/uploads/{{ $bedrift->forsidebilde }});"></div>
              <div class="panel-body text-center">
                <img class="panel-profile-img" src="uploads/img/{{ $bedrift->profilbilde }}">
                <h5 class="panel-title">{{ $bedrift->fornavn }} {{ $bedrift->etternavn }}</h5>
                <p class="m-b-md">
                  <span class="fa fa-envelope-o"></span> {{ $bedrift->email }}
                  <br>
                  <span class="fa fa-phone"></span> {{ $bedrift->telefon }}
                </p>
                
                <a class="btn btn-primary-outline btn-sm" href="/bruker/{{ $bedrift->id }}">
                  <span class="fa fa-user"></span> Se profil
                </a>
              </div>
            </div>
          </div> <!-- col-md-3 -->
        @endforeach
      @else
        <p>Ingen bedrifter passer deg</p>
      @endunless
    </div>
  </div>

  <div id="min-profil-container" class="m-t">
    <div class="row">
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
        <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
          <h4><span class="fa fa-file-pdf-o"></span> CV</h4>
          <a href="/uploads/{{ $brukerinfo->student_cv }}" class="btn btn-lg btn-success-outline" style="width: 100%">
            <span class="fa fa-download"></span> Last ned CV</a>
        </div>
      </div>
    </div> <!-- end row  -->
  </div> <!-- end min-profil-container -->
  <div class="row">
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <h4><span class="fa fa-file-pdf-o"></span> Attester</h4>
        <a class="btn btn-lg btn-success-outline" style="width: 100%" data-toggle="modal" data-target="#seAttester">Se attester</a>
      </div>
    </div>
  </div>
</div>

<!-- MODALS -->
<div id="seAttester" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span> {{ $brukerinfo->fornavn }}s attester</h4>
      </div>
      liste med attester
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" aria-label="close">Lukk</button>
      </div>
    </div>
  </div>
</div>
@stop