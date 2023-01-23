<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'category_id',
        'titre',
        'slug',
        'price',
        'description'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }
}
