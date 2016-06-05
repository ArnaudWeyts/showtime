<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    /**
     * Get the categories for the show.
     */
    public function categories()
    {
        return $this->hasMany('App\ShowCategories');
    }
}
