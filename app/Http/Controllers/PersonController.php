<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Input;

class PersonController extends Controller
{
    public function index()
    {
        return $person = Person::orderBy('updated_at', 'desc')
            ->get();
    }

    public function update(Request $request, Person $person)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'content' => 'required'
        ));

        $person->edited_by = Auth::User()->id;
        $person->update($request->all());

        uploadPicture(Input::file('file'), $person->id, "person");

        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');

        return redirect('/#person');
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'content' => 'required'
        ));

        $person = new Person;
        $person->title = $request->title;
        $person->content = $request->content;
        $person->edited_by = Auth::User()->id;
        $person->save();

        uploadPicture(Input::file('file_0'), $person->id, "person");


        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');
        return redirect('/#person');

    }

    public function destroy(Person $person)
    {
        deletePicture($person->id, "person");
        $person->delete();
        Session::flash('success', 'Der Eintrag wurde erfolgreich gelöscht!');
        return redirect('/#person');
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
