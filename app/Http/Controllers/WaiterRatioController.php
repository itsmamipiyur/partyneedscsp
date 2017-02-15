<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WaiterRatio;

class WaiterRatioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ids = \DB::table('tblWaiterRatio')
            ->select('strWaitRatiCode')
            ->orderBy('strWaitRatiCode', 'desc')
            ->first();

        if ($ids == null) {
          $newID = $this->smartCounter("WTRT0000");
        }else{
          $newID = $this->smartCounter($ids->strWaitRatiCode);
        }

        $waiterRatios = WaiterRatio::all();
        return view('maintenance.waiterRatio')
            ->with('waiterRatios', $waiterRatios)
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
        $rules = ['max_pax' => 'required',
                  'number_of_waiter' => 'required'];

        $this->validate($request, $rules);
        $waiterRatio = new WaiterRatio;
        $waiterRatio->strWaitRatiCode = $request->waiter_ratio_code;
        $waiterRatio->intWaitRatiMaxPax = $request->max_pax;
        $waiterRatio->intWaitRatiNoOfWaiter = $request->number_of_waiter;
        $waiterRatio->save();

        return redirect('waiterRatio')
          ->with('alert-success', 'WaiterRatio was successfully added.');
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
        $waiterRatio = WaiterRatio::find($id);
        $waiterRatio->delete();

        return redirect('waiterRatio')->with('alert-success', 'WaiterRatio '. $name .' was successfully deleted.');
    }

    public function waiterRatio_update(Request $request)
     {
       $rules = ['max_pax' => 'required',
                 'number_of_waiter' => 'required'];

       $this->validate($request, $rules);
       $id = $request->waiter_ratio_code;

       $this->validate($request, $rules);
       $waiterRatio = WaiterRatio::find($id);
       $waiterRatio->intWaitRatiMaxPax = $request->max_pax;
	   $waiterRatio->intWaitRatiNoOfWaiter = $request->number_of_waiter;
	   $waiterRatio->save();

       return redirect('waiterRatio')->with('alert-success', 'WaiterRatio ' . $id . ' was successfully updated.');
     }

     public function waiterRatio_restore(Request $request)
     {
       $id = $request->waiter_ratio_code;
       $waiterRatio = WaiterRatio::onlyTrashed()->where('strWaitRatiCode', '=', $id)->firstOrFail();
       $waiterRatio->restore();

       return redirect('waiterRatio')->with('alert-success', 'WaiterRatio ' . $id . ' was successfully restored.');
     }
}
