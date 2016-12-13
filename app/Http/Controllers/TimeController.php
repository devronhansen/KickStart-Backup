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
        return $time = Time::orderBy('updated_at', 'desc')
            ->get();
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
