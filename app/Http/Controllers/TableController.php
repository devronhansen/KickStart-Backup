<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

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

        $users = User::all();

        return view('home', [
            "users" => $users,
            'test_text' => "ich bin ein test",
            'test_id' => "1",
            'test_header' => "huhu",
        ]);
    }
}
