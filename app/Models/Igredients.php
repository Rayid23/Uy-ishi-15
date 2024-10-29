<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Igredients extends Model
{
    /** @use HasFactory<\Database\Factories\IgredientsFactory> */
    use HasFactory;

    protected $table = 'igredients';

    protected $fillable = [
        'name'
    ];

    public function foods(){
        return $this->belongsToMany(Food::class,'menus','igredient_id','food_id');
    }
}
