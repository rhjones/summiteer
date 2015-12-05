@extends('layouts.master')

@section('title', 'Delete Hike')


@section('content')


    <p>
        Are you sure you want to delete this hike?
    </p>

    <p>
        <a href='hike/delete/{{$id}}'>Yes...</a>
    </p>

@stop