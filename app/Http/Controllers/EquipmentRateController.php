<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EquipmentRate;
use App\Equipment;
use App\Unit;

class EquipmentRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $idss = \DB::table('tblEquipmentRate')
           ->select('strEquiRateCode')
           ->orderBy('strEquiRateCode', 'desc')
           ->first();

       if ($idss == null) {
         $newID = $this->smartCounter("EQUIRATE0000");
       }else{
         $newID = $this->smartCounter($idss->strEquiRateCode);
       }

       $equipments = Equipment::orderBy('strEquiName')->pluck('strEquiName', 'strEquiCode');
       $units = Unit::orderBy('strUnitName')->pluck('strUnitName', 'strUnitCode');
       $equipmentRates = EquipmentRate::withTrashed()->get();

      return view('maintenance/equipmentRate')
        ->with('newID', $newID)
        ->with('equipments', $equipments)
        ->with('units', $units)
        ->with('equipmentRates', $equipmentRates);
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
      $rules = ['equipment_rate_code' => 'required | max:100',
                'equipment' => 'required',
                'equipment_rate_amount' => 'required'];

      $this->validate($request, $rules);
      $equipmentRate = new EquipmentRate;

      $equipmentRate->strEquiRateCode = trim($request->equipment_rate_code);
      $equipmentRate->strEquiRateEquiCode = trim($request->equipment);
      $equipmentRate->dblEquiRateAmount = trim($request->equipment_rate_amount);
      $equipmentRate->strEquiRateUnitCode = trim($request->equipment_rate_unit);
      $equipmentRate->save();

      return redirect('equipmentRate')->with('alert-success', 'Equipment Rate was successfully saved.');
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
      $equipmentRate = EquipmentRate::find($id);
      $equipment->delete();

      return redirect('equipmentRate')->with('alert-success', 'Equipment Rate was successfully deleted.');
    }

    public function equipment_update(Request $request)
    {
      $rules = ['equipment' => 'required',
                'equipment_rate_amount' => 'required'];

      $this->validate($request, $rules);

      $equipmentRate = EquipmentRate::find($request->equipment_rate_code);
      $equipmentRate->strEquiRateEquiCode = trim($request->equipment);
      $equipmentRate->dblEquiRateAmount = trim($request->equipment_rate_amount);
      $equipmentRate->strEquiRateUnitCode = trim($request->equipment_rate_unit);
      $equipmentRate->save();

      return redirect('equipmentRate')->with('alert-success', 'Equipment Rate' . $request->equipmentRate_code . ' was successfully updated.');
    }

    public function equipment_restore(Request $request)
    {
      $id = $request->equipment_rate_code;
      $equipmentRate = EquipmentRate::onlyTrashed()->where('strEquiRateCode', '=', $id)->firstOrFail();
      $equipmentRate->restore();

      return redirect('equipmentRate')->with('alert-success', 'Equipment Rate' . $id . ' was successfully restored.');
    }
}
