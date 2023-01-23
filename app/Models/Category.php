<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'titre',
        'slug',
        'description',
        'uploadImage'
    ];

    public function produits()
    {
        return $this->hasMany(Produits::class, 'category_id','id');
    }
}
