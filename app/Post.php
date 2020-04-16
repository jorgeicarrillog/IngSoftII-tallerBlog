<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'categorie_id', 'posted'];

    /**
     * Get the categorie that owns the comment.
     */
    public function categorie()
    {
        return $this->belongsTo('App\Categorie');
    }
}
