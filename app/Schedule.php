<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Branch;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
