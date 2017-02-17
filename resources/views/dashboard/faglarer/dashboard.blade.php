@extends('layout', ['avatar' => $brukerinfo->profilbilde])

@section('content')

<div class="container p-t-md">
	<div class="row dashboard-stats-boxes m-b-s">
  	<div class="col-sm-4 dashboard-stats-box">
  		<div class="row">
				<div class="col-xs-4 p-r-0">
					<div class="panel panel-default left-box m-b-0">
	          <div class="panel-body text-center">
              <span class="white-color fa fa-building-o fa-2x m-a-0"></span>
	          </div>
	        </div>
				</div>
				<div class="col-xs-8 p-l-0">
					<div class="panel panel-default m-b-0">
	          <div class="panel-body text-center">
	            <p class="h3 m-a-0">25</p>
	            <p>Passende bedrifter</p>
	          </div>
	        </div>
				</div>
  		</div>
  	</div>
  	<div class="col-sm-4 dashboard-stats-box">
  		<div class="row">
				<div class="col-xs-4 p-r-0">
					<div class="panel panel-default middle-box m-b-0">
	          <div class="panel-body text-center">
              <span class="white-color fa fa-handshake-o fa-2x m-a-0"></span>
	          </div>
	        </div>
				</div>
				<div class="col-xs-8 p-l-0">
					<div class="panel panel-default m-b-0">
	          <div class="panel-body text-center">
	            <p class="h3 m-a-0">1</p>
	            <p>Aktivt samarbeid</p>
	          </div>
	        </div>
				</div>
  		</div>
  	</div>
  	
  	<div class="col-sm-4 dashboard-stats-box">
  		<div class="row">
				<div class="col-xs-4 p-r-0">
					<div class="panel panel-default right-box m-b-0">
	          <div class="panel-body text-center">
              <span class="white-color fa fa-envelope-o fa-2x m-a-0"></span>
	          </div>
	        </div>
				</div>
				<div class="col-xs-8 p-l-0">
					<div class="panel panel-default m-b-0">
	          <div class="panel-body text-center">
	            <p class="h3 m-a-0">3</p>
	            <p>Samtaler</p>
	          </div>
	        </div>
				</div>
  		</div>
  	</div>
	</div>

	<div class="row">
		<div class="col-sm-1 dashboard-sidebar">
			<div id="godkjenning" class="sidebar-item sidebar-1" 
				data-toggle="tooltip" 
				data-placement="right" 
				title="Samarbeid som krever din godkjenning">
				<span class="fa fa-check-circle-o fa-2x"></span>
			</div>

			<div id="venter-kontrakt" class="sidebar-item sidebar-2" 
				data-toggle="tooltip" 
				data-placement="right" 
				title="Venter på kontrakt og arbeidsbeskrivelse">
				<span class="fa fa-hourglass-o fa-2x"></span>
			</div>

			<div id="kontrakt-godkjenning" class="sidebar-item sidebar-3" 
				data-toggle="tooltip" 
				data-placement="right" 
				title="Kontrakter og arbeidsbeskrivelser for godkjenning">
				<span class="fa fa-pencil fa-2x"></span>
			</div>

			<div id="aktive-samarbeid" class="sidebar-item sidebar-4" 
				data-toggle="tooltip" 
				data-placement="right" 
				title="Aktive samarbeid">
				<span class="fa fa-handshake-o fa-2x"></span>
			</div>
		</div>
		<div class="col-sm-11">
			<div id="data">
				<p class="h3 text-center m-t-lg">Velg en kategori fra menyen til venstre</p>
			</div> {{-- End /data --}}
	  </div>
  </div>
</div>

@stop
@section('script')
		<script src="/js/dashboard.js"></script>
@stop