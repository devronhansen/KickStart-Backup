<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Input;

class MenuController extends Controller
{
    public function index()
    {
        return $menu = Menu::all()->sortBy('date');
        //return $menu = Menu::all()->sortByDesc('updated_at');
    }

    public function update(Request $request, Menu $menu)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'content' => 'required'
        ));

        $menu->edited_by = Auth::User()->id;
        $menu->update($request->all());

        uploadPicture(Input::file('file'), $menu->id, "Menu");

        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');

        return redirect('/#menu');
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'content' => 'required'
        ));

        $menu = new Menu;
        $menu->title = $request->title;
        $menu->content = $request->content;
        $menu->edited_by = Auth::User()->id;
        $menu->save();

        uploadPicture(Input::file('file_0'), $menu->id, "Menu");


        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');
        return redirect('/#menu');

    }

    public function destroy(Menu $menu)
    {
        deletePicture($menu->id, "Menu");
        $menu->delete();
        Session::flash('success', 'Der Eintrag wurde erfolgreich gelöscht!');
        return redirect('/#menu');
    }
}
