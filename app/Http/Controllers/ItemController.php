<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Item;
use App\ItemDinnerware;
use App\ItemEquipment;
use App\EquipmentType;
use App\DinnerwareType;
use App\UOM;
use App\ItemPenalty;
use App\ItemRate;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ids = \DB::table('tblitem')
          ->select('itemCode')
          ->orderBy('itemCode', 'desc')
          ->first();

      if ($ids == null) {
        $newID = $this->smartCounter("ITM0000");
      }else{
        $newID = $this->smartCounter($ids->itemCode);
      }

      $equiTypes = EquipmentType::orderBy('equipmentTypeName')->pluck('equipmentTypeName', 'equipmentTypeCode');
      $dinnTypes = DinnerwareType::orderBy('dinnerwareTypeName')->pluck('dinnerwareTypeName', 'dinnerwareTypeCode');
      $uoms = UOM::orderBy('uomSymbol')->pluck('uomSymbol', 'uomCode');
      $items = Item::all();
      $itemTypes = ['1' => 'Dinnerware', '2' => 'Equipment'];
      $itemRates = ItemRate::all();

      return view('maintenance/item')
        ->with('newID', $newID)
        ->with('items', $items)
        ->with('equiTypes', $equiTypes)
        ->with('dinnTypes', $dinnTypes)
        ->with('itemTypes', $itemTypes)
        ->with('itemRates', $itemRates)
        ->with('uoms', $uoms);
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
        $rules = ['item_code' => 'required',
               'item_name' => 'required|unique:tblItem,itemName',
               'item_type' => 'required',
               'uom_code' => 'required'];

     $this->validate($request, $rules);

     if($request->item_type== '1'){
      $this->validate($request, ['dinnerware_type' => 'required']);
     }else if($request->item_type == '2'){
      $this->validate($request, ['equipment_type' => 'required']);
     }

     $item = new Item;
     $item->itemName = $request->item_name;
     $item->itemCode = $request->item_code;
     
     $item->itemType = $request->item_type;
     $item->uomCode = $request->uom_code;
     $item->itemDesc = $request->item_description;
     $item->save();

     if($request->item_type == '1'){
      $itemD = new ItemDinnerware;
      $itemD->itemCode = $request->item_code;
      $itemD->dinnerwareTypeCode = $request->dinnerware_type;
      $itemD->save();
      //$itemD->itemDinnerware()->associate($request->dinnerwareType);
     }else if($request->item_type == '2'){
      $itemE = new ItemEquipment;
      $itemE->itemCode = $request->item_code;
      $itemE->equipmentTypeCode = $request->equipment_type;
      $itemE->save();
     }

     return redirect('item/' . $request->item_code)
       ->with('alert-success', 'Item was successfully added. Please create new item rates.');
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
        $idss = \DB::table('tblitemrate')
         ->select('itemRateCode')
         ->orderBy('itemRateCode', 'desc')
         ->first();

        $ids = \DB::table('tblitemPenalty')
         ->select('itemPenaltyCode')
         ->orderBy('itemPenaltyCode', 'desc')
         ->first();

         if ($idss == null) {
           $newID = $this->smartCounter("0000");
         }else{
           $newID = $this->smartCounter($idss->itemRateCode);
         }

         if ($ids == null) {
           $newIDs = $this->smartCounter("0000");
         }else{
           $newIDs = $this->smartCounter($ids->itemPenaltyCode);
         }

         $item = Item::find($id);
         $units = ['1' => 'Hour', '2' => 'Day'];
         $penaltyTypes = ['1' => 'Missing', '2' => 'Damaged'];
         $items = Item::orderBy('itemName')->pluck('itemName', 'itemCode');
         $itemRates = \DB::table('tblitemrate')
            ->where('itemCode', '=', $id)
            ->get();
         $penaltyFees = \DB::table('tblitemPenalty')
            ->where('itemCode', '=', $id)
            ->get();

        return view('maintenance.itemDetail')
          ->with('newID', $newID)
          ->with('newIDs', $newIDs)
          ->with('units', $units)
          ->with('item', $item)
          ->with('itemRates', $itemRates)
          ->with('penaltyTypes', $penaltyTypes)
          ->with('penaltyFees', $penaltyFees);
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
        $item = Item::find($id);
        $name = $item->itemName;
        $item->delete();

        return redirect('item')->with('alert-success', 'Item '. $name .' was successfully deleted.');
    }

    public function item_update(Request $request)
    {
      $rules = ['item_code' => 'required',
               'item_name' => 'required|unique:tblitem,itemName,'.$request->item_code.',itemCode',
               'item_type' => 'required',
               'uom_code' => 'required'];

     $this->validate($request, $rules);

     if($request->item_code == '1'){
      $this->validate($request, ['dinnerware_type' => 'required']);
     }else if($request->item_code == '2'){
      $this->validate($request, ['equipment_type' => 'required']);
     }

     $id = $request->item_code;

     $item = Item::find($id);
     $item->itemName = $request->item_name;
     $item->itemType = $request->item_type;
     $item->uomCode = $request->uom_code;
     $item->itemDesc = $request->item_description;
     $item->save();

     if($request->item_type == '1'){
      $itemD = ItemDinnerware::find($id);
      $itemD->dinnerwareTypeCode = $request->dinnerware_type;
      $itemD->save();
     }else if($request->item_type == '2'){
      $itemE = ItemEquipment::find($id);
      $itemE->equipmentTypeCode = $request->equipment_type;
      $itemE->save();
     }
      return redirect('item')->with('alert-success', 'Item ' . $id . ' was successfully updated.');
    }

    public function item_restore(Request $request)
    {
      $id = $request->item_code;
      $item = Item::onlyTrashed()->where('itemCode', '=', $id)->firstOrFail();
      $item->restore();
  
      return redirect('item')->with('alert-success', 'Item ' . $id . ' was successfully restored.');
    }

    public function item_updateRate(Request $request)
    {
      $rules = ['item_rate_code' => 'required',
                'item_code' => 'required', //|unique:tblItemRate,itemCode,NULL,itemRateCode,uomCode,' . Input::get('unit'),
                //'unit' => 'required',
                'amount' => 'required|max:100'];

      $this->validate($request, $rules);
      $amount = preg_replace('/[\,]/', '', $request->amount);
      $amount = floatval($amount);
      $itemRate = ItemRate::find($request->item_rate_code);
      //$itemRate->uomCode = $request->unit;
      $itemRate->amount = $amount;
      $itemRate->save();

      return redirect('item/' . $request->item_code)->with('alert-success', 'Item Rate was successfully updated.');
    }

    public function item_deleteRate(Request $request)
    {
      $rules = ['item_rate_code' => 'required', 'item_code' => 'required'];

      $this->validate($request, $rules);
      $itemRate = ItemRate::find($request->item_rate_code);
      $itemRate->forceDelete();

      return redirect('item/' . $request->item_code)->with('alert-success', 'Item Rate was successfully deleted.');
    }

    public function item_addRate(Request $request)
    {
      $rules = ['item_rate_code' => 'required',
                //'item_code' => 'required',
                'unit' => 'required',
                'item_code' => 'required|unique:tblItemRate,itemCode,NULL,itemRateCode,unitCode,' . Input::get('unit') .',effectiveDate,' . Input::get('effective_date'),
                'amount' => 'required|max:100',
                'effective_date' => 'required|date'];

      $this->validate($request, $rules);
      $amount = preg_replace('/[\,]/', '', $request->amount);
      $amount = floatval($amount);
      $itemRate = new ItemRate;
      $itemRate->itemRateCode = $request->item_rate_code;
      $itemRate->itemCode = $request->item_code;
      $itemRate->unitCode = $request->unit;
      $itemRate->amount = $amount;
      $itemRate->effectiveDate = $request->effective_date;
      $itemRate->save();

      return redirect('item/' . $request->item_code)->with('alert-success', 'Item Rate was successfully saved.');
    }

    public function item_addPenalty(Request $request)
    {
      $rules = ['penalty_code' => 'required',
                'minimum_quantity' => 'required',
                'penalty_type' => 'required',
                'item_code' => 'required|unique:tblitemPenalty,itemCode,NULL,itemPenaltyCode,penaltyType,' . Input::get('penalty_type') .',effectiveDate,' . Input::get('effective_date'),
                'amount' => 'required',
                'effective_date' => 'required|date'];

      $this->validate($request, $rules);
      $amount = preg_replace('/[\,]/', '', $request->amount);
      $amount = floatval($amount);
      $itemPenalty = new ItemPenalty;
      $itemPenalty->itemPenaltyCode = $request->penalty_code;
      $itemPenalty->itemCode = $request->item_code;
      $itemPenalty->penaltyType = $request->penalty_type;
      $itemPenalty->minQuantity = $request->minimum_quantity;
      $itemPenalty->effectiveDate = $request->effective_date;
      $itemPenalty->amount = $amount;
      $itemPenalty->save();

      return redirect('item/' . $request->item_code)->with('alert-success', 'Penalty was successfully saved.');
    }

    public function item_updatePenalty(Request $request)
    {
      $rules = ['penalty_code' => 'required',
                'item_code' => 'required', //|unique:tblItemRate,itemCode,NULL,itemRateCode,uomCode,' . Input::get('unit'),
                'minimum_quantity' => 'required',
                'amount' => 'required|max:100'];

      $this->validate($request, $rules);
      $amount = preg_replace('/[\,]/', '', $request->amount);
      $amount = floatval($amount);
      $itemPenalty = ItemPenalty::find($request->penalty_code);
      $itemPenalty->minQuantity = $request->minimum_quantity;
      $itemPenalty->amount = $amount;
      $itemPenalty->save();

      return redirect('item/' . $request->item_code)->with('alert-success', 'Penalty was successfully updated.');
    }

    public function item_deletePenalty(Request $request)
    {
      $rules = ['penalty_code' => 'required', 'item_code' => 'required'];

      $this->validate($request, $rules);
      $itemPenalty = ItemPenalty::find($request->penalty_code);
      $itemPenalty->forceDelete();

      return redirect('item/' . $request->item_code)->with('alert-success', 'Item Rate was successfully deleted.');
    }

    public function showArchive()
    {
      $items = Item::onlyTrashed()->get();
  
      return view('archive.item')
        ->with('items', $items);
    }
}
