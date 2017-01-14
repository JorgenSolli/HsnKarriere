<div class="row">
  <div class="col-sm-6 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <h4><span class="fa fa-file-text-o"></span> Bio</h4>
      <p>{{ $brukerinfo->bio }}</p>
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <h4><span class="fa fa-graduation-cap"></span> Studerer/studerte</h4>
      @unless ($student_studerer == "")
        @foreach ($student_studerer as $studerer)
        <p>{{ $studerer[0] }} ved {{ $studerer[1] }} fra {{$studerer[2] }} til {{ $studerer[3] }}</p>
        @endforeach
      @else
        <p>Ingen studier spesifisert</p>
      @endunless
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <h4><span class="fa fa-phone"></span> Telefon</h4>
      <p>{{ $brukerinfo->telefon }}</p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <h4><span class="fa fa-envelope-o"></span> Epost</h4>
      <p>{{ $brukerinfo->email }}</p>
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <h4><span class="fa fa-calendar"></span> Fødselsdato</h4>
      <p>{{ $brukerinfo->dob }}</p>
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
      <h4><span class="fa fa-home"></span> Adresse</h4>
      <p>{{ $brukerinfo->adresse }}, {{ $brukerinfo->postnr }}, {{ $brukerinfo->poststed }}</p>
    </div>
  </div>
  <div class="col-sm-3 p-r-s p-l-s">
    <a href="/uploads/{{ $brukerinfo->student_cv }}" class="a-no-dec" style="width: 100%">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <h4 class="m-t text-center"><span class="text-center fa fa-download fa-lg"></span> Last ned CV</h4>
      </div>
    </a>
  </div>
</div> <!-- end row  -->
<div class="row">
  <div class="col-sm-3 p-r-s p-l-s">
    <a href="/uploads/{{ $brukerinfo->student_cv }}" class="a-no-dec" style="width: 100%" data-toggle="modal" data-target="#seAttester">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <h4 class="m-t text-center"><span class="fa fa-file-pdf-o fa-lg"></span> Se attester</h4>
      </div>
    </a>
  </div>
</div>
