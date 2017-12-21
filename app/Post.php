<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Branch;
use App\PostImage;

class Post extends Model
{
    protected $table = 'posts';
    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function postImages()
    {
        return $this->hasMany(PostImage::class, 'post_id');
    }
}
