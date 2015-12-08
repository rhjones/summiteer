@extends('layouts.master')

@section('title', 'Hikes')

@section('content')

    <p>{{ $welcome }}</p>
    <p>As of today, you've hiked {{ $count }} of the White Mountain Four Thousand Footers. <a href="/peaks">See details.</a></p>

    @if(sizeof($hikes) == 0)
        <p>You haven't logged any hikes yet. <a href="/hikes/log">Log one now!</a></p>
    @else
        @foreach($hikes as $hike)
            <? $private = ($hike->public == 0) ? ' private' : '' ?>
        	<div class="hike{{ $private }}">
        		<h1>
	        		@foreach($hike->peaks as $peak)
	        			{{ $peak->name }}
	        		@endforeach
	        		{{ $hike->rating }}
	        	</h1>
        		<p>{{ $hike->notes }}</p>
        		<p>{{ $hike->mileage }} miles</p>
        		<p><a href="/hikes/show/{{ $hike->id }}">{{ $hike->date_hiked }}</a></p>
                <p><a href="/hikes/edit/{{ $hike->id }}">Edit</a> | <a href="/hikes/confirm-delete/{{ $hike->id }}">Delete</a></p>
        	</div>
        @endforeach
    @endif
    
@stop

