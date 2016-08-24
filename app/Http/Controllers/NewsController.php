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

        if(Input::file('file') != "")
        {
            //Pruefen, ob richtiges Format!!! (.jpg, .png)
            $this->uploadPicture(Input::file('file'), $news->id);
            //$news->picture->update($news->id); //Fast ueberfluessig, wenn picture immer gleich id
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

    if(Input::file('file_0') != "")
    {
        //Pruefen, ob richtiges Format!!! (.jpg, .png)
        $this->uploadPicture(Input::file('file_0'), $news->id);
    }


        Session::flash('success', 'Der Eintrag wurde erfolgreich gespeichert!');
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
        $image = Image::make('./files/temp/' . $file->getClientOriginalName());
        $imgae = $this->resizePicture($image);
        $image = $image->save('./files/news_'. $id .'.png');
        File::delete("./files/temp/" . $file->getClientOriginalName());
    }

    public function deletePicture($id)
    {
        File::delete("./files/news_" . $id . ".png");
    }

    public function resizePicture($image)
    {
        $limit = 800;
        $height = $image->height();
        $width = $image->width();

        if($width > $height && $height > $limit)
        {
            $scaling = $height / $limit;
            $newwidth = $width / $scaling;
            $image = $image->resize($newwidth, $limit);
        }
        else if ($height > $width && $width > $limit)
        {
            $scaling = $width / $limit;
            $newheight = $height / $scaling;
            $image = $image->resize($limit, $newheight);
        }

        return $image;
    }
}
