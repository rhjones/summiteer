@extends('layouts.master')

@section('title', 'Edit your account')

@section('content')

<div class="container">

	@if(!isset($user))
		<p>Account not found.</p>
	@else

		<div class="centerbox">

			<h1>Account settings 
				<small><a href="/user/confirm-delete/{{ $user->username }}"><i class="fa fa-trash-o"></i> delete account</a></small>
			</h1>
			@if(count($errors) > 0)
		        <ul class='errors'>
		            @foreach ($errors->all() as $error)
		                <li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
		            @endforeach
		        </ul>
		    @endif


		    <form method="POST" action="/user/edit">

		    	{!! csrf_field() !!}

		    	<input type='hidden' name='id' value='{{ $user->id }}'>
			
				<div class='form-group'>
		            <label for='username'>User Name*</label>
		            <input type='text' class='form-control' name='username' id='username' value='{{ $user->username }}'>
		        </div>

		        <div class='form-group'>
		            <label for='first_name'>First Name</label>
		            <input type='text' class='form-control' name='first_name' id='first_name' value='{{ $user->first_name }}'>
		        </div>

		        <div class='form-group'>
		            <label for='last_name'>Last Name</label>
		            <input type='text' class='form-control' name='last_name' id='last_name' value='{{ $user->last_name }}'>
		        </div>

		        <div class='form-group'>
		            <label for='email'>Email*</label>
		            <input type='text' class='form-control' name='email' id='email' value='{{ $user->email }}'>
		        </div>

		        <div class='form-group'>
		            <label for='current_password'>Current Password*</label>
		            <input type='password' class='form-control' name='current_password' id='current_password'>
		        </div>

		        <div class='form-group'>
		            <label for='password'>New Password</label>
		            <input type='password' class='form-control' name='password' id='password'>
		        </div>

		        <div class='form-group'>
		            <label for='password_confirmation'>Confirm New Password</label>
		            <input type='password' class='form-control' name='password_confirmation' id='password_confirmation'>
		        </div>

		        <button type='submit' class='btn btn-primary'>Save changes</button>

		    </form>
		</div>
	@endif

</div>
    
@stop