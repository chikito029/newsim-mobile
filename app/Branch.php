<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Course;

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
}
