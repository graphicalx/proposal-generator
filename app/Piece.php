<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Piece extends Model
{

    use SoftDeletes;

    protected $guarded = [];

    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}
