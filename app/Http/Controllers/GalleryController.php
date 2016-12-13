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

    function uploadPicture($file, $id, $category)
{
    $filepath = pathinfo($file);
    $accepted_extensions = Array('image/bmp', 'image/gif', 'image/jpeg', 'image/jpg', 'image/png');

    if ($file != "") {
        //Pruefen, ob richtiges Format!!! (.jpg, .png)
        if (in_array($file->getClientMimeType(), $accepted_extensions)) {
            $file->move("./files/temp", $file->getClientOriginalName());
            $image = Image::make('./files/temp/' . $file->getClientOriginalName());
            $image = resizePicture($image);
            $image = $image->save('./files/' . $category . '_' . $id . '.jpg', 80);
            File::delete("./files/temp/" . $file->getClientOriginalName());
        } else {
            Session::flash('error', 'Beim Bildupload gab es einen Fehler!');
        }
    }
}

function deletePicture($id, $category)
{
    File::delete("./files/" . $category . "_" . $id . ".jpg");
}

function resizePicture($image)
{
    $limit = 800;
    $height = $image->height();
    $width = $image->width();

    if ($width > $height && $height > $limit) {
        $scaling = $height / $limit;
        $newwidth = $width / $scaling;
        $image = $image->resize($newwidth, $limit);
    } else if ($height > $width && $width > $limit) {
        $scaling = $width / $limit;
        $newheight = $height / $scaling;
        $image = $image->resize($limit, $newheight);
    }

    return $image;
}
}
