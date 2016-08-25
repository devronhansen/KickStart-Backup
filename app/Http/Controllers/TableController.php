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
        $this->middleware('auth');
    }

    public function index()
    {
        $order = 'updated_at';
        $news = News::all()->sortByDesc($order);

        return view('home', [
            "news" => $news,
        ]);
    }
}
