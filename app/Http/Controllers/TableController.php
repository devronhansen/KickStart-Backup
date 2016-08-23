<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\News;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class TableController extends Controller
{
    function __construct()
    {
        /*$this->middleware('auth');*/
    }

    public function index()
    {
        $news = News::all();

        /*
        $img = Image::canvas(800, 600, '#c00')->save('files\bar.png');;
        $imgstring = $img->dirname."/".$img->basename;

        foreach ($news as $data) {
            if($data->picture == "")
            {
                $data->picture = $imgstring;
            }
        }
        */

        return view('home', [
            "news" => $news,
        ]);
    }
}
