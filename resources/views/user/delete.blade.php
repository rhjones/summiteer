@extends('layouts.master')

@section('title', 'Delete Account')


@section('content')

	@if(!isset($user))
		<p>Account not found.</p>
	@elseif($user->id !== Auth::id())
		<p>You are not authorized to access this page.</p>
	@else

	    <p>
	        Are you sure you want to delete your account, {{ $user->first_name ? $user->first_name : $user->userame }}?
	    </p>

	    <p>If you delete your account, you will not be able to regain access to your logged hikes.</p>

	    <p><a href="/user/delete/{{ $user->username }}">Delete account</a></p>

	    <p><a href="/hikes">Cancel</a></p>

	@endif

@stop