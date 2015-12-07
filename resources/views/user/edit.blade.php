@extends('layouts.master')

@section('title', 'Edit your account')

@section('content')

	@if(!isset($user))
		<p>Account not found.</p>
	@elseif($user->id !== Auth::id())	
		<p>You are not authorized to access this page.</p>
	@else

		@if(count($errors) > 0)
	        <ul class='errors'>
	            @foreach ($errors->all() as $error)
	                <li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
	            @endforeach
	        </ul>
	    @endif

		<p><a href="/users/confirm-delete/{{ $user->username }}">Delete your account</a></p>

	    <form method="POST" action="/user/edit">

	    	{!! csrf_field() !!}

	    	<input type='hidden' name='id' value='{{ $user->id }}'>
		
			<div class='form-group'>
	            <label for='username'>User Name*</label>
	            <input type='text' name='username' id='username' value='{{ $user->username }}'>
	        </div>

	        <div class='form-group'>
	            <label for='first_name'>First Name</label>
	            <input type='text' name='first_name' id='first_name' value='{{ $user->first_name }}'>
	        </div>

	        <div class='form-group'>
	            <label for='last_name'>Last Name</label>
	            <input type='text' name='last_name' id='last_name' value='{{ $user->last_name }}'>
	        </div>

	        <div class='form-group'>
	            <label for='email'>Email*</label>
	            <input type='text' name='email' id='email' value='{{ $user->email }}'>
	        </div>

	        <div class='form-group'>
	            <label for='current_password'>Current Password*</label>
	            <input type='password' name='current_password' id='current_password'>
	        </div>

	        <div class='form-group'>
	            <label for='password'>New Password</label>
	            <input type='password' name='password' id='password'>
	        </div>

	        <div class='form-group'>
	            <label for='password_confirmation'>Confirm New Password</label>
	            <input type='password' name='password_confirmation' id='password_confirmation'>
	        </div>

	        <button type="submit">Update account</button>

	    </form>
	@endif
    
@stop