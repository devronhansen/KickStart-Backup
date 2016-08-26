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
            'vollkost' => 'required'
        ));
        $menu->update($request->all());

        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');

        return redirect('/#menu');
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'vollkost' => 'required'
        ));

        $menu = new Menu;
        $menu->date = $request->date;
        $menu->vollkost = $request->vollkost;
        $menu->vegetarisch = $request->vegetarisch;
        $menu->fitness = $request->fitness;
        $menu->nachtisch = $request->nachtisch;
        $menu->save();

        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');
        return redirect('/#menu');

    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        Session::flash('success', 'Der Eintrag wurde erfolgreich gelöscht!');
        return redirect('/#menu');
    }
}
