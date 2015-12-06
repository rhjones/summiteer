@extends('layouts.master')

@section('title', 'Edit a hike')

@section('content')

	<p><a href="/hikes/confirm-delete/{{ $hike->id }}">Delete this hike</a></p>

    <form method="POST" action="/hikes/edit">

    	{!! csrf_field() !!}

    	<input type='hidden' name='id' value='{{ $hike->id }}'>
	
		<fieldset name="peaks">
			<legend>Peak(s) Hiked*</legend>
        	<ul class="columns">
		        @foreach($peak_list as $peak_id => $peak_name )
	                <? $checked = (in_array($peak_id,$peaks_for_this_hike)) ? 'CHECKED' : '' ?> 
	                <li><input {{ $checked }} type="checkbox" name="peaks[]" id="{{ $peak_id }}" value='{{ $peak_id }}'>
	                <label for="{{ $peak_id }}">{{ $peak_name }}</label></li>
		        @endforeach
		    </ul>
		</fieldset>

		<div class="form-group">
			<label for="date_hikes">Date Hiked*</label>
			<input type="date" name="date_hiked" id="date_hiked" value="{{ $hike->date_hiked }}">
		</div>
    	

    	<div class="form-group">
            <label for="mileage">Mileage</label>
            <input type="number" name="mileage" id="mileage" value="{{ $hike->mileage }}">
        </div>

        <fieldset class="rating">
		    <legend>Rating</legend>
		    @for ($i = 5; $i > 0; $i--)
		    	<? $checked = ($hike->rating == $i ? 'checked' : '') ?>
		    	<input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ $checked }}><label for="star{{ $i }}">{{ $i }} stars</label>
		    @endfor
		</fieldset>

		<div class="form-group">
			<label for="notes">Notes</label>
			<textarea name="notes" id="notes" rows="10" cols="50">{{ $hike->notes }}</textarea>
		</div>

		<div class="form-group">
            <input type="checkbox" name="public" id="public" {{ $hike->public ? '1' : '0' }} >
            <label for="public">Public</label>
        </div>

        

        <button type="submit">Log hike</button>

    </form>
    
@stop