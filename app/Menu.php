<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'vollkost', 'vegetarisch', 'fitness', 'nachtisch', 'date'
    ];
}
