@extends('layouts.app')



@section('content')

    @include('includes.messages')

    {!! Form::open(['method'=>'POST', 'action'=>'PhotosController@store','files'=>true]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->

    <div class="form-group">

        {!! Form::label('title', 'Photo Title') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}


    </div>
    <div class="form-group">

        {!! Form::label('description', 'Photo Description') !!}
        {!! Form::textarea('description', null, ['class'=>'form-control']) !!}


    </div>
    <input type="hidden" name="album_id" value="{{$album_id}}"> <!--.passed in through photos controller @create.  relates photo to album . in the controller, in create method, create photo with album id, then add album_id as hidden input in photos to relate them-->

    <div class="form-group">

        {!! Form::file('file', ['class'=>'btn btn-primary']) !!}
    </div>


    <div class="form-group">

        {!! Form::submit('Upload', ['class'=>'btn btn-primary']) !!}
    </div>


    {!! Form::close() !!}
@stop




