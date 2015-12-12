@extends('layouts.master')

@section('title', 'Home')

@section('content')

    <div class="container-fluid">

        <div class="row" id="welcome">

            <div class="col-md-3">

                <div class="enter">
                    <a class="btn btn-entry" href="{{ Auth::check() ? '/log' : '/login' }}" role="button">Start tracking</a>
                </div>
            </div>

            <div class="col-md-9">

            	@if(sizeof($public_hikes) == 0)
                    No public hikes have been logged yet. <a href="/hikes/log">Log one now!</a>
                @else
                    <div class="publiclog">
                        @foreach($public_hikes as $public_hike)
                        	<div class="publichike">
                    			<ul class="peaklist">
                                    @foreach($public_hike->peaks as $peak)
                	        			<li><a href="peaks/{{ $peak->id }}">{{ $peak->name }}</a></li>
                	        		@endforeach 
                                </ul>
                                <p class="notes">
                                    <span class="hike-rating">
                                        @for($i = 0; $i < $public_hike->rating; $i++)
                                                <i class="fa fa-star"></i>
                                        @endfor
                                    </span>
                                    {{ $public_hike->notes }}
                                </p>	
                                <p class="details">
                                    {{ $public_hike->user->first_name ? $public_hike->user->first_name : $public_hike->user->username }} 
                                    &middot; 
                                    {{ $public_hike->date_hiked }}
                                </p>	
                        	</div>
                        @endforeach
                    </div>
                @endif

            </div>

        </div>

    </div>
@stop

