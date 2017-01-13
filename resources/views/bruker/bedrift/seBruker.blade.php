@extends('layout', ['avatar' => Auth::User()->profilbilde])

@section('content')
<div class="profile-header text-center" style="background-image: url(/uploads/{{ $brukerinfo->forsidebilde }}); ">
  <div class="container-fluid">
    <div class="container-inner">
      <img class="img-circle media-object" src="/uploads/{{ $brukerinfo->profilbilde }}">
      <h3 class="profile-header-user">{{ $brukerinfo->bedrift_navn }}</h3>
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
        <h4><span class="fa fa-file-text-o"></span> Om {{ $brukerinfo->bedrift_navn }}</h4>
        <p>{{ $brukerinfo->bio }}</p>
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <h4><span class="fa fa-briefcase"></span> Driver med</h4>
        {{ $brukerinfo->bedrift_fagfelt }}
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <h4><span class="fa fa-phone"></span> Telefon</h4>
        <p>{{ $brukerinfo->telefon }}</p>
      </div>
    </div>
  </div> <!-- end row -->
  <div class="row">
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <h4><span class="fa fa-envelope-o"></span> Epost</h4>
        <p>{{ $brukerinfo->email }}</p>
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <h4><span class="fa fa-home"></span> Adresse</h4>
        <p>{{ $brukerinfo->adresse }}, {{ $brukerinfo->postnr }}, {{ $brukerinfo->poststed }}</p>
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="" class="a-no-dec" style="width: 100%">
        <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
          <h4 class="m-t text-center"><span class="text-center fa fa-download fa-lg"></span> Utlyste stillinger</h4>
        </div>
      </a>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="/innboks" class="a-no-dec" style="width: 100%">
        <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
          <span class="fa fa-commenting-o fa-2x"></span>
          <h4 class="m-t-xs m-b-0">Send {{ $brukerinfo->bedrift_navn }} en melding</h4>
        </div>
      </a>
    </div>
  </div> <!-- end row  -->
  <div class="row">
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="" class="a-no-dec" style="width: 100%" data-toggle="modal" data-target="#seAttester">
        <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
          <h4 class="m-t text-center"><span class="fa fa-file-pdf-o fa-lg"></span> Bacheloroppgaver</h4>
        </div>
      </a>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="" class="a-no-dec" style="width: 100%" data-toggle="modal" data-target="#seAttester">
        <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
          <h4 class="m-t text-center"><span class="fa fa-file-pdf-o fa-lg"></span> Masteroppgaver</h4>
        </div>
      </a>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="/innboks" class="a-no-dec" style="width: 100%">
        <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
          <span class="fa fa-handshake-o fa-2x"></span>
          <h4 class="m-t-xs m-b-0">Start et samarbeid med {{ $brukerinfo->bedrift_navn }}</h4>
        </div>
      </a>
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
      <div class="modal-body">
        liste med attester
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" aria-label="close">Lukk</button>
      </div>
    </div>
  </div>
</div>
@stop