<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PenaltyType;

class PenaltyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ids = \DB::table('tblPenaltyType')
            ->select('strPenaTypeCode')
            ->orderBy('strPenaTypeCode', 'desc')
            ->first();

        if ($ids == null) {
          $newID = $this->smartCounter("PNLTYP000");
        }else{
          $newID = $this->smartCounter($ids->strPenaTypeCode);
        }

        $penaltyTypes = PenaltyType::all();
        return view('maintenance.penaltyType')
            ->with('penaltyTypes', $penaltyTypes)
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
        $rules = ['penalty_type_code' => 'required',
                  'penalty_type_name' => 'required'];

        $this->validate($request, $rules);
        $penaltyType = new PenaltyType;
        $penaltyType->strPenaTypeCode = $request->penalty_type_code;
        $penaltyType->strPenaTypeName = $request->penalty_type_name;
        $penaltyType->txtPenaTypeDesc = $request->penalty_type_description;
        $penaltyType->save();

        return redirect('penaltyType')
          ->with('alert-success', 'Penalty Type was successfully added.');
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
        $penaltyType = PenaltyType::find($id);
        $name = $penaltyType->strPenaTypeName;
        $penaltyType->delete();

        return redirect('penaltyType')->with('alert-success', 'Penalty Type '. $name .' was successfully deleted.');
    }

    public function penaltyType_update(Request $request)
     {
       $rules = ['penalty_type_name' => 'required | max:100'];
       $id = $request->penalty_type_code;

       $this->validate($request, $rules);
       $penaltyType = PenaltyType::find($id);
       $penaltyType->strPenaTypeName = $request->penalty_type_name;
       $penaltyType->txtPenaTypeDesc = $request->penalty_type_description;
       $penaltyType->save();

       return redirect('penaltyType')->with('alert-success', 'Penalty Type ' . $id . ' was successfully updated.');
     }

     public function penaltyType_restore(Request $request)
     {
       $id = $request->penalty_type_code;
       $penaltyType = PenaltyType::onlyTrashed()->where('strPenaTypeCode', '=', $id)->firstOrFail();
       $penaltyType->restore();

       return redirect('penaltyType')->with('alert-success', 'Penalty Type ' . $id . ' was successfully restored.');
     }
}
