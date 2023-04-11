<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'url',
        'image_link',
        'sort_by',
        'active'
    ];
}
