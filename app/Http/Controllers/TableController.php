<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\News;

class TableController extends Controller
{
    function __construct()
    {
       /* $this->middleware('auth');*/
    }

    public function index()
    {
        //Action bei $_POST[]
        //If Edit...

        //If Create...

        //If Delete...

        $data = News::all();

        return view('home', [
            "data" => $data,
        ]);
    }
}
