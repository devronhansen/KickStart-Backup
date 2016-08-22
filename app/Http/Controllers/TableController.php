<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class TableController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('home', ["users" => $users]);
    }
}
