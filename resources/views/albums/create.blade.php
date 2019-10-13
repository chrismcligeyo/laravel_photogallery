@extends('layouts.app')


@section('content')

    <h1>Create Album</h1>

    @include('includes.messages')

    {!! Form::open(['method'=>'POST', 'action'=>'AlbumsController@store','files'=>true]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->

    <div class="form-group">

        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}


    </div>
    <div class="form-group">

            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control']) !!}


        </div>

    <div class="form-group">

            {!! Form::file('cover_image', ['class'=>'btn btn-primary']) !!}
        </div>


    <div class="form-group">

        {!! Form::submit('Upload', ['class'=>'btn btn-primary']) !!}
    </div>


    {!! Form::close() !!}


@stop