<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Galery;

class Slider extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'image',
        'description',
        'order',
        'is_active',
        'start_date',
        'end_date',
    ];

    public function galery()
    {
        return $this->belongsTo(Galery::class);
    }
}
