<div class="row m-t">
  <div class="col-sm-5 p-r-s p-l-s">
    <div id="bio-panel" class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <p class="h4"><span class="fa fa-file-text-o"></span> Bio</p>
      <p>{!! $brukerinfo->bio !!}</p>
    </div>
  </div>
  <div class="col-sm-7">
    <div class="row">
      <div class="col-sm-8 p-r-s p-l-s">
        <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
          <p class="h4"><span class="fa fa-graduation-cap"></span> Studerer/studerte</p>
          @unless ($student_studerer == "")
            @foreach ($student_studerer as $studerer)
              <p>{{ $studerer->study }} ved {{ $studerer->campus }} fra {{$studerer->fra }} til {{ $studerer->til }}</p>
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
  <div class="col-sm-2 p-r-s p-l-s">
    <a href="/uploads/{{-- $brukerinfo->student_cv --}}" class="a-no-dec" style="width: 100%" data-toggle="modal" data-target="#seAttester">
      <div class="panel panel-default panel-hover text-center p-t p-l p-r p-b">
        <span class="fa fa-file-pdf-o fa-2x"></span>
        <p class="h4 m-t-xs m-b-0">Se attester</p>
      </div>
    </a>
  </div>
  <div class="col-sm-2 p-r-s p-l-s">
    <a href="/uploads/{{-- $brukerinfo->student_cv --}}" class="a-no-dec" style="width: 100%">
      <div class="panel panel-default panel-hover text-center p-t p-l p-r p-b">
        <span class="text-center fa fa-download fa-2x"></span>
        <p class="h4 m-t-xs m-b-0 text-center">Last ned CV</p>
      </div>
    </a>
  </div>
  @unless ($brukerinfo->id == Auth::id())
    <div class="col-sm-4 p-r-s p-l-s">
      <a href="/innboks#send{{ $brukerinfo->id }}" class="a-no-dec" style="width: 100%">
        <div class="panel panel-default panel-hover text-center p-t p-l p-r p-b">
          <span class="fa fa-commenting-o fa-2x"></span>
          <p class="h4 m-t-xs m-b-0">Send {{ $brukerinfo->fornavn }} en melding</p>
        </div>
      </a>
    </div>

    @if ($inPartnership)
      <div class="col-sm-4 p-r-s p-l-s">
        <a class="a-no-dec" href="/oversikt" style="width: 100%">
          <div class="panel panel-default panel-hover text-center p-t p-l p-r p-b">
            <span class="fa fa-handshake-o fa-2x"></span>
            <p class="h4 m-t-xs m-b-0">Du er i et samarbeid med {{ $brukerinfo->fornavn }}</p>
          </div>
        </a>
      </div>
    @else
      <div class="col-sm-4 p-r-s p-l-s">
        <a class="a-no-dec cursor" style="width: 100%" data-toggle="modal" data-target="#startSamarbeid">
          <div class="panel panel-default panel-hover text-center p-t p-l p-r p-b">
            <span class="fa fa-handshake-o fa-2x"></span>
            <p class="h4 m-t-xs m-b-0">Start et samarbeid med {{ $brukerinfo->fornavn }}</p>
          </div>
        </a>
      </div>
    @endif
  @endunless
</div> {{-- end row  --}}
