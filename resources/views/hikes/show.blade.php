@extends('layouts.master')

@section('title', 'View hike')

@section('content')

<div class="container">

	@if(!isset($hike))
        <p>We can't seem to find the hike you're looking for.</p>
    @else
    	@if((!$hike->public) && (Auth::id() !== $hike->user->id))
	    	<h1 class="error"><i class="fa fa-ban"></i> Uh oh.</h1>
			<p>Whoops! This hike was logged privately. Try choosing a <a href="/peaks">peak</a> to find some public hikes.</p>
	    @else

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
	                {{ $hike->user->first_name ? $hike->user->first_name : $hike->user->username }} &middot;
	                {{ ($hike->mileage > 0) ? $hike->mileage . ' miles &middot;' : '' }} 
	                {{ $hike->date_hiked }}
	            </p>	

	            @if(Auth::id() === $hike->user->id)
		    		<p class="hikeactions">
                        <a href="/hikes/edit/{{ $hike->id }}"><i class="fa fa-pencil"></i></a>
                        <a href="/hikes/confirm-delete/{{ $hike->id }}"><i class="fa fa-trash-o"></i></a>
                    </p>
		    	@endif
	            	
	    	</div>


	    	
		@endif

    @endif
</div>

    
@stop