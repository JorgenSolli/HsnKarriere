@extends('layout', ['avatar' => Auth::User()->profilbilde])

@section('content')
<div class="profile-header text-center" style="background-image: url(/uploads/{{ $brukerinfo->forsidebilde }}); ">
  <div class="container-fluid">
    <div class="container-inner">
      <img class="img-circle media-object" src="/uploads/{{ $brukerinfo->profilbilde }}">
      <p class="h3 profile-header-user">{{ $brukerinfo->bedrift_navn }}</p>
      @if ($brukerinfo->facebook != "")
        <a href="{{ $brukerinfo->facebook }}" class="p-r-s"><span class="social_icons fa fa-facebook-official fa-2x"></span></a>
      @endif
      @if ($brukerinfo->linkedin != "")
        <a href="{{ $brukerinfo->linkedin }}" class="p-r-s"><span class="social_icons fa fa-linkedin-square fa-2x"></span></a>
      @endif
      @if ($brukerinfo->nettside != "")
        <a href="{{ $brukerinfo->nettside }}"><span class="social_icons fa fa-home fa-2x"></span></a>
      @endif
      <p class="profile-header-bio">Holder til i {{ $brukerinfo->poststed }}
      @unless ($brukerinfo->bedrift_avdeling == "")
        ved avdeling {{ $brukerinfo->bedrift_avdeling }}
      @endunless</p>
    </div>
  </div>
</div>
        
<div class="container tab-content m-t">
  <div class="row">
    <div class="col-sm-6 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-file-text-o"></span> Om {{ $brukerinfo->bedrift_navn }}</p>
        <p>{{ $brukerinfo->bio }}</p>
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-briefcase"></span> Driver med</p>
        {{ $brukerinfo->bedrift_fagfelt }}
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-phone"></span> Telefon</p>
        <p>{{ $brukerinfo->telefon }}</p>
      </div>
    </div>
  </div> <!-- end row -->
  <div class="row">
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-envelope-o"></span> Epost</p>
        <p>{{ $brukerinfo->email }}</p>
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-home"></span> Adresse</p>
        <p>{{ $brukerinfo->adresse }}, {{ $brukerinfo->postnr }}, {{ $brukerinfo->poststed }}</p>
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="/innboks#send{{ $brukerinfo->id }}" class="a-no-dec" style="width: 100%">
        <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
          <span class="fa fa-commenting-o fa-2x"></span>
          <p class="h4 m-t-xs m-b-0">Send {{ $brukerinfo->fornavn }} {{ $brukerinfo->etternavn }} en melding</p>
        </div>
      </a>
    </div>
  </div> <!-- end row  -->
</div>

@stop
@section('script')
  <script src="/js/seBruker.js"></script>
@stop