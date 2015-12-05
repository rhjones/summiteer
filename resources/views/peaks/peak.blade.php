@extends('layouts.master')

@section('title', 'Peaks')

@section('content')

    @if(!isset($id))
        You have not specified a peak
    @else
        <p>Show peak: {{ $id }}</p>
    @endif

    
@stop