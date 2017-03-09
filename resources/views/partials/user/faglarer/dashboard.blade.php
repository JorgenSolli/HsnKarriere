@if ($type == "godkjenning")
	<div id="godkjenning-data" class="panel panel-default">
	  <div class="panel-heading">
	    <p class="h3 panel-title"><span class="fa fa-check-circle-o"></span> Samarbeid som krever din godkjenning</p>
	  </div>
	  <div class="panel-body">
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
	  </div>
	</div>

@elseif ($type == "venter-kontrakt")
	<div id="venter-kontrakt-data" class="panel panel-default">
	  <div class="panel-heading">
	    <p class="h3 panel-title"><span class="fa fa-hourglass-o"></span> Venter på kontrakt og arbeidsbeskrivelse</p>
	  </div>
	  <div class="panel-body">
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
	  </div>
	</div>

@elseif ($type == "kontrakt-godkjenning")
	<div id="kontrakt-godkjenning-data" class="panel panel-default">
	  <div class="panel-heading">
	    <p class="h3 panel-title"><span class="fa fa-pencil"></span> Kontrakter og arbeidsbeskrivelser for godkjenning</p>
	  </div>
	  <div class="panel-body">
	    @foreach ($partnerships as $partnership)
	  		<!-- Partnerships where a contract has to be approved. -->
	    	@if ($partnership->signert_av_bedrift == 1 && $partnership->signert_av_student == 1)
	        <li class="media list-group-item p-a">
	  				<div class="media-body">
	  					<table class="table">
		  					<thead>
		  						<tr>
		  							<th>Beskrivelse</th>
		  							<th>Informasjon</th>
		  						</tr>
		  					</thead>
		  					<tbody>
		  						<tr>
		  							<td>Type</td>
		  							<td>{{ ucfirst($partnership->type_samarbeid) }}</td>
		  						</tr>
		  						<tr>
		  							<td>Student</td>
		  							<td>
		  								<a href="bruker/{{ $partnership->student_id }}"">{{ $partnership->student_fornavn }} {{ $partnership->student_etternavn }}
		  								</a>
	  								</td>
		  						</tr>
		  						<tr>
		  							<td>Bedriftdent</td>
		  							<td>
		  								<a href="bruker/{{ $partnership->bedrift_id }}"">{{ $partnership->bedrift_navn }}
		  								</a>
	  								</td>
		  						</tr>
		  						<tr>
		  							<td>Kontrakt</td>
		  							<td>
		  								<a class="btn btn-primary btn-small" href="uploads/{{ $partnership->arbeidsbesk }}"">
		  									<span class="fa fa-file-pdf-o"></span> LAST NED
		  								</a>
	  								</td>
		  						</tr>
		  						<tr>
		  							<td>Arbeidsbeskrivelse</td>
		  							<td>
		  								<a class="btn btn-primary btn-small" href="uploads/{{ $partnership->kontrakt }}"">
		  									<span class="fa fa-file-pdf-o"></span> LAST NED
		  								</a>
	  								</td>
		  						</tr>
		  					</tbody>
	  					</table>

	    				<div class="row">
	    					<div class="col-sm-4">
		    					<form class="is-fullwidth" action="" method="post">
		    						{{ csrf_field() }}

		    						<button type="button" class="submitBtn btn btn-sm btn-danger m-r-s is-fullwidth">MANGELFUL DOKUMENTASJON</button>
		  						</form>
	  						</div>

	  						<div class="col-sm-8">
		  						<form class="is-fullwidth" method="post" action="godkjennDokumenter/{{ $partnership->id }}">
		  							{{ csrf_field() }}
		  							<input type="hidden" class="confirmMsg" value="Er du sikker på at du vil godkjenne dokumentasjonen?">
		      					<button type="button" class="submitBtn btn btn-sm btn-success m-l-s is-fullwidth">GODKJENN KONTRAKT OG ARBEIDSBESKRIVELSE</button>
		  						</form>
	  						</div>
	          	</div>
						</div>
	    		</li>
	      @endif
	    @endforeach
	  </div>
	</div>

@elseif ($type == "aktive-samarbeid")
	<div id="aktive-samarbeid" class="panel panel-default">
	  <div class="panel-heading">
	    <p class="h3 panel-title"><span class="fa fa-handshake-o"></span> Aktive samarbeid</p>
	  </div>
	  <div class="panel-body">
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
	  </div>
	</div>
@endif