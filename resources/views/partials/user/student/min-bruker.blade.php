<div class="row">
  <div class="col-sm-6 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <p class="h4"><span class="fa fa-file-text-o"></span> Bio</p>
      @if ($brukerinfo->bio)
        <p>{{ $brukerinfo->bio }}</p>
      @else
        <p>Biografi for {{ $brukerinfo->fornavn }} er ikke lagt til enda.</p>
      @endif
    </div>
  </div>
  <div class="col-sm-4 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-graduation-cap"></span> Studerer/studerte</p>
        @unless ($student_studerer == "")
          @foreach ($student_studerer as $studerer)
            <p>{{ $studerer->study }} ({{ $studerer->type }}) campus {{ $studerer->campus }} fra {{$studerer->fra }} til {{ $studerer->til }}</p>
          @endforeach
        @else
        <p>Ingen studier spesifisert</p>
      @endunless
      </div>
    </div>
    <div class="col-sm-2 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-phone"></span> Telefon</p>
        @if ($brukerinfo->telefon != 0)
          <p>{{ $brukerinfo->telefon }}</p>
        @else
          <p>Nummer ikke oppført</p>
        @endif
      </div>
    </div>
</div>
<div class="row">
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <p class="h4"><span class="fa fa-envelope-o"></span> Epost</p>
      <p>{{ $brukerinfo->email }}</p>
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <p class="h4"><span class="fa fa-calendar"></span> Fødselsdato</p>
      <p>{{ $brukerinfo->dob }}</p>
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <p class="h4"><span class="fa fa-home"></span> Adresse</p>
      @if ($brukerinfo->adresse && $brukerinfo->postnr && $brukerinfo->poststed)
        <p>{{ $brukerinfo->adresse }}, {{ $brukerinfo->postnr }}, {{ $brukerinfo->poststed }}</p>
      @else
        <p>Ingen adresse oppført</p>
      @endif
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <a href="/uploads/{ $brukerinfo->student_cv }" class="a-no-dec" style="width: 100%">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4 m-t text-center"><span class="text-center fa fa-download fa-lg"></span> Last ned CV</p>
      </div>
    </a>
  </div>
</div> <!-- end row  -->
<div class="row">
  <div class="col-sm-3 p-r-s p-l-s">
    <a href="/uploads/{ $brukerinfo->student_cv }" class="a-no-dec" style="width: 100%" data-toggle="modal" data-target="#seAttester">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4 m-t text-center"><span class="fa fa-file-pdf-o fa-lg"></span> Se attester</p>
      </div>
    </a>
  </div>
</div>
