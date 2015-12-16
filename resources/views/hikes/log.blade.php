@extends('layouts.master')

@section('title', 'Log a hike')

@section('content')

<div class="container">

	<h1>Log a hike</h1>

	@if(count($errors) > 0)
        <ul class='errors'>
            @foreach ($errors->all() as $error)
                <li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
            @endforeach
        </ul>
    @endif

	    <form method="POST" action="/hikes/log">

	    	{!! csrf_field() !!}
		
			<div class="form-group">
				<label for="date_hikes">Date of Hike*</label>
				<input type="date" class='form-control' name="date_hiked" id="date_hiked" max="9999-12-31">
			</div>
	    	

	    	<div class="form-group">
	            <label for="mileage">Mileage</label>
	            <input type="number" class='form-control' name="mileage" id="mileage" step="any" value="{{ old('mileage') }}">
	        </div>

	        <fieldset name="peaks">
				<legend>Peak(s) Hiked*</legend>
	        	<ul class="columns">
			        @foreach($peak_list as $peak_id => $peak_name)
			        	<li><input type="checkbox" name="peaks[]" id="{{ $peak_id }}" value="{{ $peak_id }}"> 
			            <label for="{{ $peak_id }}">{{ $peak_name }}</label></li>
			        @endforeach
			    </ul>
			</fieldset>

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
				<textarea name="notes" class='form-control' id="notes" rows="3" cols="50">{{ old('notes') }}</textarea>
			</div>

			<div class="form-group">
	            <input type="checkbox" name="public" id="public" checked>
	            <label for="public">Public</label>
	        </div>

	        

	        <button type='submit' class='btn btn-primary'>Log hike</button>


	    </form>

</div>
    
@stop