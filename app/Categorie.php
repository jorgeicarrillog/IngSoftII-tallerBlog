<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

	/**
     * Get the posts for the blog post.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
