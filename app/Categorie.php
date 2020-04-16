<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
	/**
     * Get the posts for the blog post.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
