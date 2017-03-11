<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EquipmentType;


class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ids = \DB::table('tblequipmenttype')
            ->select('equipmentTypeCode')
            ->orderBy('equipmentTypeCode', 'desc')
            ->first();

        if ($ids == null) {
          $newID = $this->smartCounter("0000");
        }else{
          $newID = $this->smartCounter($ids->equipmentTypeCode);
        }

        $equipmentTypes = EquipmentType::all();

        return view('maintenance/equipmentType')
          ->with('newID', $newID)
          ->with('equipmentTypes', $equipmentTypes);

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
      $rules = ['equipment_type_code' => 'required', 'equipment_type_name' => 'required | unique:tblequipmenttype,equipmentTypeName'];
      $name = $request->equipment_type_name;
      $this->validate($request, $rules);
      $equipmentType = new EquipmentType;
      $equipmentType->equipmentTypeCode = $request->equipment_type_code;
      $equipmentType->equipmentTypeName = $request->equipment_type_name;
      $equipmentType->equipmentTypeDesc = $request->equipment_type_description;
      $equipmentType->save();

      return redirect('equipmentType')
      ->with('alert-success', 'Equipment Type '. $name .' was successfully saved.');
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
        $equipmentType = EquipmentType::find($id);
        return Response::json($equipmentType);
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
        //
        $equipmentType = EquipmentType::find($id);
        $name = $equipmentType->equipmentTypeName;
        $equipmentType->delete();

        return redirect('equipmentType')->with('alert-success', 'Equipment Type '. $name .' was successfully deleted.');
    }

    public function equipmentType_update(Request $request)
    {
      $rules = ['equipment_type_name' => 'required|max:100'];
      $id = $request->equipment_type_code;
      $name = $request->equipment_type_name;

      $this->validate($request, $rules);
      $equipmentType = EquipmentType::find($id);
      $equipmentType->equipmentTypeName = $request->equipment_type_name;
      $equipmentType->equipmentTypeDesc = $request->equipment_type_description;
      $equipmentType->save();

      return redirect('equipmentType')->with('alert-success', 'Equipment Type ' . $name . ' was successfully updated.');
    }

    public function equipmentType_restore(Request $request)
    {
      $id = $request->equipment_type_id;
      $name = $request->equipment_type_name;
      $equipmentType = EquipmentType::onlyTrashed()->where('equipmentTypeCode', '=', $id)->firstOrFail();
      $equipmentType->restore();

      return redirect('equipmentType')->with('alert-success', 'Equipment Type ' . $name . ' was successfully restored.');
    }
}
