@section('min-bruker')
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
        @unless ($company == "")
          @foreach ($company as $key => $value)
            {{ $company['area_of_expertise'][$key] }}
          @endforeach
        @endunless
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-phone"></span> Telefon</p>
        <p>{{ $brukerinfo->telefon }}</p>
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
        <p class="h4"><span class="fa fa-home"></span> Adresse</p>
        <p>{{ $brukerinfo->adresse }}, {{ $brukerinfo->postnr }}, {{ $brukerinfo->poststed }}</p>
      </div>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="" class="a-no-dec" style="width: 100%">
        <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
          <p class="h4 m-t text-center"><span class="text-center fa fa-download fa-lg"></span> Utlyste stillinger</h4>
        </div>
      </a>
    </div>
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="" class="a-no-dec" style="width: 100%" data-toggle="modal" data-target="#seAttester">
        <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
          <p class="h4 m-t text-center"><span class="fa fa-file-pdf-o fa-lg"></span> Masteroppgaver</p>
        </div>
      </a>
    </div>
  </div> <!-- end row  -->
  <div class="row">
    <div class="col-sm-3 p-r-s p-l-s">
      <a href="" class="a-no-dec" style="width: 100%" data-toggle="modal" data-target="#seAttester">
        <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
          <p class="h4 m-t text-center"><span class="fa fa-file-pdf-o fa-lg"></span> Bacheloroppgaver</p>
        </div>
      </a>
    </div>
    
  </div>
@stop