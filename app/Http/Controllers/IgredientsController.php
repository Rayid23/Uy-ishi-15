<?php

namespace App\Http\Controllers;

use App\Models\Igredients;
use App\Http\Controllers\Controller;
use App\Http\Requests\IgredientsStoreRequest;
use App\Http\Requests\IgredientsUpdateRequest;
use Illuminate\Http\Request;

class IgredientsController extends Controller
{

    public function index()
    {
        $igredients = Igredients::paginate(10);

        return view("igredients.igredient", compact("igredients"));
    }
    public function store(IgredientsStoreRequest $request)
    {
        $data = $request->all();

        Igredients::create($data);

        return redirect()->route('igredient.main')->with('check', ['Успешно добавлено данные', 'success']);;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IgredientsUpdateRequest $request, Igredients $igredients)
    {
        $updatedData = $request->all();
        
        $updatedData['name'] = !empty($request['name']) ? $request['name'] : $igredients->name;

        $igredients->update($updatedData);

        return redirect()
            ->route('igredient.main')
            ->with('check', ['Успешно обновлено данные','primary']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Igredients $igredients)
    {
        $igredients->delete();

        return redirect()
            ->route('igredient.main')
            ->with('check', ['Успешно удалено данные', 'danger']);
    }
}
