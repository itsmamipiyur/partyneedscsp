<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\WaiterRatio;

class WaiterRatioController extends Controller
{
  public function index()
  {

     $idss = \DB::table('tblwaiterratio')
         ->select('waiterRatioCode')
         ->orderBy('waiterRatioCode', 'desc')
         ->first();

     if ($idss == null) {
       $newID = $this->smartCounter("0000");
     }else{
       $newID = $this->smartCounter($idss->waiterRatioCode);
     }

     $waiterRatios = WaiterRatio::all();

    return view('maintenance/waiterRatio')
      ->with('newID', $newID)
      ->with('waiterRatios', $waiterRatios);
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
    $rules = ['waiter_ratio_code' => 'required', 
              'min_pax' => 'required | max:100 | unique:tblwaiterratio,waiterRatioMinPax,NULL,waiterRatioCode,waiterRatioMaxPax,' . Input::get('max_pax'),
              'max_pax' => 'required | max:100',
              'number_of_waiter' => 'required | max:100'];

    $this->validate($request, $rules);
    $waiterRatio = new WaiterRatio;
    $waiterRatio->waiterRatioCode = $request->waiter_ratio_code;
    $waiterRatio->waiterRatioMinPax = $request->min_pax;
    $waiterRatio->waiterRatioMaxPax = $request->max_pax;
    $waiterRatio->waiterRatioWaiterCount = $request->number_of_waiter;
    $waiterRatio->save();

    return redirect('waiterRatio')->with('alert-success', 'Waiter Ratio was successfully saved.');
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
      $waiterRatio = WaiterRatio::find($id);
      return Response::json($waiterRatio);
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
        $waiterRatio = WaiterRatio::find($id);
        $waiterRatio->delete();

        return redirect('waiterRatio')->with('alert-success', 'Waiter Ratio was successfully deleted.');
    }

    public function waiterRatio_update(Request $request)
    {
      $rules = ['waiter_ratio_code' => 'required', 'min_pax' => 'required | max:100', 'max_pax' => 'required | max:100', 'number_of_waiter' => 'required | max:100'];

      $id = $request->waiter_ratio_code;

      $this->validate($request, $rules);
      if($request->min_pax > $request->max_pax){
        return redirect('waiterRatio')->with('alert-failed', 'Minimum pax must be less than maximum pax.');
      }elseif ($request->min_pax == $request->max_pax) {
        return redirect('waiterRatio')->with('alert-failed', 'Minimum pax must not be equal to maximum pax.');
      }

      $waiterRatio = WaiterRatio::find($id);
      $waiterRatio->waiterRatioMinPax = $request->min_pax;
      $waiterRatio->waiterRatioMaxPax = $request->max_pax;
      $waiterRatio->waiterRatioWaiterCount = $request->number_of_waiter;
      $waiterRatio->save();

      return redirect('waiterRatio')->with('alert-success', 'Waiter Ratio was successfully updated.');
    }

    public function waiterRatio_restore(Request $request)
    {
      $id = $request->waiter_ratio_code;
      $waiterRatio = WaiterRatio::onlyTrashed()->where('waiterRatioCode', '=', $id)->firstOrFail();
      $waiterRatio->restore();

      return redirect('waiterRatio')->with('alert-success', 'Waiter Ratio was successfully restored.');
    }

    public function showArchive()
    {
        //
       $waiterRatios = WaiterRatio::onlyTrashed()->get();

        return view('archive.waiterRatio')
             ->with('waiterRatios', $waiterRatios);
    }
}
