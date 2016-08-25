<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Intervention\Image\ImageManagerStatic as Image;
use App\News;
use App\Offer;
use App\OfferDetail;
use App\Person;

class TableController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $news = News::all()->sortByDesc('updated_at');
        $offer_detail = OfferDetail::all()->sortByDesc('updated_at');
        $offer = Offer::all()->sortBy('title');
        $person = Person::all()->sortBy('title');
        return view('home', [
            "news" => $news,
            "offer_detail" => $offer_detail,
            "offer" => $offer,
            "person" => $person,
        ]);
    }
}
