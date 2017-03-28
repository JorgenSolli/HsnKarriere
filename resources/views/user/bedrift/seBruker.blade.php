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
        <a href="{{ url($brukerinfo->nettside) }}" target="_blank"><span class="social_icons fa fa-home fa-2x"></span></a>
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
        {!! $brukerinfo->bio !!}
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-briefcase"></span> Driver med</p>
        @foreach ($fag as $value)
          {{ $value->study }}@unless ($loop->last),@endunless
        @endforeach
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-phone"></span> Telefon</p>
        @if ($brukerinfo->telefon > 0)
          {{ $brukerinfo->telefon }}
        @else
          Telefonnummer ikke registrert
        @endif
      </div>
    </div>
  </div> <!-- end row -->
  <div class="row">
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-envelope-o"></span> Epost</p>
        {{ $brukerinfo->email }}
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-home"></span> Adresse</p>
        {{ $brukerinfo->adresse }}, {{ $brukerinfo->postnr }}, {{ $brukerinfo->poststed }}
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="/innboks#send{{ $brukerinfo->id }}" class="a-no-dec" style="width: 100%">
        <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
          <span class="fa fa-commenting-o fa-2x"></span>
          <p class="h4 m-t-xs m-b-0">Send {{ $brukerinfo->bedrift_navn }} en melding</p>
        </div>
      </a>
    </div>
    @if (Auth::user()->bruker_type == "student")
      <div class="col-sm-3 p-r-s p-l-s">
        <div class="cursor" style="width: 100%" data-toggle="modal" data-target="#startSamarbeid">
          <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
            <span class="fa fa-handshake-o fa-2x"></span>
            <p class="h4 m-t-xs m-b-0">Start et samarbeid med {{ $brukerinfo->bedrift_navn }}</p>
          </div>
        </div>
      </div>
    @endif
  </div> <!-- end row  -->
  <div class="row">
    <div class="col-sm-3 p-r-s p-l-s cursor">
      <div style="width: 100%" data-toggle="modal" data-target="#seeBachelors">
        <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
          <p class="h4 m-t text-center"><span class="fa fa-file-pdf-o fa-lg"></span> Bacheloroppgaver 
            <span class="badge">{{ $nr_bachelors }}</span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s cursor">
      <div style="width: 100%" data-toggle="modal" data-target="#seeMasters">
        <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
          <p class="h4 m-t text-center"><span class="fa fa-file-pdf-o fa-lg"></span> Masteroppgaver
            <span class="badge">{{ $nr_masters }}</span>
          </p>
        </div>
      </div>
    </div>
    
    <div class="col-sm-3 p-r-s p-l-s cursor">
      <div style="width: 100%" data-toggle="modal" data-target="#seeJobs">
        <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
          <p class="h4 m-t text-center"><span class="text-center fa fa-briefcase fa-lg"></span> Utlyste stillinger
            <span class="badge">{{ $nr_jobs }}</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- MODALS --}}
<div id="seeBachelors" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span> {{ $brukerinfo->bedrift_navn }}s Bacheloroppgaver</p>
      </div>
      <div class="modal-body">
        <ul id="listBachelors" class="media-list media-list-stream list-items-border m-b-0">
          @foreach ($bachelors as $bachelor)
            <li class="media">
              <div class="media-body">
                <span class="h4"><strong>{{ $bachelor->tittel }}</strong></span> · {{ $bachelor->fagfelt }}
                <div class="media-body-actions">
                  <p>
                  {{ $bachelor->info }}
                  </p>
                  <a href="seeBachelor/{{ $bachelor->id }}" class="btn btn-primary-outline btn-sm m-r-s">
                    <span class="delete fa fa-envelope-o"></span> Ta kontakt
                  </a>
                  <a id="bachelorId{{ $bachelor->id }}" class="btn btn-success-outline btn-sm">
                    <span class="edit fa fa-download"></span> Last ned oppgave
                  </a>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-primary-outline" data-dismiss="modal" aria-label="close">Lukk</button>
      </div>
    </div>
  </div>
</div>

<div id="seeMasters" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span> {{ $brukerinfo->bedrift_navn }}s Masteroppgaver</p>
      </div>
      <div class="modal-body">
        <ul id="listBachelors" class="media-list media-list-stream list-items-border m-b-0">
          @foreach ($masters as $master)
            <li class="media">
              <div class="media-body">
                <span class="h4"><strong>{{ $master->tittel }}</strong></span> · {{ $master->fagfelt }}
                <div class="media-body-actions">
                  <p>
                  {{ $master->info }}
                  </p>
                  <a href="seeBachelor/{{ $master->id }}" class="btn btn-primary-outline btn-sm m-r-s">
                    <span class="delete fa fa-envelope-o"></span> Ta kontakt
                  </a>
                  <a href="/uploads/{{ $master->fil }}" target="_blank" class="btn btn-success-outline btn-sm">
                    <span class="edit fa fa-download"></span> Last ned oppgave
                  </a>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-primary-outline" data-dismiss="modal" aria-label="close">Lukk</button>
      </div>
    </div>
  </div>
</div>

<div id="seeJobs" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span> {{ $brukerinfo->bedrift_navn }}s Utlyste stillinger</p>
      </div>
      <div class="modal-body">
        <ul id="listBachelors" class="media-list media-list-stream list-items-border m-b-0">
          @foreach ($jobs as $job)
            <li class="media">
              <div class="media-body">
                <span class="h4"><strong>{{ $job->stilling_tittel }}</strong></span> · {{ $job->sted }}
                <div class="media-body-actions">
                  <p>{{ $job->info }}</p>
                  <p><strong>Frist:</strong> {{ $job->frist }}</p>
                  <a href="/innboks/{{ $brukerinfo->id }}" class="btn btn-primary-outline btn-sm m-r-s">
                    <span class="delete fa fa-envelope-o"></span> Ta kontakt
                  </a>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-primary-outline" data-dismiss="modal" aria-label="close">Lukk</button>
      </div>
    </div>
  </div>
</div>

@if (Auth::user()->bruker_type == "student")
  <div id="startSamarbeid" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p class="h4 modal-title" id="myModalLabel"><span class="fa fa-handshake-o"></span> Du er i ferd med å initiere et samarbeid med bedriften {{ $brukerinfo->bedrift_navn }}
          </p>
          <small class="danger-text m-t-xs">Vi minner om at det er viktig å ta kontakt med bedriften før et samarbeid blir forespurt</small>
        </div>
        <form method="POST" action="/samarbeid/nyttSamarbeid" enctype="multipart/form-data"> 
          <div class="modal-body">
            {{ csrf_field() }}
            <input type="hidden" name="bedrift_id" value="{{ $brukerinfo->id }}">
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
                @include('includes.selects.faglarere')
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
@endif

@stop
@section('script')
  <script src="/js/seBruker.js"></script>
@stop