@extends('layout', ['avatar' => $brukerinfo->profilbilde])

@section('content')

<div class="container p-t-md">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default visible-md-block visible-lg-block">
        <div class="panel-body">
          <p class="h5 m-t-0">Noe her</p>
          <ul class="list-unstyled list-spaced">
            <li><span class="text-muted icon icon-calendar m-r"></span>Kanskje en lenke til <a href="#">Innboks</a>
            <li><span class="text-muted icon icon-users m-r"></span>Eller til overskt over <a href="#">Bedrifter</a>
            <li><span class="text-muted icon icon-cog m-r"></span>Til <a href="#">Rediger profil?</a>
            <li><span class="text-muted icon icon-home m-r"></span>Eller kanskje til <a href="#">Min Profil</a>
          </ul>
        </div>
      </div>

			<div class="panel panel-default panel-link-list">
        <div class="panel-body">
          © 2017 HSN Karriere
          <a href="#">Om</a> ·
          <a href="#">Hjelp</a> ·
          <a href="#">tos</a> ·
          <a href="#">Personvern</a> ·
          <a href="#">Cookies</a>
        </div>
      </div>
    </div>

    <div class="col-md-9">
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
    	@unless ($partnerships == "")
      	<ul class="list-group media-list media-list-stream">
	      	<li class="media list-group-item media-list-heading is-bg-danger">
	          <div class="media-body">
	            <div class="media-heading">
	              <h3 class="white-color m-a-0">
	              	<span class="fa fa-handshake-o fa-sm"></span> Samarbeid som krever din godkjenning
	              	<span class="cursor pull-right fa fa-minus-square"></span>
	            	</h3>
	            </div>
	          </div>
	        </li>
        @foreach ($partnerships as $partnership)
        	<!-- Partnerships that you (the teacher) needs to approve -->
	        @if ($partnership->godkjent_av_foreleser == null)
	        	<li class="media list-group-item p-a">
      				<div class="media-body">
        				<p class="pull-left">
        					Type: {{ $partnership->type_samarbeid }} · 
        					Student: <a href="bruker/{{ $partnership->student_id }}"">{{ $partnership->student_fornavn }} {{ $partnership->student_etternavn }}</a> · 
        					Bedrift: <a href="bruker/{{ $partnership->bedrift_id }}">{{ $partnership->bedrift_navn }}</a>
      					</p>
        				<div class="pull-right">
        					<form action="samarbeid/{{ $partnership->id }}" method="post" class="pull-left">
        						{{ csrf_field() }}
        						{{ method_field('DELETE') }}
        						<button type="submit" class="btn btn-sm btn-danger m-r-s">IKKE GODKJENN</button>
      						</form>

      						<form method="post" action="godkjennSamarbeid/{{ $partnership->id }}" class="pull-left">
      							{{ csrf_field() }}
	        					<button type="submit" class="btn btn-sm btn-success m-l-s">GODKJENN</button>
      						</form>
	            	</div>
    					</div>
        		</li>
      		@endif
        @endforeach
				</ul>
				<ul class="list-group media-list media-list-stream">
	      	<li class="media list-group-item media-list-heading is-bg-warning">
	          <div class="media-body">
	            <div class="media-heading">
	              <h3 class="white-color m-a-0">
	              	<span class="fa fa-handshake-o fa-sm"></span> Venter på kontrakt og arbeidsbeskrivelse
	              	<span class="cursor pull-right fa fa-minus-square"></span>
	            	</h3>
	            </div>
	          </div>
	        </li>
					{{-- Partnerships where we're waiting for others to complete something (ie. sign a contract) --}}
	        @foreach ($partnerships as $partnership)
	      		@if ($partnership->godkjent_av_foreleser == 1
	      			&& ($partnership->signert_av_bedrift == null 
      				|| $partnership->signert_av_student == null))
	      			<li class="media list-group-item p-a">
	      				<div class="media-body">
	        				<p class="pull-left">
	        					en eb</a>
	      					</p>
	    					</div>
	        		</li>
	      		@endif
	        @endforeach
        </ul>

        <ul class="list-group media-list media-list-stream">
	      	<li class="media list-group-item media-list-heading is-bg-primary">
	          <div class="media-body">
	            <div class="media-heading">
	              <h3 class="white-color m-a-0">
	              	<span class="fa fa-handshake-o fa-sm"></span> Kontrakter og arbeidsbeskrivelser for godkjenning
	              	<span class="cursor pull-right fa fa-minus-square"></span>
	            	</h3>
	            </div>
	          </div>
	        </li>
	        @foreach ($partnerships as $partnership)
	      		<!-- Partnerships where a contract has to be approved. -->
	        	@if ($partnership->signert_av_bedrift == 1 && $partnership->signert_av_student == 1)
			        <li class="media list-group-item p-a">
	      				<div class="media-body">
	        				<p class="pull-left">
	        					Her kommer kontrakter og annet</a>
	      					</p>
	    					</div>
	        		</li>
		        @endif
	        @endforeach
        </ul>

        <ul class="list-group media-list media-list-stream">
	      	<li class="media list-group-item media-list-heading is-bg-success">
	          <div class="media-body">
	            <div class="media-heading">
	              <h3 class="white-color m-a-0">
	              	<span class="fa fa-handshake-o fa-sm"></span> Aktive samarbeid
	              	<span class="cursor pull-right fa fa-minus-square"></span>
	            	</h3>
	            </div>
	          </div>
	        </li>
	        @foreach ($partnerships as $partnership)
	      		<!-- Partnerships where a contract has to be approved. -->
	        	@if ($partnership->signert_av_bedrift == 1 && $partnership->signert_av_student == 1)
			        <li class="media list-group-item p-a">
	      				<div class="media-body">
	        				<p class="pull-left">
	        					Her kommer kontrakter og annet</a>
	      					</p>
	    					</div>
	        		</li>
		        @endif
	        @endforeach
        </ul>
      @endunless
    </div>
  </div>
</div>

@stop
@section('script')
		<script src="/js/oversikt.js"></script>
@stop