<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Penalty;
use App\Item;

class PenaltyController extends Controller
{
    public function index()
  {

     $idss = \DB::table('tblpenalty')
         ->select('penaltyCode')
         ->orderBy('penaltyCode', 'desc')
         ->first();

     if ($idss == null) {
       $newID = $this->smartCounter("0000");
     }else{
       $newID = $this->smartCounter($idss->penaltyCode);
     }

     $penalties = Penalty::all();

    return view('maintenance.penalty')
      ->with('newID', $newID)
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
    $rules = ['penalty_code' => 'required', 'penalty_name' => 'required|unique:tblpenalty,penaltyName', 'amount' => 'required'];

    $this->validate($request, $rules);
    $amount = preg_replace('/[\,]/', '', $request->amount);
    $amount = floatval($amount);
    $penalty = new Penalty;
    $penalty->penaltyCode = $request->penalty_code;
    $penalty->penaltyName = $request->penalty_name;
    $penalty->penaltyDesc = $request->penalty_description;  
    $penalty->amount = $amount;
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
      $penalty->delete();

      return redirect('penalty')->with('alert-success', 'Penalty was successfully deactivated.');
    }

    public function penalty_update(Request $request)
    {
       $rules = ['penalty_code' => 'required',
        'penalty_name' => 'required|unique:tblpenalty,penaltyName,'.$request->penalty_code.',penaltyCode',
        'amount' => 'required'];

        $this->validate($request, $rules);
        $amount = preg_replace('/[\,]/', '', $request->amount);
        $amount = floatval($amount);
        $penalty = Penalty::find($request->penalty_code);
        $penalty->penaltyName = $request->penalty_name;
        $penalty->penaltyDesc = $request->penalty_description;  
        $penalty->amount = $amount;
        $penalty->save();

      return redirect('penalty')->with('alert-success', 'Penalty was successfully updated.');
    }

    public function penalty_restore(Request $request)
    {
      $id = $request->penalty_code;
      $penalty = Penalty::onlyTrashed()->where('penaltyCode', '=', $id)->firstOrFail();
      $penalty->restore();

      return redirect('penalty')->with('alert-success', 'Penalty was successfully restored.');
    }

    public function showArchive()
    {
        //
       $penalties = Penalty::onlyTrashed()->get();

        return view('archive.penalty')
             ->with('penalties', $penalties);
    }


}

