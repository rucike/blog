<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $guarded = [];
    
    // parodo vartotoja kuris komentavo
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'from_user');
    }
    
    // grazina visus komentarus ir parodo, kur buvoo
    public function post()
    {
        return $this->belongsTo('App\Models\Posts', 'on_post');
    }

    use HasFactory;
}
