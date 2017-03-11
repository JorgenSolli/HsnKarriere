@extends('layout', ['avatar' => $brukerinfo->profilbilde])

@section('content')

<div class="container p-t-md">
	<div class="row dashboard-stats-boxes dashboard-menu m-b-s">
  	<div id="godkjenning" class="cursor menu-item col-sm-3 dashboard-stats-box">
  		<div class="row">
				<div class="col-xs-4 p-r-0">
					<div class="panel panel-default left-box m-b-0">
	          <div class="panel-body text-center">
              <span class="white-color fa fa-check-circle-o fa-2x m-a-0"></span>
	          </div>
	        </div>
				</div>
				<div class="col-xs-8 p-l-0">
					<div class="panel panel-default m-b-0">
	          <div class="panel-body text-center">
	            <p class="h3 m-a-0">{{ $kreverGodkjenning }}</p>
	            <p>Krever din godkjenning</p>
	          </div>
	        </div>
				</div>
  		</div>
  	</div>
  	<div id="venter-kontrakt" class="cursor menu-item col-sm-3 dashboard-stats-box">
  		<div class="row">
				<div class="col-xs-4 p-r-0">
					<div class="panel panel-default middle-box m-b-0">
	          <div class="panel-body text-center">
              <span class="white-color fa fa-hourglass-o fa-2x m-a-0"></span>
	          </div>
	        </div>
				</div>
				<div class="col-xs-8 p-l-0">
					<div class="panel panel-default m-b-0">
	          <div class="panel-body text-center">
	            <p class="h3 m-a-0">{{ $venterDokumentasjon }}</p>
	            <p>Venter på dokumenter</p>
	          </div>
	        </div>
				</div>
  		</div>
  	</div>
  	
  	<div id="kontrakt-godkjenning" class="cursor menu-item col-sm-3 dashboard-stats-box">
  		<div class="row">
				<div class="col-xs-4 p-r-0">
					<div class="panel panel-default right-box m-b-0">
	          <div class="panel-body text-center">
              <span class="white-color fa fa-pencil fa-2x m-a-0"></span>
	          </div>
	        </div>
				</div>
				<div class="col-xs-8 p-l-0">
					<div class="panel panel-default m-b-0">
	          <div class="panel-body text-center">
	            <p class="h3 m-a-0">{{ $godkjenneDokumenter }}</p>
	            <p>Godkjenne dokumenter</p>
	          </div>
	        </div>
				</div>
  		</div>
  	</div>

  	<div id="aktive-samarbeid" class="cursor menu-item col-sm-3 dashboard-stats-box">
  		<div class="row">
				<div class="col-xs-4 p-r-0">
					<div class="panel panel-default right-box m-b-0">
	          <div class="panel-body text-center">
              <span class="white-color fa fa-handshake-o fa-2x m-a-0"></span>
	          </div>
	        </div>
				</div>
				<div class="col-xs-8 p-l-0">
					<div class="panel panel-default m-b-0">
	          <div class="panel-body text-center">
	            <p class="h3 m-a-0">{{ $aktiveSamarbeid }}</p>
	            <p>Aktive samarbeid</p>
	          </div>
	        </div>
				</div>
  		</div>
  	</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div id="data">
				<p class="h3 text-center m-t-lg">
					<span class="fa fa-arrow-up"></span>&nbsp;
					Velg en kategori fra menyen til ovenfor&nbsp;
					<span class="fa fa-arrow-up"></span>
				</p>
			</div> {{-- End /data --}}
	  </div>
  </div>
</div>

@stop
@section('script')
	<script src="/js/bootbox.min.js"></script>
	<script src="/js/dashboard.js"></script>
@stop