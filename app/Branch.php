<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Course;
use App\Promo;

class Branch extends Model
{
    protected $table = 'branches';
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, 'branch_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'branch_id');
    }

    public function promos()
    {
        return $this->hasMany(Promo::class, 'branch_id');
    }
}
