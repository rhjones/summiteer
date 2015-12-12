@extends('layouts.master')

@section('title', 'White Mountain 4000 Footers')

@section('content')

	<div class="container">

	    @if(sizeof($peaks) == 0)
	        <h1 class="error"><i class="fa fa-ban"></i> Uh oh.</h1>
			<p>We can't seem to find any peaks to display. Why don't you check out the <a href="/">home page</a> while we sort things out?</p>
	    @else
	    	
			<h1>New Hampshire 4000 Footers</h1>
	    	<table id="sortabletable">
				<thead>
					<tr>
						<th>Peak</th>
						@if(Auth::check())
							<th><i class="fa fa-check"></i></th>
						@endif
						<th>Elevation (ft)</th>
						<th>Prominence (ft)</th>
						<th>Range</th>

					</tr>
				</thead>
				
				<tbody>
		        @foreach($peaks as $peak)
		            <tr>
		                <td>
		                	<span class="peakdetails">
			                	<a href="{{ $peak->description_link }}"><i class="fa fa-info-circle"></i></a>
			                	<a href="{{ $peak->forecast_link }}" title="Get forecast"><i class="fa fa-cloud"></i></a>
		                	</span>
		                	<a href="/peaks/{{ $peak->id }}">{{ $peak->name }}</a> 
		                </td>
		                @if(Auth::check())
		            		<td>
		            			@if($peak->summitted)
		            				<i class="fa fa-check"></i>
		            				<span class="sr-only">Summitted</span>
		            			@endif
		            		</td>
		            	@endif
		                <td>{{ $peak->elevation }}</td>
		                <td>{{ $peak->prominence }}</td>
		                <td>{{ $peak->range }}</td>
		            </tr>
		        @endforeach
		        </tbody>
	        </table>
	    @endif
    </div>

@stop

@section('body')
	<script src="js/jquery.tablesorter.min.js"></script>
	<script src="js/summiteer.js"></script>
@stop