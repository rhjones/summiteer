@extends('layouts.master')

@section('title', ($peak ? $peak->name : 'Uh-oh.'))


@section('content')

    @if(!isset($peak))
        We can't seem to find the peak you're looking for. Want to try again? Here's a <a href="/peaks">list of all the peaks</a>.
    @else
        <p>Elevation: {{ $peak->elevation }}</p>
        <p>Prominence: {{ $peak->prominence }}</p>
        <p>Range: {{ $peak->range }}</p>
       	<p>Location: {{ $peak->location }}, {{ $peak->state }}</p>
       	<p><a href="{{ $peak->description_link }}">More info</a> | <a href="{{ $peak->forecast_link }}">Summit forecast</a></p>
    @endif

    @if(sizeof($public_hikes) == 0)
        <p>No public hikes have been logged for {{ $peak->name }}. 
            @if(Auth::check())
                <a href="/hikes/log">
            @else
                <a href="/login">
            @endif
            Log one now!</a>
        </p>
    @else
        @foreach($public_hikes as $public_hike)
        	<div class="publichike">
        		<p>{{ $public_hike->user->first_name ? $public_hike->user->first_name : $public_hike->user->username }} hiked {{ $peak->name }} <a href="/hikes/show/{{ $public_hike->id }}">{{ $public_hike->date_hiked }}</a></p>
        	</div>
        @endforeach
    @endif

    
@stop