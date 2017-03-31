@section('min-bruker')
  <div class="row">
  
    <div class="col-sm-6 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-file-text-o"></span> Om {{ $brukerinfo->bedrift_navn }}</p>
        {!! $brukerinfo->bio !!}
      </div>
    </div>

    <div class="col-sm-4 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-briefcase"></span> Driver med</p>
        @unless ($fag == "")
          @foreach ($fag as $data)
            {{ $data->study }}
          @endforeach
        @endunless
      </div>
    </div>

    <div class="col-sm-2 p-r-s p-l-s">
      <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
        <p class="h4"><span class="fa fa-phone"></span> Telefon</p>
        {{ $brukerinfo->telefon }}
      </div>
    </div>
  </div>
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

    <div class="col-sm-3 p-r-s p-l-s cursor">
      <div style="width: 100%" data-toggle="modal" data-target="#seeJobs">
        <div class="panel panel-default panel-hover p-t-s p-l p-r p-b">
          <p class="h4 m-t text-center"><span class="text-center fa fa-briefcase fa-lg"></span> Utlyste stillinger
            <span class="badge">{{ $nr_jobs }}</span>
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
    
  </div>
@stop