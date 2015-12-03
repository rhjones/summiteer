@extends('layouts.master')

@section('title', 'Peaks')

@section('content')

    @if(sizeof($peaks) == 0)
        There are no peaks.
    @else
    	<table>
		<thead>
			<tr>
				<th>Peak</th>
				<th>Elevation</th>
				<th>Prominence</th>
				<th>Location</th>
				<th>Range</th>
			</tr>
		</thead>

        @foreach($peaks as $peak)
            <tr>
                <td>{{ $peak->name }} <a href="{{ $peak->description_link }}">description (icon TK)</a> <a href="{{ $peak->forecast }}">forecast (icon TK)</a></td>
                <td>{{ $peak->elevation }}</td>
                <td>{{ $peak->prominence }}</td>
                <td>{{ $peak->location }}, {{ $peak->state }}</td>
                <td>{{ $peak->range }}</td>
                <td>{{ $peak->elevation }}</td>
            </tr>
        @endforeach
        </table>
    @endif
    
@stop