<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\ItemDinnerware;
use App\ItemEquipment;
use App\EquipmentType;
use App\DinnerwareType;
use App\UOM;

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
      $uoms = UOM::orderBy('uomName')->pluck('uomName', 'uomCode');
      $items = Item::all();
      $itemTypes = ['1' => 'Dinnerware', '2' => 'Equipment'];

      return view('maintenance/item')
        ->with('newID', $newID)
        ->with('items', $items)
        ->with('equiTypes', $equiTypes)
        ->with('dinnTypes', $dinnTypes)
        ->with('itemTypes', $itemTypes)
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

     if($request->item_code == '1'){
      $this->validate($request, ['dinnerware_type' => 'required']);
     }else if($request->item_code == '2'){
      $this->validate($request, ['equipment_type' => 'required']);
     }

     $item = new Item;
     $item->itemCode = $request->item_code;
     $item->itemName = $request->item_name;
     $item->itemType = $request->item_type;
     $item->uomCode = $request->uom_code;
     $item->itemDesc = $request->item_description;
     $item->save();

     if($request->item_type == '1'){
      $itemD = new ItemDinnerware;
      $itemD->itemCode = $request->item_code;
      $itemD->dinnerwareTypeCode = $request->dinnerware_type;
      $itemD->save();
     }else if($request->item_type == '2'){
      $itemE = new ItemEquipment;
      $itemE->itemCode = $request->item_code;
      $itemE->equipmentTypeCode = $request->equipment_type;
      $itemE->save();
     }

     return redirect('item')
       ->with('alert-success', 'Item was successfully added.');
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
    }
}
