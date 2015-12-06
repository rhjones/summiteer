@extends('layouts.master')

@section('title', 'Delete Hike')


@section('content')

	@if(!isset($hike))
		<p>Hike not found.</p>
	@else

		<p>
			@foreach($hike->peaks as $peak)
				{{ $peak->name }}
			@endforeach
		</p>
		<p>{{ $hike->mileage ? $hike->mileage . ' miles' : '' }}
	    <p>
	        Are you sure you want to delete this hike?
	    </p>

	    <p>
	    	<a href="/hikes/delete/{{ $hike->id }}">Yes.</a>
	    </p>
	@endif

@stop