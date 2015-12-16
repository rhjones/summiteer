@extends('layouts.master')

@section('title', 'Edit a hike')

@section('content')

<div class="container">

	
	@if(!isset($hike))
		<p>Hike not found.</p>
	@elseif($hike->user_id != Auth::id())
		<h1 class="error"><i class="fa fa-ban"></i> Uh oh.</h1>
		<p>This hike doesn't belong to you. Why don't you check out <a href="/hikes">your hikes</a> instead?</p>
	@else
		<h1>Edit your hike <small><a href="/hikes/confirm-delete/{{ $hike->id }}"><i class="fa fa-trash-o"></i> delete</a></small></h1>

		@if(count($errors) > 0)
	        <ul class='errors'>
	            @foreach ($errors->all() as $error)
	                <li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
	            @endforeach
	        </ul>
	    @endif

	    <form method="POST" action="/hikes/edit">

	    	{!! csrf_field() !!}

	    	<input type='hidden' name='id' value='{{ $hike->id }}'>

			<div class="form-group">
				<label for="date_hikes">Date of Hike*</label>
				<input type="date" class='form-control' name="date_hiked" id="date_hiked" value="{{ $hike->date_hiked }}" max="9999-12-31">
			</div>
	    	

	    	<div class="form-group">
	            <label for="mileage">Mileage</label>
	            <input type="number" class='form-control' name="mileage" id="mileage" step="any" value="{{ $hike->mileage }}">
	        </div>

	        <fieldset name="peaks">
				<legend>Peak(s) Hiked*</legend>
	        	<ul class="columns">
			        @foreach($peak_list as $peak_id => $peak_name )
		                <li>
		                	<input 
		                	@if(in_array($peak_id,$peaks_for_this_hike))
		                		checked
		                	@endif
		                	type="checkbox" name="peaks[]" id="{{ $peak_id }}" value='{{ $peak_id }}'>
		                <label for="{{ $peak_id }}">{{ $peak_name }}</label></li>
			        @endforeach
			    </ul>
			</fieldset>

	        <fieldset class="rating">
			    <legend>Rating</legend>
				    @for ($i = 5; $i > 0; $i--)
				    	<input type="radio"
				    	@if($hike->rating == $i)
		    				checked
		    			@endif
				    	id="star{{ $i }}" name="rating" value="{{ $i }}"><label for="star{{ $i }}">{{ $i }} stars</label>
				    @endfor
			</fieldset>

			<div class="form-group">
				<label for="notes">Notes</label>
				<textarea name="notes" class='form-control' id="notes" rows="3" cols="50">{{ $hike->notes }}</textarea>
			</div>

			<div class="form-group">
	            <input type="checkbox" name="public" id="public" {{ $hike->public ? '1' : '0' }} >
	            <label for="public">Public</label>
	        </div>

	        

	        <button type='submit' class='btn btn-primary'>Save edits</button>

	    </form>
	@endif
</div>
    
@stop