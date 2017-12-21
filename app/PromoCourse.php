<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Promo;

class PromoCourse extends Model
{
    protected $table = 'promo_courses';
    protected $guarded = [];

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'promo_id');
    }
}
