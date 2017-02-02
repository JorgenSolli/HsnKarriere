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
      	@unless ($samarbeid == "")
	        @for ($i = 0; $i < count($samarbeid); $i++)
	        	<ul class="list-group media-list media-list-stream">
			      	<li class="media list-group-item media-list-heading">
			          <div class="media-body">
			            <div class="media-heading">
			              <h3 class="white-color m-a-0">
			              	<span class="fa fa-briefcase fa-sm"></span> {{ $samarbeid[$i]['type_samarbeid'] }} hos {{ $bedrift[$i]['bedrift_navn'] }}
			              	<span class="cursor pull-right fa fa-minus-square"></span>
			            	</h3>
			            </div>
			          </div>
			        </li>
		        @if ($samarbeid[$i]['godkjent_av_student'] == null)
		        	<li class="media list-group-item p-a">
        				<div class="media-body text-center">
	        				<p class="h4">Vil du takke ja til praksisplass hos 
	        					{{ $bedrift[$i]['bedrift_navn'] }}?</p>
	        				<div class="has-text-centered d-inline-block">
	        					<form action="samarbeid/{{ $samarbeid[$i]['id'] }}" method="post" class="pull-left">
	        						{{ csrf_field() }}
	        						{{ method_field('DELETE') }}
	        						<button type="submit" class="btn btn-danger m-r-s">IKKE GODKJENN</button>
        						</form>

        						<form method="post" action="godkjennSamarbeid/{{ $samarbeid[$i]['id'] }}" class="pull-left">
        							{{ csrf_field() }}
		        					<button type="submit" class="btn btn-success m-l-s">GODKJENN</button>
        						</form>
		            	</div>
      					</div>
	        		</li>
	        	@elseif ($samarbeid[$i]['godkjent_av_foreleser'] == null || $samarbeid[$i]['godkjent_av_bedrift'] == null)
	        		<li class="media list-group-item p-a">
        				<div class="media-body text-center">
	        				<p class="h4">Venter på godkjenning av alle parter</p>
	        				<div class="row">
		            		<div class="col-xs-6">
		            			@if ($samarbeid[$i]['godkjent_av_bedrift'] == null)
		            				<p class="h5"><span class="fa fa-times fa-lg danger-color"></span> {{ $bedrift[$i]['bedrift_navn'] }} har ikke godtatt</p>
	            				@else
	            					<p class="h5"><span class="fa fa-check fa-lg success-color"></span> {{ $bedrift[$i]['bedrift_navn'] }} har godtatt</p>
		            			@endif
		            		</div>

		            		<div class="col-xs-6">
		            			@if ($samarbeid[$i]['godkjent_av_foreleser'] == null)
		            				<p class="h5"><span class="fa fa-times fa-lg danger-color"></span> {{ $faglarer[$i]['fornavn']}} {{ $faglarer[$i]['etternavn']}} har ikke godkjent</p>
		            			@else
		            				<p class="h5"><span class="fa fa-check fa-lg success-color"></span> {{ $faglarer[$i]['fornavn']}} {{ $faglarer[$i]['etternavn']}} har godkjent</p>
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
				            	<p class="h4">Gratulerer med godkjent praksisplass!</p>
				            	<p>Nå manger vi bare noen signaturer og en arbeidsbeskrivelse.</p>
				            </div>
			            </div>
			            <!-- Step one -->
			            <div class="row line-border">
				            <div class="col-xs-1">
				            	<p class="step">1</p>
				            </div>
				            <div class="col-xs-11">
				            	<p class="h4">Last ned kontrakten</p>
				            	<a href="" class="btn btn-primary-outline"><span class="fa fa-download"></span> LAST NED</a>
				            	<p><small>Kontrakt for Økonomi og Informatikk</small></p>
				            </div>
			            </div>

			            <!-- Step two -->
			            <div class="row line-border">
				            <div class="col-xs-1">
				            	<p class="step">2</p>
				            </div>
				            <div class="col-xs-11">
				            	<p class="h4">Fyll ut og last opp kontrakten</p>
				            	<form>
				            		<div class="form-group">
				            			<span class="btn btn-primary-outline btn-file pull-left m-r-s">
												    Velg fil <input type="file" name="contract_upload">
													</span>
			          					<button type="submit" class="btn btn-primary-outline disabled">LAST OPP</button>
				            		</div>
				            	</form>
				            </div>
			            </div>

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
	        @endfor
        @else
         <p>Du har ikke påbegynt noen samarbeid enda</p>
        @endunless
    </div>
  </div>
</div>

@stop
@section('script')
		<script src="/js/oversikt.js"></script>
@stop