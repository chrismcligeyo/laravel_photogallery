@extends('layouts.app')


@section('content')

    <h1>Albums</h1>



    @if(count($albums) > 0)

    <!--display the albums in a grid, to loopthrough three,for column grid requires extra code-->
    <div class="row text-center">

        @foreach($albums as $album)

        <div class="col md-4">
            <a href="/albums/{{$album->id}}">
                <img class="thumbnail" width="300"src="storage/images/{{$album->cover_image}}" alt="">

            </a>
            <br>
            <h4>{{$album->name}}</h4>
        </div>

            @endforeach
    </div>
        @else
        <p>No album to display</p>

@endif

    @stop