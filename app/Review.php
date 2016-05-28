<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = array('user_id', 'show_id', 'title', 'shortcontent', 'content', 'rating', 'upvotes', 'downvotes');

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function votes() {
    	return $this->hasMany('App\Vote');
	}
}
