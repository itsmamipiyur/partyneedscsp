<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Unit;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ids = \DB::table('tblUnit')
            ->select('strUnitCode')
            ->orderBy('strUnitCode', 'desc')
            ->first();

        if ($ids == null) {
          $newID = $this->smartCounter("UNIT000");
        }else{
          $newID = $this->smartCounter($ids->strUnitCode);
        }

        $units = Unit::withTrashed()->get();
        return view('maintenance.unit')
            ->with('units', $units)
            ->with('newID', $newID);
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
        //
        $rules = ['unit_code' => 'required',
                  'unit_name' => 'required'];

        $this->validate($request, $rules);
        $unit = new Unit;
        $unit->strUnitCode = $request->unit_code;
        $unit->strUnitName = $request->unit_name;
        $unit->txtUnitDesc = $request->unit_description;
        $unit->save();

        return redirect('unit')
          ->with('alert-success', 'Unit was successfully added.');
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
        //
        $unit = Unit::find($id);
        $name = $unit->strUnitName;
        $unit->delete();

        return redirect('unit')->with('alert-success', 'Unit '. $name .' was successfully deleted.');
    }

    public function unit_update(Request $request)
     {
       $rules = ['unit_name' => 'required | max:100'];
       $id = $request->unit_code;

       $this->validate($request, $rules);
       $unit = Unit::find($id);
       $unit->strUnitName = $request->unit_name;
       $unit->txtUnitDesc = $request->unit_description;
       $unit->save();

       return redirect('unit')->with('alert-success', 'Unit ' . $id . ' was successfully updated.');
     }

     public function unit_restore(Request $request)
     {
       $id = $request->unit_code;
       $unit = Unit::onlyTrashed()->where('strUnitCode', '=', $id)->firstOrFail();
       $unit->restore();

       return redirect('unit')->with('alert-success', 'Unit ' . $id . ' was successfully restored.');
     }
}
