<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\IgredientsController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get("/", [FoodController::class, 'index'])
->name('food.main');

Route::post('/create-food', [FoodController::class,'store'])
->name('food.store');

Route::delete('/delete/{food}', [FoodController::class,'delete'])
->name('food.delete');

Route::put('/update-food/{food}', [FoodController::class,'update'])
->name('food.update');

#-------------------------------------Игредиенты-----------------------------------------

Route::get("/igredients", [IgredientsController::class, 'index'])
->name('igredient.main');

Route::post('/create-igredient', [IgredientsController::class,'store'])
->name('igredient.store');

Route::delete('/delete-igredient/{igredients}', [IgredientsController::class,'delete'])
->name('igredient.delete');

Route::put('/update-igredient/{igredients}', [IgredientsController::class,'update'])
->name('igredient.update');
