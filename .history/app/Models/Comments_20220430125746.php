<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $guarded = [];
    
    // user who has commented

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'from_user');
    }
    
    // returns post of any comment
    public function post()
    {
        return $this->belongsTo('App\Models\Posts', 'on_post');
    }

    use HasFactory;
}
