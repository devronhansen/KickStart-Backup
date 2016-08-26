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
use App\Time;
use App\Menu;

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
        $time = Time::all()->sortBy('title');
        $menu = Menu::all()->sortBy('date')->keyBy('date');;
        $today = strtotime('monday this week');

        return view('home', [
            "news" => $news,
            "offer_detail" => $offer_detail,
            "offer" => $offer,
            "person" => $person,
            "time" => $time,
            "menu" => $menu,
            "today" => $today,
        ]);
    }
}
