<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Delivery;

class DeliveryController extends Controller
{
  public function index()
  {

     $idss = \DB::table('tbldelivery')
         ->select('deliveryCode')
         ->orderBy('deliveryCode', 'desc')
         ->first();

     if ($idss == null) {
       $newID = $this->smartCounter("0000");
     }else{
       $newID = $this->smartCounter($idss->deliveryCode);
     }

     $deliveries = Delivery::all();

    return view('maintenance/delivery')
      ->with('newID', $newID)
      ->with('deliveries', $deliveries);
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
    $rules = ['delivery_code' => 'required', 'delivery_location' => 'required|max:100|unique:tbldelivery,deliveryLocation', 'delivery_fee' => 'required | max:100'];

    $this->validate($request, $rules);
    $delivery = new Delivery;
    $delivery->deliveryCode = $request->delivery_code;
    $delivery->deliveryLocation = $request->delivery_location;
    $delivery->deliveryFee = $request->delivery_fee;
    $delivery->save();

    return redirect('delivery')->with('alert-success', 'Delivery Fee was successfully saved.');
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
      $delivery = Delivery::find($id);
      return Response::json($delivery);
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
        
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $delivery = Delivery::find($id);
      $deliveryLocation = $delivery->deliveryLocation;
      $delivery->delete();

      return redirect('delivery')->with('alert-success', 'Delivery '. $deliveryLocation .' was successfully deleted.');

  }


public function delivery_update(Request $request)
    {
      $rules = ['delivery_code' => 'required', 'delivery_location' => 'required|max:100', 'delivery_fee' => 'required | max:100'];
      $id = $request->delivery_code;

      $this->validate($request, $rules);
      $delivery = Delivery::find($id);
      $delivery->deliveryLocation = $request->delivery_location;
      $delivery->deliveryFee = $request->delivery_fee;
      $delivery->save();

      return redirect('delivery')->with('alert-success', 'Delivery ' . $id . ' was successfully updated.');
    }

    public function delivery_restore(Request $request)
    {
      $id = $request->delivery_code;
      $delivery = Delivery::onlyTrashed()->where('deliveryCode', '=', $id)->firstOrFail();
      $delivery->restore();

      return redirect('delivery')->with('alert-success', 'Delivery ' . $id . ' was successfully restored.');
    }

    public function showArchive()
    {
        //
       $deliveries = Delivery::onlyTrashed()->get();

        return view('archive.delivery')
             ->with('deliveries', $deliveries);
    }
}
