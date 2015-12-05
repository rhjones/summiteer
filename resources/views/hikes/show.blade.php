@extends('layouts.master')

@section('title', 'Display a hike')

@section('content')

	@if(!isset($hike))
        We can't seem to find the hike you're looking for.
    @else
    	<div class="hike">
    		<p>{{ $hike->user->first_name ? $hike->user->first_name : $hike->user->username }}</p>
    		<p>
    			@foreach($hike->peaks as $peak)
        			{{ $peak->name }}
        		@endforeach 
        		&mdash; {{ $hike->mileage ? $hike->mileage . ' miles' : '' }}
        	</p>
        	<p>{{ $hike->rating }}</p>
    		<p>{{ $hike->notes }}</p>
    	</div>
    @endif

    
@stop