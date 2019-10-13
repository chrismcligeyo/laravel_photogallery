@extends('layouts.app')

@section('content')
    @include('includes.messages')
    <h3>{{$photo->title}}</h3>
    <p>{{$photo->description}}</p>
    <a href="/albums/{{$photo->album->id}}">Back to Gallery</a>
    <hr>
    <img src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt=""><!--{{$photo->album_id}} is a folder numbered with album id-->
    <br><br>
    {!! Form::open(['method'=>'DELETE', 'action'=>['PhotosController@destroy',$photo->id]]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->




    <div class="form-group">

        {!! Form::submit('Delete Photo', ['class'=>'btn btn-danger']) !!}
    </div>


    {!! Form::close() !!}

    @stop