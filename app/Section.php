<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $guarded = [];

    public function pieces()
    {
        return $this->hasMany('App\Piece');
    }
}
