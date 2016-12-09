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
use Gate;

class TableController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $monday = strtotime('monday this week');
        $startweek = $monday - (604800 * 3);
        $activetab = "";

        $news = News::all()->sortByDesc('updated_at');
        $offer_detail = OfferDetail::all()->sortByDesc('updated_at');
        $offer = Offer::all()->sortBy('title');
        $person = Person::all()->sortBy('title');
        $time = Time::all()->sortBy('title');
        $menu = Menu::all()->sortBy('date')->keyBy('date');

        // if (Gate::allows('see-news')) {
            // $activetab = "news";
        // } else if (Gate::allows('see-offer_detail')) {
            // $activetab = "offer_detail";
        // } else if (Gate::allows('see-person')) {
            // $activetab = "person";
        // } else if (Gate::allows('see-time')) {
            // $activetab = "time";
        // } else if (Gate::allows('see-menu')) {
            // $activetab = "menu";
        // };
		
		$activetab="news";
		
        return view('home', [
            "news" => $news,
            "offer_detail" => $offer_detail,
            "offer" => $offer,
            "person" => $person,
            "time" => $time,
            "menu" => $menu,
            "today" => $startweek,
            "activetab" => $activetab,
        ]);
    }
}
