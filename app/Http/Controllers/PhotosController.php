<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $photos = Photo::all();

        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($album_id) //$album_id from url, this is forrelationship
    {
        //

        return view('photos.create')->with('album_id',$album_id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        //validate
        $this->validate($request, [
                'title' => 'required',
                'file' => 'image|max:1999' //should be an image with max upload of 1999kb(2mb)
            ]

        );
        //gives us image plus file name which is okay but user can enter image with same names that can be an issue in dbase. to avoid, add time tofilename
//        return $request->file('cover_image')->getClientOriginalName(); ///givesus image name

        //get file name wih extionsion
        $file_name_with_extension = $request->file('file')->getClientOriginalName();

        //get filename
        $file_name = pathinfo($file_name_with_extension, PATHINFO_FILENAME); //how to remove extionsion from filename. ext eg .jpg

        //get extension. gives the extension withouth the dot i.e jpg, not .jpg, we will have to add dot on our own

        $extension = $request->file('file')->getClientOriginalExtension();

        //create new file name
        $filenameForDatabase = $file_name . '_' . time() . '.' . $extension; //filename with _ and time added to filename then the extinsion

//        return $filenameForDatabase; //60 watts solar powered floodlights_1569849097.jpg

        //upload image
        $path = $request->file('file')->storeAs('public/photos/'.$request->input('album_id'), $filenameForDatabase); //storeAs same as move function




        $photo = new Photo;
        $photo->album_id = $request->input('album_id'); //from the hidden field
        $photo->title = $request->input('title');
        $photo->description = $request->input('description');
        $photo->photo = $filenameForDatabase;
        $photo->size = $request->file('file')->getSize();

        $photo->save();



        //session
        session()->flash('success', 'Photo Created');


        return redirect('/albums/'.$request->input('album_id')); //return redirect to albums folder with album_id,


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
        // show single photo

        $photo = Photo::find($id);

        return view('photos.show',compact('photo'));
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
        // below was  $photo = Photo::->findOrFail($id); with this phpstorm gives msg method-findorfail-not-found-in-class App\Photo
        $photo = Photo::query()->findOrFail($id); //query method prevents method-findorfail-not-found-in-class App\Photo msg
        //when you  delete photo in database and  delete in storagefolder in application too.storage folder sim linked to public folder. php artisan storage:link. whatever goes in to storage folder linked to public folder

        if(Storage::delete('public/photos/'.$photo->album_id.'/'.$photo->photo)){ //. public/photos/photo->album_id folder and the photo itsef.same as unlink(public_path())method :  unlink(public_path() . $user->photo->file);

            $photo->delete();// delete from db
            //session()->flash('success','Photo Deleted');
            return redirect('/albums')->with('success', 'Photo Deleted');

        }
    }
}
