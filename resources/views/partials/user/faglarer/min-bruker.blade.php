<div class="row">
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <p class="h4"><span class="fa fa-graduation-cap"></span> Avdeling</p>
      <p>{{ $studie->study }}</p>
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <p class="h4"><span class="fa fa-home"></span> RomNr</p>
      <p>{{ $brukerinfo->foreleser_rom_nr }}</p>
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <p class="h4"><span class="fa fa-phone"></span> Telefon</p>
      @unless ($brukerinfo->telefon === 0)
        {{ $brukerinfo->telefon }}
      @else
        <p>Telefon ikke oppgitt</p>
      @endunless
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <p class="h4"><span class="fa fa-envelope-o"></span> Epost</p>
      <p>{{ $brukerinfo->email }}</p>
    </div>
  </div>
</div>

@unless ($brukerinfo->id == Auth::id())
  <div class="row">
    <div class="col-sm-4 p-r-s p-l-s">
      <a href="/innboks#send{{ $brukerinfo->id }}" class="a-no-dec" style="width: 100%">
        <div class="panel panel-default panel-hover text-center p-t-s p-l p-r p-b">
          <p><span class="fa fa-commenting-o fa-2x"></span></p>
          <p class="h4 m-t-xs m-b-0">Send {{ $brukerinfo->fornavn }} {{ $brukerinfo->etternavn }} en melding</p>
        </div>
      </a>
    </div>
  </div> <!-- end row  -->
@endunless