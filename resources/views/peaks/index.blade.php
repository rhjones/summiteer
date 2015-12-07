@extends('layouts.master')

@section('title', 'Peaks')

@section('content')

    @if(sizeof($peaks) == 0)
        There are no peaks.
    @else
    	<table id="sortabletable">
			<thead>
				<tr>
					<th>Peak</th>
					<th>Elevation</th>
					<th>Prominence</th>
					<th>Location</th>
					<th>Range</th>
				</tr>
			</thead>
			
			<tbody>
	        @foreach($peaks as $peak)
	            <tr>
	                <td>{{ $peak->name }} <a href="{{ $peak->description_link }}">description (icon TK)</a> <a href="{{ $peak->forecast }}" title="Get forecast">forecast (icon TK)</a></td>
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