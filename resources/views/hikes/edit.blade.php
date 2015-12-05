@extends('layouts.master')

@section('title', 'Edit a hike')

@section('content')

    <form method="POST" action="/hike/edit">

    	{!! csrf_field() !!}
	
		<fieldset name="peaks">
			<legend>Peak(s) Hiked*</legend>
        	<ul class="columns">
		        @foreach($peak_list as $peak_id => $peak_name)
		        	<li><input type="checkbox" name="peaks[]" id="{{ $peak_id }}" value="{{ $peak_id }}"> 
		            <label for="{{ $peak_id }}">{{ $peak_name }}</label></li>
		        @endforeach
		    </ul>
		</fieldset>

		<div class="form-group">
			<label for="date_hikes">Date Hiked*</label>
			<input type="date" name="date_hiked" id="date_hiked">
		</div>
    	

    	<div class="form-group">
            <label for="mileage">Mileage</label>
            <input type="number" name="mileage" id="mileage" value="{{ old('mileage') }}">
        </div>

        <fieldset class="rating">
		    <legend>Rating</legend>
		    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Stellar">5 stars</label>
		    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
		    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
		    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Not great">2 stars</label>
		    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="The worst">1 star</label>
		</fieldset>

		<div class="form-group">
			<label for="notes">Notes</label>
			<textarea name="notes" id="notes" rows="10" cols="50">{{ old('notes') }}</textarea>
		</div>

		<div class="form-group">
            <input type="checkbox" name="public" id="public" checked>
            <label for="public">Public</label>
        </div>

        

        <button type="submit">Log hike</button>

    </form>
    
@stop