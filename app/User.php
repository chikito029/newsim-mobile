<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Branch;
use App\Course;
use App\Promo;
use App\Post;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'created_by');
    }

    public function promos()
    {
        return $this->hasMany(Promo::class, 'created_by');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'created_by');
    }
}
