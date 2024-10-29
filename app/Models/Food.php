<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    /** @use HasFactory<\Database\Factories\FoodFactory> */
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'name'
    ];

    public function igredients(){
        return $this->belongsToMany(    Igredients::class,'menus','food_id','igredient_id');
    }
    
}
