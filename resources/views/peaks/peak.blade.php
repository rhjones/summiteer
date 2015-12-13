@extends('layouts.master')

@section('title', ($peak ? $peak->name : 'Uh oh.'))


@section('content')

    <div class="container-fluid">

        @if(!isset($peak))
            <h1 class="error"><i class="fa fa-ban"></i> Uh oh.</h1>
            <p>We can't seem to find the peak you're looking for. Want to try again? Here's a <a href="/peaks">list of all the peaks</a>.</p>
        @else

            <div class="row">

                <div class="col-md-4">
                    <div class="peakinfo">
                        <h1>Mount {{ $peak->name }}</h1>
                        <p>
                            <a href="{{ $peak->description_link }}"><i class="fa fa-info-circle"></i> More info</a><br /> 
                            <a href="{{ $peak->forecast_link }}"><i class="fa fa-cloud"></i> Summit forecast</a>
                        </p>
                        <p><em>Elevation</em><br />{{ $peak->elevation }} feet</p>
                        <p><em>Prominence</em><br />{{ $peak->prominence }} feet</p>
                        <p><em>Range</em><br />{{ $peak->range }}</p>
                       	<p><em>Location</em><br />{{ $peak->location }}, {{ $peak->state }}</p>
                       	
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="publiclog">

                        @if(sizeof($public_hikes) == 0)
                            <div class="nohikes">
                                <p>No public hikes have been logged for Mount {{ $peak->name }}.</p>
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
                                            <li><a href="/peaks/{{ $peak->id }}">{{ $peak->name }}</a></li>
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
        @endif


    </div>

    
@stop