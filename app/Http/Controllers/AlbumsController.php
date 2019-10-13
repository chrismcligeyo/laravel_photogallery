<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $albums = Album:: all();//with('Photos')->get(); //will return albums with it photos relationship

        return view('albums.index',compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
                'name' => 'required',
                'cover_image' => 'image|max:1999' //should be an image with max upload of 1999kb(2mb)
            ]

        );
        //gives us image plus file name which is okay but user can enter image with same names that can be an issue in dbase. to avoid, add time tofilename
//        return $request->file('cover_image')->getClientOriginalName(); ///givesus image name

        //get file name wih extionsion
        $file_name_with_extension = $request->file('cover_image')->getClientOriginalName();

        //get filename
        $file_name = pathinfo($file_name_with_extension, PATHINFO_FILENAME); //how to remove extionsion from filename. ext eg .jpg

        //get extension. gives the extension withouth the dot i.e jpg, not .jpg, we will have to add dot on our own

        $extension = $request->file('cover_image')->getClientOriginalExtension();

        //create new file name
        $filenameForDatabase = $file_name . '_' . time() . '.' . $extension; //filename with _ and time added to filename then the extinsion

//        return $filenameForDatabase; //60 watts solar powered floodlights_1569849097.jpg

        //upload image
        $path = $request->file('cover_image')->storeAs('public/images', $filenameForDatabase); //storeAs same as move function



        $album = new Album;

        $album->name = $request->input('name');
        $album->description = $request->input('description');
        $album->cover_image = $filenameForDatabase;

        $album->save();



        //session
        session()->flash('success', 'Album Created');


        return redirect('/albums');


        //other way to include session with the redirect
//        return redirect('/albums')->with('success','Album Created');


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //display a single album

        $album = Album:: findOrFail($id);//   $album = Album::with('Photos')->findOrFail($id);

        //other way


//          $photo = Album::findOrFail($id);
//          return view('albums.show')->with('photo',$photo->album->id);// in albums how use $photo->album



        return view('albums.show')->with('album',$album);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
