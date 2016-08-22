<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TableController extends Controller
{
    public function index()
    {
        //SQL Code?

        //Arrays fuellen
        $news = array(
            array('id' => '1', 'news_text' => 'Hallo Welt! Ich bin gaaaaaaaylord McFickster'),
            array('id' => '2', 'news_text' => 'Ich bin auch ne News, voll cool und so'),
        );

        //echo "<pre>";
        //print_r(array_values($news));
        //echo "</pre>";

        //Arrays mit uebergeben
        return view('home', [
            'news' => $news,
            'test_text' => "ich bin ein test",
            'test_id' => "1",
            'test_header' => "huhu",
        ]);
    }
}
