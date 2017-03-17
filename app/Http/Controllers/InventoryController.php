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

    return view('transaction.inventory')
      ->with('items', $items);
  }
}
