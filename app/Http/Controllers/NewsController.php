<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Session;

class NewsController extends Controller
{
    public function index()
    {
        return News::all();
    }

    public function update(Request $request, News $news)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'content' => 'required'
        ));

        Session::flash('success', 'The Post was successfully saved!');

        $news->update($request->all());

        return back();
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'content' => 'required'
        ));

        $news = new News;

        $news->title = $request->title;
        $news->content = $request->content;

        $news->save();
        return back();

    }

    public function destroy(News $news)
    {
        $news->delete();
        return back();
    }
}
