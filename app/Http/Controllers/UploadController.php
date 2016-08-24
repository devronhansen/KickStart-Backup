<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use App\Http\Requests;
use Session;

class UploadController extends Controller
{
    public function uploadPicture($file, $id, $category)
    {
        $filepath = pathinfo($file);
        $accepted_extensions = Array('image/bmp', 'image/gif', 'image/jpeg', 'image/jpg','image/png');

        if($file != "")
        {
            //Pruefen, ob richtiges Format!!! (.jpg, .png)
            if (in_array($file->getClientMimeType(), $accepted_extensions)){
                $file->move("./files/temp", $file->getClientOriginalName());
                $image = Image::make('./files/temp/' . $file->getClientOriginalName());
                $imgae = $this->resizePicture($image);
                $image = $image->save('./files/' . $category . '_'. $id .'.png');
                File::delete("./files/temp/" . $file->getClientOriginalName());
            } else {
                Session::flash('error', 'Beim Bildupload gab es einen Fehler!');
            }

        }


    }

    public function deletePicture($id, $category)
    {
        File::delete("./files/" . $category . "_" . $id . ".png");
    }

    public function resizePicture($image)
    {
        $limit = 800;
        $height = $image->height();
        $width = $image->width();

        if($width > $height && $height > $limit)
        {
            $scaling = $height / $limit;
            $newwidth = $width / $scaling;
            $image = $image->resize($newwidth, $limit);
        }
        else if ($height > $width && $width > $limit)
        {
            $scaling = $width / $limit;
            $newheight = $height / $scaling;
            $image = $image->resize($limit, $newheight);
        }

        return $image;
    }
}
