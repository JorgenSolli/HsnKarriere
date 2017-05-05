<div class="row">
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <p class="h4"><span class="fa fa-graduation-cap"></span> Avdeling</p>
      <p>{{ $studie->study }}</p>
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <p class="h4"><span class="fa fa-phone"></span> Telefon</>
      <p>{{ $brukerinfo->telefon }}</p>
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <p class="h4"><span class="fa fa-envelope-o"></span> Epost</p>
      <p>{{ $brukerinfo->email }}</p>
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <p class="h4"><span class="fa fa-home"></span> RomNr</p>
      <p>{{ $brukerinfo->foreleser_rom_nr }}</p>
    </div>
  </div>
</div>