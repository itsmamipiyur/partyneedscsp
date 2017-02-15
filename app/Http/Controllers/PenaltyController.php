<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PenaltyType;
use App\Penalty;
use Response;

class PenaltyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $idss = \DB::table('tblPenalty')
           ->select('strPenaCode')
           ->orderBy('strPenaCode', 'desc')
           ->first();

       if ($idss == null) {
         $newID = $this->smartCounter("PENA0000");
       }else{
         $newID = $this->smartCounter($idss->strPenaCode);
       }

       $penaTypes = PenaltyType::orderBy('strPenaTypeName')->pluck('strPenaTypeName', 'strPenaTypeCode');
       $penalties = Penalty::all();

      return view('maintenance/penalty')
        ->with('newID', $newID)
        ->with('penaTypes', $penaTypes)
        ->with('penalties', $penalties);
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
      $rules = ['penalty_name' => 'required | max:100',
                'penalty_type' => 'required',
                'penalty_fee' => 'required'];

      $this->validate($request, $rules);
      $penalty = new Penalty;

      $penalty->strPenaCode = trim($request->penalty_code);
      $penalty->strPenaName = trim($request->penalty_name);
      $penalty->txtPenaDesc = trim($request->penalty_description);
      $penalty->strPenaPenaTypeCode = trim($request->penalty_type);
      $penalty->dblPenaFee = trim($request->penalty_fee);
      $penalty->save();

      return redirect('penalty')->with('alert-success', 'Penalty was successfully saved.');
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
      $penalty = Penalty::find($id);
      $name = $penalty->strPenaName;
      $penalty->delete();

      return redirect('penalty')->with('alert-success', 'Penalty '. $name .' was successfully deleted.');
    }

    public function penalty_update(Request $request)
    {
      $rules = ['penalty_name' => 'required | max:100',
                'penalty_type' => 'required',
                'penalty_fee' => 'required'];

      $this->validate($request, $rules);
      $penalty = Penalty::find($request->penalty_code);
      $penalty->strPenaName = trim($request->penalty_name);
      $penalty->txtPenaDesc = trim($request->penalty_description);
      $penalty->strPenaPenaTypeCode = trim($request->penalty_type);
      $penalty->dblPenaFee = trim($request->penalty_fee);
      $penalty->save();

      return redirect('penalty')->with('alert-success', 'Penalty ' . $request->penalty_code . ' was successfully updated.');
    }

    public function penalty_restore(Request $request)
    {
      $id = $request->penalty_code;
      $penalty = Penalty::onlyTrashed()->where('strPenaCode', '=', $id)->firstOrFail();
      $penalty->restore();

      return redirect('penalty')->with('alert-success', 'Penalty ' . $id . ' was successfully restored.');
    }
}
