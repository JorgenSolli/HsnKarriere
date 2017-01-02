@extends('layout', ['avatar' => $brukerinfo->profilbilde])

@section('content')
<div class="profile-header text-center" style="background-image: url(img/bruker/header.jpg); ">
    <div class="container-fluid">
        <div class="container-inner">
            <img class="img-circle media-object" src="uploads/img/{{ $brukerinfo->profilbilde }}">
            <h3 class="profile-header-user">{{ $brukerinfo->fornavn }} {{ $brukerinfo->etternavn }}</h3>
            <p class="profile-header-bio">Studerer 
            @unless ($fagtyper == "")
              @foreach ($fagtyper as $fagtype) 
                  {{ $fagtype[0] }} ved {{ $fagtype[1] }}, {{ $fagtype[2] }} til {{ $fagtype[3] }}
              @endforeach
            @endunless
             </p>
        </div>
    </div>
    <nav class="profile-header-nav">
        <ul class="nav nav-tabs">
            <li><a href="#">Min Profil</a></li>
            <li><a href="#">Mine Kontakter</a></li>
            <li class="active"><a href="#">Bedrifter</a></li>
            <li><a href="#">Rediger Profil</a></li>
            <li><a href="#">Mine Filer</a></li>
        </ul>
    </nav>
</div>
        
<div class="container">
  <div class="m-t">
    <div class="row">
      @unless ($bedrifter == "")
        @foreach ($bedrifter as $bedrift)
          <div class="col-md-3">
            <div class="panel panel-default panel-profile">
              <div class="panel-heading" style="background-image: url(img/bruker/header.jpg);"></div>
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
</div>
@stop