@extends('layouts.master')

@section('title', 'Hikes')

@section('content')

    @if(sizeof($hikes) == 0)
        You haven't logged any hikes yet. <a href="/hikes/log">Log one now!</a>
    @else
        @foreach($hikes as $hike)
        	<div class="hike">
        		<h1>
	        		@foreach($hike->peaks as $peak)
	        			{{ $peak->name }}
	        		@endforeach
	        		{{ $hike->rating }}
	        	</h1>
        		<p>{{ $hike->notes }}</p>
        		<p>{{ $hike->mileage }} miles</p>
        		<p><a href="/hike/{{ $hike->id }}">{{ $hike->date_hiked }}</a></p>
        	</div>
        @endforeach
    @endif
    
@stop

