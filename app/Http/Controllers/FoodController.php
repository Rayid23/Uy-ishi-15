<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Http\Controllers\Controller;
use App\Http\Requests\FoodUpdateRequest;
use App\Http\Requests\FoodStoreRequest;
use App\Models\Igredients;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::paginate(10);

        $igredients = Igredients::all();

        return view("foods.food", compact('foods', 'igredients'));
    }

    public function store(FoodStoreRequest $request)
    {
        $data = $request->all();

        $ids = $data['igredients'];

        unset($data['igredients']);

        $food = Food::create($data);

        $food->igredients()->attach($ids);


        return redirect()->route('food.main')->with('check', ['Успешно добавлено данные', 'success']);
    }
    public function update(FoodUpdateRequest $request, Food $food)
    {
        $updatedData = $request->all();

        $updatedData['name'] = !empty($request['name']) ? $request['name'] : $food->name;

        $ids = $updatedData['igredients'];

        unset($updatedData['igredients']);

        $food->update($updatedData);

        $food->igredients()->sync($ids);

        return redirect()
            ->route('food.main')
            ->with('check', ['Успешно обновлено данные', 'primary']);
    }

    public function delete(Food $food)
    {
        $food->delete();
        return redirect()
            ->route('food.main')
            ->with('check', ['Успешно удалено данные', 'danger']);
    }
}
