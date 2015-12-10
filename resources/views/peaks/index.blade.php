@extends('layouts.master')

@section('title', 'White Mountain 4000 Footers')

@section('content')

    @if(sizeof($peaks) == 0)
        There are no peaks.
    @else
    	<table id="sortabletable">
			<thead>
				<tr>
					<th>Peak</th>
					@if(Auth::check())
						<th>Summitted</th>
					@endif
					<th>Elevation</th>
					<th>Prominence</th>
					<th>Location</th>
					<th>Range</th>
				</tr>
			</thead>
			
			<tbody>
	        @foreach($peaks as $peak)
	            <tr>
	                <td><a href="/peaks/{{ $peak->id }}">{{ $peak->name }}</a> <a href="{{ $peak->description_link }}">description (icon TK)</a> <a href="{{ $peak->forecast }}" title="Get forecast">forecast (icon TK)</a></td>
	                @if(Auth::check())
	            		<? $summitted = in_array($peak->id,$peaks_summitted); ?>
	            		<td>
	            			@if($summitted)
	            				<i class="fa fa-check"></i>
	            			@endif
	            		</td>
	            	@endif
	                <td>{{ $peak->elevation }}</td>
	                <td>{{ $peak->prominence }}</td>
	                <td>{{ $peak->location }}, {{ $peak->state }}</td>
	                <td>{{ $peak->range }}</td>
	            </tr>
	        @endforeach
	        </tbody>
        </table>
    @endif
    
@stop

@section('body')
	<script src="js/jquery.tablesorter.min.js"></script>
	<script src="js/summiteer.js"></script>
@stop