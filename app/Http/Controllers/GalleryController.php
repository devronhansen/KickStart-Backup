<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;


class GalleryController extends Controller
{
    public function index()
    {
        return Gallery::all();
    }

    public function postUpload(Request $request)
    {
        $new_image = new Gallery();

        $file = $request->file('file');
        $new_image->image = $file->getClientOriginalName();
        $accepted_extensions = Array('image/bmp', 'image/gif', 'image/jpeg', 'image/jpg', 'image/png');

        if ($file != "") {
            //Pruefen, ob richtiges Format!!! (.jpg, .png)
            if (in_array($file->getClientMimeType(), $accepted_extensions)) {
                $file->move("./files/temp", $file->getClientOriginalName());
                $image = Image::make('./files/temp/' . $file->getClientOriginalName());
                $image->save("./files/gallery/".$file->getClientOriginalName(), 80);
                File::delete("./files/temp/" . $file->getClientOriginalName());
            } else {
                Session::flash('error', 'Beim Bildupload gab es einen Fehler!');
            }
        }
        $new_image->save();

        return back();
    }

    public function postDestroy(Request $request)
    {
        $image = $request->input('id');
        Gallery::where('image', $image)->first()->delete();
        File::delete("./files/gallery/" . $image);
        return "test";
    }
}
