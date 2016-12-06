<?php

namespace App\Http\Controllers;

use App\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        return Gallery::all();
    }
}
