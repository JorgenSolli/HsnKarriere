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
		              <span class="white-color fa fa-graduation-cap fa-2x m-a-0"></span>
			          </div>
			        </div>
    				</div>

    				<div class="col-xs-8 p-l-0">
    					<div class="panel panel-default m-b-0">
			          <div class="panel-body text-center">
			            <p class="h3 m-a-0">25</p>
			            <p>Passende studenter</p>
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
	        @foreach($partnerships as $partnership)
	        	<ul class="list-group media-list media-list-stream">
			      	<li class="media list-group-item media-list-heading">
			          <div class="media-body">
			            <div class="media-heading">
			              <p class="h3 m-a-0">
			              	<span class="fa fa-briefcase fa-sm"></span> {{ ucfirst($partnership->type_samarbeid) }} med {{ $partnership->student_fornavn }} {{ $partnership->student_etternavn }}
			              	<span class="cursor pull-right fa fa-minus-square"></span>
			            	</p>
			            </div>
			          </div>
			        </li>

		        @if ($partnership->godkjent_av_bedrift == null)
		        	<li class="media list-group-item p-a">
        				<div class="media-body text-center">
	        				<p class="h4">Godkjenner du 
	        					{{ $partnership->student_fornavn }} {{ $partnership->student_etternavn }} som praktikant hos din bedrift?</p>
	        				<div class="has-text-centered d-inline-block">
	        					<form action="samarbeid/{{ $partnership->id }}" method="post" class="pull-left">
	        						{{ csrf_field() }}
	        						{{ method_field('DELETE') }}
	        						<button type="submit" class="btn btn-danger m-r-s">IKKE GODKJENN</button>
        						</form>

        						<form method="post" action="godkjennSamarbeid/{{ $partnership->id }}" class="pull-left">
        							{{ csrf_field() }}
		        					<button type="submit" class="btn btn-success m-l-s">GODKJENN</button>
        						</form>
		            	</div>
      					</div>
	        		</li>
	        	@elseif ($partnership->godkjent_av_foreleser == null || $partnership->godkjent_av_student == null)
	        		<li class="media list-group-item p-a">
        				<div class="media-body text-center">
	        				<p class="h4">Venter på godkjenning av alle parter</p>
	        				<div class="row">
		            		<div class="col-xs-6">
		            			@if ($partnership->godkjent_av_student == null)
		            				<p class="h5"><span class="fa fa-times fa-lg danger-color"></span> {{ $partnership->student_fornavn }} {{ $partnership->student_etternavn }} har ikke godtatt</p>
	            				@else
	            					<p class="h5"><span class="fa fa-check fa-lg success-color"></span> {{ $partnership->student_fornavn }} {{ $partnership->student_etternavn }} har godtatt</p>
		            			@endif
		            		</div>

		            		<div class="col-xs-6">
		            			@if ($partnership->godkjent_av_foreleser == null)
		            				<p class="h5"><span class="fa fa-times fa-lg danger-color"></span> {{ $partnership->larer_fornavn }} {{ $partnership->larer_etternavn }} har ikke godkjent</p>
		            			@else
		            				<p class="h5"><span class="fa fa-check fa-lg success-color"></span> {{ $partnership->larer_fornavn }} {{ $partnership->larer_etternavn }} har godkjent</p>
		            			@endif
		            		</div>
		            	</div>
      					</div>
	        		</li>
	        	@else
			        <li class="media list-group-item p-a">
			          <div class="media-body">
			            <!-- Step gz -->
			            <div class="row line-border">
				            <div class="col-xs-1">
				            	<p class="step"><span class="fa fa-thumbs-o-up" aria-hidden="true"></span></p>
				            </div>
				            <div class="col-xs-11">
				            	<p class="h4">Gratulerer med ny praktikant!</p>
				            	<p>Nå manger vi bare noen signaturer og en arbeidsbeskrivelse fra deg.</p>
				            </div>
			            </div>
			            <!-- Step one -->
			            <div class="row line-border">
				            <div class="col-xs-1">
				            	<p class="step">1</p>
				            </div>
				            <div class="col-xs-11">
				            	<p class="h4">Last ned kontrakten</p>
				            	@if ($partnership->kontrakt)
					            	<a href="uploads/{{ $partnership->kontrakt }}" class="btn btn-primary-outline"><span class="fa fa-download"></span> LAST NED</a>
					            	<p><small>Signert kontrakt av {{ $partnership->student_fornavn }}</small></p>
				            	@else
				            		<a href="#" class="btn btn-primary-outline disabled"><span class="fa fa-clock-o"></span> Venter på signatur av {{ $partnership->student_fornavn }}</a>
				            	@endif
				            </div>
			            </div>

			            <!-- Step two -->
			            @if ($partnership->kontrakt)
			            	<div class="row line-border">
					            <div class="col-xs-1">
					            	<p class="step">2</p>
					            </div>
					            <div class="col-xs-11">
					            	<p class="h4">Fyll ut og last opp kontrakten</p>
					            	<form action="oversikt/uploads/kontrakt/{{ $partnership->id }}" method="post" class="pull-left" enctype="multipart/form-data">
					            		<div class="input-group">
				          					<label class="btn btn-primary-outline btn-file pull-left m-r-s">
													    <span class="inputFile">Velg fil&hellip;</span> <input type="file" style="display: none;">
														</label>

														<button type="submit" class="btn btn-primary-outline disabled m-r-s">LAST OPP</button>
													</div>
					            	</form>
					            </div>
				            </div>
			            @else
				            <div class="row line-border step-inactive">
					            <div class="col-xs-1">
					            	<p class="step">2</p>
					            </div>
					            <div class="col-xs-11">
					            	<p class="h4">Fyll ut og last opp kontrakten</p>
				            		<div class="form-group">
				            			<span class="disabled btn btn-primary-outline btn-file pull-left m-r-s">
												    Velg fil&hellip;
													</span>
			          					<button class="disabled btn btn-primary-outline">LAST OPP</button>
				            		</div>
					            </div>
				            </div>
			            @endif

			            <!-- Step three -->
			            <div class="row line-border step-inactive">
				            <div class="col-xs-1">
				            	<p class="step">3</p>
				            </div>
				            <div class="col-xs-11">
				            	<p class="h4">{bedrift_navn} må laste opp arbeidsbeskrivelsen</p>
				            	<p><span class="fa fa-hourglass-half warning-color"></span> Ingen arbeidsbeksrivele lastet opp enda...</p>
				            </div>
			            </div>

			            <!-- Step four -->
			            <div class="row line-border step-inactive">
				            <div class="col-xs-1">
				            	<p class="step">4</p>
				            </div>
				            <div class="col-xs-11">
				            	<p class="h4">Ventet på godkjenning av alle parter</p>
				            	<div class="row">
				            		<div class="col-md-4">
				            			<p class="h5"><span class="fa fa-times fa-lg danger-color"></span> Du har signert</p>
				            		</div>

				            		<div class="col-md-4">
				            			<p class="h5"><span class="fa fa-times fa-lg danger-color"></span> { bedrift_navn } har signert</p>
				            		</div>

				            		<div class="col-md-4">
				            			<p class="h5"><span class="fa fa-times fa-lg danger-color"></span> Faglærer har godkjent</p>
				            		</div>
				            	</div>
				            </div>
			            </div>

			            <!-- Step five -->
			            <div class="row line-border step-inactive">
				            <div class="col-xs-1">
				            	<p class="step"><span class="fa fa-compass"></span></p>
				            </div>
				            <div class="col-xs-11">
				            	<p class="h4">Fullfør praksis</p>
				            	<p class="h4">Lykke til! </p>
				            </div>
			            </div>

			            <!-- Step six -->
			            <div class="row line-border-last step-inactive">
				            <div class="col-xs-1">
				            	<p class="step"><span class="fa fa-trophy"></span></p>
				            </div>
				            <div class="col-xs-11">
				            	<p class="h4">Lever rapport</p>
				            	<form>
				            		<div class="form-group">
				            			<span class="btn btn-primary-outline btn-file pull-left m-r-s disabled">
												    Velg fil <input type="file" name="contract_upload">
													</span>
			          					<button type="submit" class="btn btn-primary-outline disabled">LAST OPP</button>
				            		</div>
				            	</form>
				            </div>
			            </div>
			          </div>
			        </li>
		        @endif
      			</ul>
	        @endforeach
        @else
         <p>Du har ikke påbegynt noen samarbeid enda</p>
        @endunless
    </div>
  </div>
</div>

@stop
@section('script')
		{{-- <script src="/js/oversikt.js"></script> --}}
@stop