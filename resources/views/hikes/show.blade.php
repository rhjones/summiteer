@extends('layouts.master')

@section('title', 'Display a hike')

@section('content')

	@if(!isset($hike))
        <p>We can't seem to find the hike you're looking for.</p>
    @else
    	@if((!$hike->public) && (Auth::id() !== $hike->user->id))
			<p>Whoops! This hike was logged privately. Try choosing a <a href="/peaks">peak</a> to find some public hikes.</p>
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

	    	@if(Auth::id() === $hike->user->id)
	    		<p><a href="/hikes/edit/{{ $hike->id }}">Edit</a> | <a href="/hikes/confirm-delete/{{ $hike->id }}">Delete</a></p>
	    	@endif
		@endif

    @endif

    
@stop