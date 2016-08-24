<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'content', 'picture',
    ];

    public function getname() //Verbindung via Foreign Key herstellen
    {
        return $this->belongsTo('App\User', 'edited_by', 'id');
    }
}
