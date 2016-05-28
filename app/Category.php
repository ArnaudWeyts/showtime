<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function show()
    {
        return $this->belongsTo('App\Show');
    }
}
