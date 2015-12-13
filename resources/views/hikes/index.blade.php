@extends('layouts.master')

@section('title', 'Your hikes')

@section('content')

    <div class="container">

        <h1>{{ $welcome }}</h1>
        <p>As of today, you've hiked {{ $count }} of the White Mountain Four Thousand Footers. <a href="/peaks">See details.</a></p>
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="48" style="width: {{ $progress }}%;"></div>
        </div>

        @if(sizeof($hikes) == 0)
            <div class="nohikes">
                <p>You haven't logged any hikes yet.</p>
                <p><a class="btn btn-primary" href="/hikes/log">Log one now!</a></p>
            </div>
        @else
            <div class="userhikes">
                @foreach($hikes as $hike)
                    <div class="userhike{{ $hike->private }}">
                        @if($hike->public == 0)
                            <i class="fa fa-lock"></i>
                        @endif
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
                            {{ $hike->mileage > 0 ? $hike->mileage . ' miles &middot;' : '' }}  {{ $hike->date_hiked }}
                        </p>
                        <p class="hikeactions">
                            <a href="/hikes/edit/{{ $hike->id }}"><i class="fa fa-pencil"></i></a>
                            <a href="/hikes/confirm-delete/{{ $hike->id }}"><i class="fa fa-trash-o"></i></a>
                            <a href="/hikes/show/{{ $hike->id }}"><i class="fa fa-ellipsis-h"></i></a>
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    
@stop

