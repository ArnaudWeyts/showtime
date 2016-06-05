<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShowCategories extends Model
{
    public function show()
    {
        return $this->belongsTo('App\Show');
    }
}
