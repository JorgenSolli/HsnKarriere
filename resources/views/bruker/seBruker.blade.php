@extends('layout')

@section('content')
<div class="profile-header text-center" style="background-image: url(/img/bruker/header.jpg); ">
    <div class="container-fluid">
        <div class="container-inner">
            <img class="img-circle media-object" src="/uploads/img/{{ $brukerinfo->profilbilde }}">
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
    </div>
  </div>
</div>
@stop