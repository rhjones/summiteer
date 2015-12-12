@extends('layouts.master')

@section('title', 'Home')

@section('pagetitle', 'Home')

@section('content')
	@if(sizeof($public_hikes) == 0)
        No public hikes have been logged yet. <a href="/hikes/log">Log one now!</a>
    @else
        @foreach($public_hikes as $public_hike)
        	<div class="publichike">
        		{{ $public_hike->user->first_name ? $public_hike->user->first_name : $public_hike->user->username }} hiked 
        			<ul class="peaklist">
                        @foreach($public_hike->peaks as $peak)
    	        			<li><a href="peaks/{{ $peak->id }}">{{ $peak->name }}</a></li>
    	        		@endforeach 
                    </ul>
	        		<a href="/hikes/show/{{ $public_hike->id }}">{{ $public_hike->date_hiked }}</a>
        	</div>
        @endforeach
    @endif

@stop
