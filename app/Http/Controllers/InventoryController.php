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
use App\InventoryStock;
use App\InventoryRelease;

class InventoryController extends Controller
{
	public function index()
	{
		//$items = Item::all();

		$items = \DB::table('tblItem')
				->leftJoin('tblInventoryStock', 'tblItem.itemCode', '=', 'tblInventoryStock.itemCode')
				->leftJoin('tblInventoryRelease', 'tblItem.itemCode', '=', 'tblInventoryRelease.itemCode')
				->select(\DB::raw('tblItem.itemCode, itemName, itemDesc, sum(tblInventoryStock.quantity) as onHand, sum(tblInventoryRelease.quantity) as quantityReleased'))
				->groupBy('tblItem.itemCode')
				->get();

		return view('transaction.inventory')
		->with('items', $items);
	}

	public function addStock(Request $request)
	{
		$rules = ['item_code' => 'required', 'quantity' => 'required|numeric'];

		$this->validate($request, $rules);

		$ids = \DB::table('tblInventoryStock')
          ->select('inventoryStockCode')
          ->orderBy('inventoryStockCode', 'desc')
          ->first();

	    if ($ids == null) {
	      $newID = $this->smartCounter("000000");
	    }else{
	      $newID = $this->smartCounter($ids->inventoryStockCode);
	    }

	    $invStock = new InventoryStock;
	    $invStock->inventoryStockCode = $newID;
	    $invStock->itemCode = $request->item_code;
	    $invStock->quantity = $request->quantity;
	    $invStock->save();

	    return redirect('inventory')
	    	->with('alert-success', "Quantity was added.");

	}

	public function releaseStock(Request $request)
	{
		$rules = ['item_code' => 'required', 'quantity' => 'required|numeric'];

		$this->validate($request, $rules);

		$ids = \DB::table('tblInventoryRelease')
          ->select('inventoryReleaseCode')
          ->orderBy('inventoryReleaseCode', 'desc')
          ->first();

        $stock = \DB::table('tblItem')
				->leftJoin('tblInventoryStock', 'tblItem.itemCode', '=', 'tblInventoryStock.itemCode')
				->leftJoin('tblInventoryRelease', 'tblItem.itemCode', '=', 'tblInventoryRelease.itemCode')
				->select(\DB::raw('(sum(tblInventoryStock.quantity) - sum(tblInventoryRelease.quantity)) as currStock'))
				->where('tblItem.itemCode', $request->item_code)
				->groupBy('tblItem.itemCode')
				->first(); 

		$currStock = intval($stock->currStock);
		if($request->quantity > $currStock){
			return redirect('inventory')
			->with('alert-failed', 'Quantity requested is greater than the current stock.');
		} 

	    if ($ids == null) {
	      $newID = $this->smartCounter("000000");
	    }else{
	      $newID = $this->smartCounter($ids->inventoryReleaseCode);
	    }

	    $invRelease = new InventoryRelease;
	    $invRelease->inventoryReleaseCode = $newID;
	    $invRelease->itemCode = $request->item_code;
	    $invRelease->quantity = $request->quantity;
	    $invRelease->save();

	    return redirect('inventory')
	    	->with('alert-success', "Quantity was released.");

	}
}
