@extends('layouts.master')

@section('title', 'Your hikes')

@section('content')

    <p>{{ $welcome }}</p>
    <p>As of today, you've hiked {{ $count }} of the White Mountain Four Thousand Footers. <a href="/peaks">See details.</a></p>

    @if(sizeof($hikes) == 0)
        <p>You haven't logged any hikes yet. <a href="/hikes/log">Log one now!</a></p>
    @else
        @foreach($hikes as $hike)
            <? $private = ($hike->public == 0) ? ' private' : '' ?>
        	<div class="hike{{ $private }}">
                <span class="hike-rating">
                    @for($i = 0; $i < $hike->rating; $i++)
                        <i class="fa fa-star"></i>
                    @endfor
                </span>
                <span class="hike-mileage">
                    {{ $hike->mileage ? $hike->mileage . ' miles' : '' }}
                </span>
                <span class="hike-head">
                    <ul class="peaklist">
                        @foreach($hike->peaks as $peak)
                            <li><a href="peaks/{{ $peak->id }}">{{ $peak->name }}</a></li>
                        @endforeach 
                    </ul>
                </span>
                <p>{!! nl2br(e($hike->notes)) !!}</p>
        		<p><a href="/hikes/show/{{ $hike->id }}">{{ $hike->date_hiked }}</a></p>
                <p><a href="/hikes/edit/{{ $hike->id }}">Edit</a> | <a href="/hikes/confirm-delete/{{ $hike->id }}">Delete</a></p>
        	</div>
        @endforeach
    @endif
    
@stop

