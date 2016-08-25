<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OfferDetail;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Input;

class OfferDetailController extends Controller
{
    public function index()
    {
        return OfferDetail::all()->sortBy('updated_at');
    }

    public function update(Request $request, OfferDetail $offer_detail)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'content' => 'required'
        ));

        $offer_detail->edited_by = Auth::User()->id;
        $offer_detail->update($request->all());

        uploadPicture(Input::file('file'), $offer_detail->id, "offer_detail");

        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');

        return back();
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'content' => 'required'
        ));

        $offer_detail = new OfferDetail;
        $offer_detail->title = $request->title;
        $offer_detail->content = $request->content;
        $offer_detail->edited_by = Auth::User()->id;
        $offer_detail->offerid = 1;
        $offer_detail->save();

        uploadPicture(Input::file('file_0'), $offer_detail->id, "offer_detail");


        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');
        return back();

    }

    public function destroy(OfferDetail $offer_detail)
    {
        deletePicture($offer_detail->id, "offer_detail");
        $offer_detail->delete();
        Session::flash('success', 'Der Eintrag wurde erfolgreich gelöscht!');
        return back();
    }
}
