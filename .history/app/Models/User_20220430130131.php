<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    // kiek yra vartotojo irasai    public function posts()
    {
        return $this->hasMany('App\Models\Posts', 'author_id');
    }

    // kiek vartotojas turi komentaru
    public function comments()
    {
        return $this->hasMany('App\Models\Comments', 'from_user');
    }

    public function can_post()
    {
        $role = $this->role;
        if ($role == 'author' || $role == 'admin') {
        return true;
        }
        return false;
    }

    public function is_admin()
    {
        $role = $this->role;
        if ($role == 'admin') {
        return true;
        }
        return false;
    }
}
