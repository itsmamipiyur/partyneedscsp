<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventory;
use App\Item;
use App\ItemDinnerware;
use App\ItemEquipment;
use App\DinnerwareType;
use App\EquipmentType;

class InventoryController extends Controller
{
    public function index()
  {

  	 

    $items = Item::all();
    $penaltyType = ['1' => 'Missing', '2' => 'Damaged', '3' => 'Others'];
    $items = Item::orderBy('itemName')->pluck('itemName', 'itemCode');
    $itemTypes = ['1' => 'Dinnerware', '2' => 'Equipment'];
    $equiTypes = EquipmentType::orderBy('equipmentTypeName')->pluck('equipmentTypeName', 'equipmentTypeCode');
     $dinnTypes = DinnerwareType::orderBy('dinnerwareTypeName')->pluck('dinnerwareTypeName', 'dinnerwareTypeCode');

    return view('maintenance/inventory')
    ->with('items', $items)
    ->with('equiTypes', $equiTypes)
    ->with('dinnTypes', $dinnTypes)
    ->with('itemTypes', $itemTypes)
    ->with('penaltyType', $penaltyType);
  }
}
