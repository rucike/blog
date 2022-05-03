<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $guarded = [];

    // posts has many comments
    // grazina visus komentarus prie kiekvieno posto
    public function comments()
    {
        return $this->hasMany('App\Models\Comments', 'on_post');
    }
    
    // grąžina vartotojo, kuris yra to įrašo autorius, egzempliorių
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    use HasFactory;
}
