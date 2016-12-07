<?php

namespace App\Http\Controllers;

use App\Offer;

class OfferController extends Controller
{
    public function index()
    {
        return Offer::all();
    }
}
