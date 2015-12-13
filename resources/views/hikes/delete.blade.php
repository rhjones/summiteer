@extends('layouts.master')

@section('title', 'Delete Hike')


@section('content')

<div class="container">

	@if(!isset($hike))
		<p>Hike not found.</p>
	@elseif($hike->user_id != Auth::id())
		<h1 class="error"><i class="fa fa-ban"></i> Uh oh.</h1>
		<p>This hike doesn't belong to you. Why don't you check out <a href="/hikes">your hikes</a> instead?</p>
	@else

		<h1>
	        Are you sure?
	    </h1>

	    <span>
	    	If you delete this hike, it's gone forever. You'll basically have to hike 
	    	<ul class="peaklist">
                @foreach($hike->peaks as $peak)
        			<li><a href="peaks/{{ $peak->id }}">{{ $peak->name }}</a></li>
        		@endforeach 
            </ul>
            again for it to count.
        </span>

	    <div class="singlehike">
			<ul class="peaklist">
                @foreach($hike->peaks as $peak)
        			<li><a href="peaks/{{ $peak->id }}">{{ $peak->name }}</a></li>
        		@endforeach 
            </ul>
            <p class="notes">
                <span class="hike-rating">
                    @for($i = 0; $i < $hike->rating; $i++)
                            <i class="fa fa-star"></i>
                    @endfor
                </span>
                {!! nl2br(e($hike->notes)) !!}
            </p>
            <p class="details">
                {{ $hike->mileage ? $hike->mileage . ' miles' : '' }} &middot; {{ $hike->date_hiked }}
            </p>	
            	
    	</div>
		
		<p>
    		<a class="btn btn-primary" href="/hikes/delete/{{ $hike->id }}"><i class="fa fa-trash-o fa-lg"></i> Delete it</a>
    		<a class="btn btn-primary" href="/hikes">Cancel</a>
    	</p>

	@endif

</div>

@stop