<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_product',
        'name',
        'parent_id',
        'description',
        'content',
        'slug',
        'active',
    ];

    public function products(){
        return $this->hasMany(Product::class, 'menu_id', 'id');
    }
}
