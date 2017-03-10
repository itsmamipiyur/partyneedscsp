<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ItemRate;
use App\Item;
use App\UOM;


class ItemRateController extends Controller
{
  public function index()
  {

     $idss = \DB::table('tblitemrate')
         ->select('itemRateCode')
         ->orderBy('itemRateCode', 'desc')
         ->first();

     if ($idss == null) {
       $newID = $this->smartCounter("0000");
     }else{
       $newID = $this->smartCounter($idss->itemRateCode);
     }

     $uoms = UOM::orderBy('uomName')->pluck('uomName', 'uomCode');
     $items = Item::orderBy('itemName')->pluck('itemName', 'itemCode');
     $itemRates = ItemRate::all();

    return view('maintenance/itemRate')
      ->with('newID', $newID)
      ->with('itemRates', $itemRates)
      ->with('uoms', $uoms)
      ->with('items', $items);
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
    $rules = ['item_rate_code' => 'required', 'item_code' => 'required', 'uom_code' => 'required', 'amount' => 'required | max:100'];

    $this->validate($request, $rules);
    $itemRate = new ItemRate;
    $itemRate->itemRateCode = $request->item_rate_code;
    $itemRate->itemCode = $request->item_code;
    $itemRate->uomCode = $request->uom_code;
    $itemRate->amount = $request->amount;
    $itemRate->save();

    return redirect('itemRate')->with('alert-success', 'Item Rate was successfully saved.');
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
      $uom = ItemRate::find($id);
      return Response::json($itemRate);
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
      $item = Item::find($id);
      $item->delete();

      return redirect('itemRate')->with('alert-success', 'Item Rate was successfully deleted.');
    }

    public function itemRate_update(Request $request)
    {
      $rules = ['item_rate_code' => 'required', 'item_code' => 'required', 'uom_code' => 'required', 'amount' => 'required | max:100'];

      $this->validate($request, $rules);
      $id = $request->item_rate_code;

      $itemRate = ItemRate::find($id);
      $itemRate->itemCode = $request->item_code;
      $itemRate->uomCode = $request->uom_code;
      $itemRate->amount = $request->amount;
      $itemRate->save();

      return redirect('itemRate')->with('alert-success', 'Item Rate was successfully updated.');
    }

    public function itemRate_restore(Request $request)
    {
      $id = $request->item_rate_code;
      $item = Item::onlyTrashed()->where('itemRateCode', '=', $id)->firstOrFail();
      $item->restore();

      return redirect('itemRate')->with('alert-success', 'Item Rate was successfully restored.');
    }


}
