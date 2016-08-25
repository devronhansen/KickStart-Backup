<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferDetail extends Model
{
    protected $fillable = [
        'title', 'content', 'picture', 'offerid'
    ];

    public function getUser()
    {
        return $this->belongsTo('App\User', 'edited_by', 'id');
    }

    public function getOffer()
    {
        return $this->belongsTo('App\Offer', 'offerid', 'id');
    }
}
