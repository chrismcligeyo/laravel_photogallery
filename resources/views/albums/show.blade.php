@extends('layouts.app')



@section('content')


  <h1>{{$album->name}}</h1>
  <a class="btn btn-primary" href="/">Go back</a>
  <a class="btn btn-primary" href="/photos/create/{{$album->id}}">Upload Photo to Abum</a>
  <hr>

  <!--display photos in individual album pages-->

  @if(count($album->photos) > 0)

    <!--display the albums in a grid, to loopthrough three,for column grid requires extra code-->
    <div class="row text-center">

      @foreach($album->photos as $photo)

        <div class="col md-4">
          <a href="/photos/{{$photo->id}}"><!--each photo in album has own photo id-->
            <img class="thumbnail" width="200"src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="">

          </a>
          <br>
          <h4>{{$photo->title}}</h4>
        </div>

      @endforeach
    </div>
  @else
    <p>No Photos to display</p>

  @endif
    @stop