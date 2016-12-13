<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OfferDetail;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Input;

class OfferDetailController extends Controller
{
    public function index($id)
    {
        return OfferDetail::where('offerid', $id)
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function update(Request $request, OfferDetail $offer_detail)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'content' => 'required'
        ));

        $offer_detail->edited_by = Auth::User()->id;
        $offer_detail->offerid = $request->input('offer');
        $offer_detail->update($request->all());

        uploadPicture(Input::file('file'), $offer_detail->id, "offer_detail");

        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');

        return redirect('/#offer_detail');
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'content' => 'required'
        ));

        $offer_detail = new OfferDetail;
        $offer_detail->title = $request->title;
        $offer_detail->content = $request->input('content');
        $offer_detail->edited_by = Auth::User()->id;
        $offer_detail->offerid = $request->offer;
        $offer_detail->save();

        uploadPicture(Input::file('file_0'), $offer_detail->id, "offer_detail");


        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');
        return redirect('/#offer_detail');

    }

    public function destroy(OfferDetail $offer_detail)
    {
        deletePicture($offer_detail->id, "offer_detail");
        $offer_detail->delete();
        Session::flash('success', 'Der Eintrag wurde erfolgreich gelöscht!');
        return redirect('/#offer_detail');
    }

    function uploadPicture($file, $id, $category)
{
    $filepath = pathinfo($file);
    $accepted_extensions = Array('image/bmp', 'image/gif', 'image/jpeg', 'image/jpg', 'image/png');

    if ($file != "") {
        //Pruefen, ob richtiges Format!!! (.jpg, .png)
        if (in_array($file->getClientMimeType(), $accepted_extensions)) {
            $file->move("./files/temp", $file->getClientOriginalName());
            $image = Image::make('./files/temp/' . $file->getClientOriginalName());
            $image = resizePicture($image);
            $image = $image->save('./files/' . $category . '_' . $id . '.jpg', 80);
            File::delete("./files/temp/" . $file->getClientOriginalName());
        } else {
            Session::flash('error', 'Beim Bildupload gab es einen Fehler!');
        }
    }
}

function deletePicture($id, $category)
{
    File::delete("./files/" . $category . "_" . $id . ".jpg");
}

function resizePicture($image)
{
    $limit = 800;
    $height = $image->height();
    $width = $image->width();

    if ($width > $height && $height > $limit) {
        $scaling = $height / $limit;
        $newwidth = $width / $scaling;
        $image = $image->resize($newwidth, $limit);
    } else if ($height > $width && $width > $limit) {
        $scaling = $width / $limit;
        $newheight = $height / $scaling;
        $image = $image->resize($limit, $newheight);
    }

    return $image;
}
}
