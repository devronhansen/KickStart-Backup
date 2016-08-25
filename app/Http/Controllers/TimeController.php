<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Time;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Input;

class TimeController extends Controller
{
    public function index()
    {
        return $time = Time::all()->sortByDesc('updated_at');
    }

    public function update(Request $request, Time $time)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'content' => 'required'
        ));

        $time->edited_by = Auth::User()->id;
        $time->update($request->all());

        uploadPicture(Input::file('file'), $time->id, "Time");

        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');

        return redirect('/#time');
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'content' => 'required'
        ));

        $time = new Time;
        $time->title = $request->title;
        $time->content = $request->content;
        $time->edited_by = Auth::User()->id;
        $time->save();

        uploadPicture(Input::file('file_0'), $time->id, "Time");


        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');
        return redirect('/#time');

    }

    public function destroy(Time $time)
    {
        deletePicture($time->id, "Time");
        $time->delete();
        Session::flash('success', 'Der Eintrag wurde erfolgreich gelöscht!');
        return redirect('/#time');
    }
}
