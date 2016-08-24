<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

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

        $news->edited_by = Auth::User()->id;
        $news->update($request->all());

        if (Input::file('file') != "") {
            $this->uploadPicture(Input::file('file'), $news->id);
        }

        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');

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
        $news->edited_by = Auth::User()->id;
        $news->save();

        $filepath = pathinfo(Input::file('file_0'));
        $accepted_extensions = Array('bmp', 'gif', 'jpeg', 'jpg','png');

    if(Input::file('file_0') != "")
    {
        //Pruefen, ob richtiges Format!!! (.jpg, .png)
        if (in_array($filepath['extension'], $accepted_extensions)){
            $this->uploadPicture(Input::file('file_0'), $news->id);
        } else {
            Session::flash('error', 'Beim Bildupload gab es einen Fehler!');
        }

    }


        //Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');
        return back();

    }

    public function destroy(News $news)
    {
        $this->deletePicture($news->id);
        $news->delete();
        Session::flash('success', 'Der Eintrag wurde erfolgreich gelöscht!');
        return back();
    }

    public function uploadPicture($file, $id)
    {
        $file->move("./files/temp", $file->getClientOriginalName());
        $image = Image::make('./files/temp/' . $file->getClientOriginalName())->save('./files/news_' . $id . '.png');
        File::delete("./files/temp/" . $file->getClientOriginalName());
    }

    public function deletePicture($id)
    {
        File::delete("./files/news_" . $id . ".png");
    }

}
