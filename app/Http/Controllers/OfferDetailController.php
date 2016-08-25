<?php

namespace App\Http\Controllers;

use App\OfferDetail;
use Illuminate\Http\Request;

use App\Http\Requests;

class OfferDetailController extends Controller
{
    public function index()
    {
        return OfferDetail::all()->sortBy('updated_at');
    }
}
