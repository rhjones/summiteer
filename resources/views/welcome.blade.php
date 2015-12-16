@extends('layouts.master')

@section('title', 'Home')

@section('content')

    <div class="container-fluid">

        <div class="row" id="welcome">

            <div class="col-md-4">

                <div class="enter">
                    <a class="btn btn-entry" href="{{ Auth::check() ? '/hikes/log' : '/login' }}" role="button">Start tracking</a>
                </div>
            </div>

            <div class="col-md-8">
                <div class="publiclog">
                	@if(sizeof($public_hikes) == 0)
                        <div class="nohikes">
                            <p>No public hikes have been logged yet.</p>
                            <p>
                                @if(Auth::check())
                                    <a class="btn btn-primary" href="/hikes/log">
                                @else
                                    <a class="btn btn-primary" href="/login">
                                @endif
                                Log one now!</a>
                            </p>
                        </div>
                    @else
                    
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
                    @endif
                </div>

            </div>

        </div>

    </div>
@stop

