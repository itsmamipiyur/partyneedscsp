<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Delivery;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ids = \DB::table('tblDelivery')
            ->select('strDeliCode')
            ->orderBy('strDeliCode', 'desc')
            ->first();

        if ($ids == null) {
          $newID = $this->smartCounter("DLVR000");
        }else{
          $newID = $this->smartCounter($ids->strDeliCode);
        }

        $deliveries = Delivery::all();
        return view('maintenance.delivery')
            ->with('deliveries', $deliveries)
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
        $rules = ['delivery_code' => 'required',
                  'delivery_name' => 'required',
                  'delivery_fee' => 'required'];

        $this->validate($request, $rules);
        $delivery = new Delivery;
        $delivery->strDeliCode = $request->delivery_code;
        $delivery->strDeliName = $request->delivery_name;
        $delivery->txtDeliDesc = $request->delivery_description;
        $delivery->dblDeliFee = $request->delivery_fee;
        $delivery->save();

        return redirect('delivery')
          ->with('alert-success', 'Delivery was successfully added.');
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
        $delivery = Delivery::find($id);
        $name = $delivery->strDeliName;
        $delivery->delete();

        return redirect('delivery')->with('alert-success', 'Delivery '. $name .' was successfully deleted.');
    }

    public function delivery_update(Request $request)
     {
       $rules = ['delivery_name' => 'required',
                  'delivery_fee' => 'required'];
       $id = $request->delivery_code;

       $this->validate($request, $rules);
       $delivery = Delivery::find($id);
       $delivery->strDeliName = $request->delivery_name;
       $delivery->txtDeliDesc = $request->delivery_description;
       $delivery->dblDeliFee = $request->delivery_fee;
       $delivery->save();

       return redirect('delivery')->with('alert-success', 'Delivery ' . $id . ' was successfully updated.');
     }

     public function delivery_restore(Request $request)
     {
       $id = $request->delivery_code;
       $delivery = Delivery::onlyTrashed()->where('strDeliCode', '=', $id)->firstOrFail();
       $delivery->restore();

       return redirect('delivery')->with('alert-success', 'Delivery ' . $id . ' was successfully restored.');
     }
}
