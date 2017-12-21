<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Branch;
use App\PromoCourse;

class Promo extends Model
{
    protected $table = 'promos';
    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function promoCourse()
    {
        return $this->hasMany(PromoCourse::class, 'promo_id');
    }
}
