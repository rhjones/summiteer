@extends('layouts.master')

@section('title', 'Home')

@section('content')
	@if(sizeof($public_hikes) == 0)
        No public hikes have been logged yet. <a href="/hikes/log">Log one now!</a>
    @else
        @foreach($public_hikes as $public_hike)
        	<div class="publichike">
        		<p>{{ $public_hike->user->username }} hiked 
        			@foreach($public_hike->peaks as $peak)
	        			{{ $peak->name }}
	        		@endforeach 
	        		<a href="/hike/{{ $public_hike->id }}">{{ $public_hike->date_hiked }}</a></p>
        		<p>{{ $public_hike->rating }}</p>
        		<p>{{ $public_hike->notes }}</p>
        	</div>
        @endforeach
    @endif

@stop
