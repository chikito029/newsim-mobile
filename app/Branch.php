<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Branch extends Model
{
    protected $table = 'branches';
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, 'branch_id');
    }
}
