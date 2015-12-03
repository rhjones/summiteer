@extends('layouts.master')

@section('title', 'Peaks')

@section('content')

    @if(!isset($name))
        You have not specified a peak
    @else
        <p>Show peak: {{ $name }}</p>
    @endif

    
@stop