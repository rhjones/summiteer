@extends('layouts.master')

@section('title', 'Delete Account')


@section('content')

<div class="container">

	@if(!isset($user))
		<p>Account not found.</p>
	@elseif($user->id !== Auth::id())
		<h1 class="error"><i class="fa fa-ban"></i> Uh oh.</h1>
		<p>You're not authorized to edit this page. Why don't you check out <a href="/hikes">your hikes</a> instead?</p>
	@else

	    <h1>
	        Are you sure?
	        <small>We hate to see you go, {{ $user->first_name ? $user->first_name : $user->userame }}</small>
	    </h1>

	    <p>If you delete your account, you will not be able to regain access to your logged hikes.</p>

	    <p>
	    	<a class="btn btn-primary" href="/user/delete/{{ $user->username }}"><i class="fa fa-trash-o fa-lg"></i> Delete account</a>
			<a class="btn btn-primary" href="/hikes">Cancel</a>
		</p>

	@endif

</div>

@stop