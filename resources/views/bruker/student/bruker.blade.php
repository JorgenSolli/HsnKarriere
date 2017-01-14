@extends('layout', ['avatar' => $brukerinfo->profilbilde])

<!-- BRUKER STUDENT -->
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
    
  <!-- Nav tabs -->
  <nav class="profile-header-nav">
    <ul id="brukerTabs" class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
        <a href="#min-profil" aria-controls="min-profil" role="tab" data-toggle="tab">Min Profil</a>
      </li>
      <li role="presentation">
        <a href="#mine-kontakter" aria-controls="mine-kontakter" role="tab" data-toggle="tab">Mine Kontakter</a>
      </li>
      <li role="presentation">
        <a href="#bedrifter" aria-controls="bedrifter" role="tab" data-toggle="tab">Bedrifter</a>
      </li>
    </ul>
  </nav>
</div>
        
<div class="container tab-content">
  <div role="tabpanel" class="tab-pane active m-t" id="min-profil">
    @include('includes.bruker.student.min-bruker')
  </div>

  <div role="tabpanel" class="tab-pane" id="mine-kontakter">
    @include('includes.bruker.student.mine-kontakter')
  </div>

  <div id="bedrifter" class="tab-pane m-t" role="tabpanel">
    <div class="text-center clearfix m-b sort-field">
      <div id="sort-view" class="pull-left">
        <p class="pull-left p-r-s">Velg visning</p>
        <div class="sort-icons pull-left p-r pos-r">
          <span id="sortCards" class="active cursor fa fa-th-large fa-lg p-r-s"></span>
          <span id="sortList" class="cursor fa fa-th-list fa-lg"></span>
        </div>
      </div>
      <div id="sort-category-floater">
        <div id="sort-category" class="pull-left">
          <small class="seperator pull-left p-r pos-r">|</small>
          <p id="sort-category-text" class="pull-left m-a-0 p-r-s">Sorter etter</p>
          <select class="pull-left custom-select custom-select-sm">
            <option>Relevans</option>
            <option>Alfabetisk</option>
            <option>Nærmest deg</option>
          </select>
        </div>
      </div>
    </div>
    <div id="users-data">
      @include('includes.bruker.student.bedrifter.cards')
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
@section('script')
  <script src="/js/minBruker.js"></script>
@stop