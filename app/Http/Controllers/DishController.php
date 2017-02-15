<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EquipmentType;
use App\Equipment;
use Response;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $idss = \DB::table('tblDish')
           ->select('dishCode')
           ->orderBy('dishCode', 'desc')
           ->first();

       if ($idss == null) {
         $newID = $this->smartCounter("DSH0000");
       }else{
         $newID = $this->smartCounter($idss->dishCode);
       }

       $dishTypes = DishType::orderBy('dishTypeName')->pluck('dishTypeName', 'dishTypeCode');
       $dishes = Dishes::all();

      return view('maintenance/dish')
        ->with('newID', $newID)
        ->with('dishTypes', $dishTypes)
        ->with('dishes', $dishes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rules = ['dish_name' => 'required | max:100',
                'dish_type' => 'required'];

      $this->validate($request, $rules);
      $dish = new Dish;

      $dish->dishCode = trim($request->dish_code);
      $dish->dishName = trim($request->dish_name);
      $dish->dishDesc = trim($request->dish_description);
      $dish->dishTypeCode = trim($request->dish_type);
      $dish->save();

      return redirect('dish')->with('alert-success', 'Dish was successfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $equipment = Equipment::find($id);
        return Response::json(['dishCode' => $dish->dishCode,
                              'dishName' => $dish->dishName,
                              'dishDesc' => $dish->dishDesc,
                              'dishTypeName' => $dish->DishType->dishTypeName]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $dish = Dish::find($id);
      $name = $dish->dishName;
      $dish->delete();

      return redirect('dish')->with('alert-success', 'Dish '. $name .' was successfully deleted.');
    }

    public function dish_update(Request $request)
    {
      $rules = ['dish_name' => 'required | max:100',
                'dish_type' => 'required'];

      $this->validate($request, $rules);
      $dish = Dish::find($request->dish_code);
      $dish->dishName = trim($request->dish_name);
      $dish->txtEquiDesc = trim($request->dish_description);
      $dish->dishTypeCode = trim($request->dish_type);
      $dish->save();

      return redirect('dish')->with('alert-success', 'Dish ' . $request->dish_code . ' was successfully updated.');
    }

    public function dish_restore(Request $request)
    {
      $id = $request->dish_code;
      $dish = Dish::onlyTrashed()->where('dishCode', '=', $id)->firstOrFail();
      $dish->restore();

      return redirect('dish')->with('alert-success', 'Dish ' . $id . ' was successfully restored.');
    }
}
