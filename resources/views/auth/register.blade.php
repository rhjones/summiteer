@extends('layouts.master')

@section('title', 'Register')

@section('content')

    <p>Already have an account? <a href='login'>Login here...</a></p>

    @if(count($errors) > 0)
        <ul class='errors'>
            @foreach ($errors->all() as $error)
                <li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method='POST' action='register'>
        {!! csrf_field() !!}

        <div class='form-group'>
            <label for='username'>User Name</label>
            <input type='text' name='username' id='username' value='{{ old('username') }}'>
        </div>

        <div class='form-group'>
            <label for='firstname'>First Name</label>
            <input type='text' name='firstname' id='firstname' value='{{ old('firstname') }}'>
        </div>

        <div class='form-group'>
            <label for='lastname'>Last Name</label>
            <input type='text' name='lastname' id='lastname' value='{{ old('lastname') }}'>
        </div>

        <div class='form-group'>
            <label for='email'>Email</label>
            <input type='text' name='email' id='email' value='{{ old('email') }}'>
        </div>

        <div class='form-group'>
            <label for='password'>Password</label>
            <input type='password' name='password' id='password'>
        </div>

        <div class='form-group'>
            <label for='password_confirmation'>Confirm Password</label>
            <input type='password' name='password_confirmation' id='password_confirmation'>
        </div>

        <button type='submit' class='btn btn-primary'>Register</button>

    </form>

@stop