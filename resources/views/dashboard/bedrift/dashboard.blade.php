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
	        					<a href="bruker/{{ $partnership->student_id }}">{{ $partnership->student_fornavn }} {{ $partnership->student_etternavn }}</a> som praktikant hos din bedrift?</p>
	        				<div class="has-text-centered d-inline-block">
	        					<form action="samarbeid/{{ $partnership->id }}" method="post" class="pull-left">
	        						{{ csrf_field() }}
	        						{{ method_field('DELETE') }}
		        					<input type="hidden" class="confirmMsg" value="Er du sikker på at du vil avvise samarbeidet?">
	        						<button type="button" class="submitBtn btn btn-danger m-r-s">IKKE GODKJENN</button>
        						</form>

        						<form method="post" action="godkjennSamarbeid/{{ $partnership->id }}" class="pull-left">
        							{{ csrf_field() }}
		        					<input type="hidden" class="confirmMsg" value="Er du sikker på at du vil godkjenne samarbeidet?">
		        					<button type="button" class="submitBtn btn btn-success m-l-s">GODKJENN</button>
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
		            			<img alt="student avatar" class="dashboard-avatars" src="uploads/{{ $partnership->student_profilbilde }}">
		            			@if ($partnership->godkjent_av_student == null)
		            				<p class="h5"><span class="fa fa-times fa-lg danger-color"></span>
		            				&nbsp;
		            				<a href="/bruker/{{ $partnership->student_id }}">{{ $partnership->student_fornavn }} {{ $partnership->student_etternavn }}</a> har ikke godtatt</p>
	            				@else
	            					<p class="h5"><span class="fa fa-check fa-lg success-color"></span>
	            					&nbsp;
		            				<a href="/bruker/{{ $partnership->student_id }}">{{ $partnership->student_fornavn }} {{ $partnership->student_etternavn }}</a> har godtatt</p>
		            			@endif
		            		</div>

		            		<div class="col-xs-6">
		            			<img alt="foreleser avatar" class="dashboard-avatars" src="uploads/{{ $partnership->larer_profilbilde }}">
		            			@if ($partnership->godkjent_av_foreleser == null)
		            				<p class="h5"><span class="fa fa-times fa-lg danger-color"></span>
		            				&nbsp;
		            				<a href="/bruker/{{ $partnership->larer_id }}">{{ $partnership->larer_fornavn }} {{ $partnership->larer_etternavn }}</a> har ikke godkjent enda</p>
		            			@else
		            				<p class="h5"><span class="fa fa-check fa-lg success-color"></span>
		            				&nbsp;
		            				<a href="/bruker/{{ $partnership->larer_id }}">{{ $partnership->larer_fornavn }} {{ $partnership->larer_etternavn }}</a> har godkjent</p>
		            			@endif
		            		</div>
		            	</div>
		            	<hr>
	      					<form action="samarbeid/{{ $partnership->id }}" method="post">
		    						{{ csrf_field() }}
		    						{{ method_field('DELETE') }}
		    						<input type="hidden" class="confirmMsg" value="Er du sikker på at du vil avbryte samarbeidet?">
		    						<button type="button" class="submitBtn btn btn-sm btn-danger m-r-s pull-right">AVBRYT SAMARBEID</button>
		  						</form>
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
			            @if ($partnership->kontrakt || $partnership->kontrakt_rejected == 1)
			            	<div class="row line-border">
					            <div class="col-xs-1">
					            	<p class="step">2</p>
					            </div>
					            <div class="col-xs-11">
					            	<p class="h4">Fyll ut og last opp kontrakten</p>
					            	@if ($partnership->arbeidsbesk == "" || $partnership->kontrakt_rejected == 1)
						            	<form action="oversikt/uploads/kontrakt/{{ $partnership->id }}" method="post" class="pull-left" enctype="multipart/form-data">
						            		{{ csrf_field() }}
						            		<div class="input-group">
				          						<label class="btn btn-primary-outline btn-file pull-left m-r-s">
														    <span class="inputFile">Velg fil&hellip;</span> 
														    	<input type="file" name="kontrakt" class="hidden">
															</label>

															<button type="submit" class="btn btn-success-outline disabled m-r-s"><span class="fa fa-upload"></span> LAST OPP</button>
														</div>
						            	</form>
					            	@endif
					            	@if ($partnership->signert_av_bedrift == 1 && $partnership->signert_av_student == 1)
					            		<a href="uploads/{{ $partnership->kontrakt }}" class="btn btn-success">Se kontrakten</a>
					            		@if (!$partnership->arbeidsbesk && $partnership->kontrakt_rejected == null)
						            		<div class="m-t-s m-b-0 alert alert-warning alert-dismissible" role="alert">
														  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														  Du har signert og lastet opp kontrakten. Du har enda muligheten til å laste opp en ny kontrakt hvis noe skulle mangle. <strong>Så fort arbeidsbeskrivelsen er lastet opp har du ikke lengre mulighet til dette!</strong>
														</div>
													@elseif ($partnership->kontrakt_rejected == 1)
														<div class="m-t-s m-b-0 alert alert-danger alert-dismissible" role="alert">
														  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														  Kontrakten ble avvist av foreleser. Årask: 
														  <strong>{{ $partnership->rejected_info }}</strong>
														  <hr>
														  Hvis feilen angår deg, venligst last opp kontrakten på nytt med de nødvendige endringene.
														</div>
													@endif
					            	@endif
					            	@if ($partnership->arbeidsbesk && $partnership->kontrakt_rejected == null)
					            		<div class="m-t-s m-b-0 alert alert-warning alert-dismissible" role="alert">
													  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													  Kontrakten er allerede lastet opp og avventer godkjenning
													</div>
					            	@endif
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
			          					<button class="disabled btn btn-primary-outline"><span class="fa fa-upload"></span> LAST OPP</button>
				            		</div>
					            </div>
				            </div>
			            @endif

			            <!-- Step three -->
			            @if (($partnership->signert_av_bedrift == 1 && $partnership->signert_av_student == 1 && $partnership->arbeidsbesk == "")
			            		|| $partnership->arbeidsbesk_rejected == 1)
				            <div class="row line-border">
					            <div class="col-xs-1">
					            	<p class="step">3</p>
					            </div>
					            <div class="col-xs-11">
					            	<p class="h4">Last opp arbeidsbeskrivelse 
					            		<span class="info-color cursor fa fa-question-circle fa-lg"></span></p>
					            	<form action="oversikt/uploads/arbeidsbeskrivelse/{{ $partnership->id }}" method="post" class="pull-left" enctype="multipart/form-data">
					            		{{ csrf_field() }}
					            		<div class="input-group">
			          						<label class="btn btn-primary-outline btn-file pull-left m-r-s">
													    <span class="inputFile">Velg fil&hellip;</span> 
													    	<input type="file" name="arbeidsbesk" class="hidden">
														</label>

														<button type="submit" class="btn btn-success-outline disabled m-r-s"><span class="fa fa-upload"></span> LAST OPP</button>
													</div>
					            	</form>
						            @if ($partnership->arbeidsbesk_rejected == 1)
						            	<a href="uploads/{{ $partnership->arbeidsbesk }}" class="btn btn-success">Se arbeidsbeskrivelsen</a>
													<div class="m-t-s m-b-0 alert alert-danger alert-dismissible" role="alert">
													  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													  Kontrakten ble avvist av foreleser. Årask: 
													  <strong>{{ $partnership->rejected_info }}</strong>
													  <hr>
													  Venligst last opp kontrakten på nytt med de nødvendige endringene.
													</div>
												@endif
					            </div>
				            </div>
			            @elseif ($partnership->arbeidsbesk)
			            	<div class="row line-border">
					            <div class="col-xs-1">
					            	<p class="step">3</p>
					            </div>
					            <div class="col-xs-11">
					            	<p class="h4">Last opp arbeidsbeskrivelse</p>
				            		<a href="uploads/{{ $partnership->arbeidsbesk }}" class="btn btn-success">Se arbeidsbeskrivelsen</a>
												<div class="m-t-s m-b-0 alert alert-warning alert-dismissible" role="alert">
												  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												  Arbeidsbeskrivelsen er lastet opp og du har ikke lengre mulighet til å laste opp en ny. All kodumentasjon blir sendt til faglærer for godkjenning.
												</div>
					            </div>
				            </div>
		            	@else
		            		<div class="row line-border step-inactive">
					            <div class="col-xs-1">
					            	<p class="step">3</p>
					            </div>
					            <div class="col-xs-11">
					            	<p class="h4">Last opp arbeidsbeskrivelse</p>
				            		<div class="form-group">
				            			<span class="disabled btn btn-primary-outline btn-file pull-left m-r-s">
												    Velg fil&hellip;
													</span>
			          					<button class="disabled btn btn-primary-outline">LAST OPP</button>
				            		</div>
					            </div>
				            </div>
		            	@endif

			            <!-- Step four -->
			            <div class="row line-border step-inactive">
				            <div class="col-xs-1">
				            	<p class="step">4</p>
				            </div>
				            <div class="col-xs-11">
				            	<p class="h4">Ventet på godkjenning av faglærer {{ $partnership->larer_fornavn }} {{ $partnership->larer_etternavn }}</p>
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
			          					<button type="submit" class="btn btn-primary-outline disabled"><span class="fa fa-upload"></span> LAST OPP</button>
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
	<script src="/js/bootbox.min.js"></script>
	<script src="/js/dashboard.js"></script>
@stop