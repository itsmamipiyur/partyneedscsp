<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Cart;

use App\EventOrder;
use App\Menu;
use App\MenuRate;

class EventOrderController extends Controller
{
    //
    public function orderFood()
    {
        $menus = Menu::all();
        $eventCode = Input::get('evnt');

        return view('transaction.orderFood')
            ->with('menus', $menus)
            ->with('eventCode', $eventCode);
    }

    public function addToTray(Request $request)
    {
        $rules = ['menuCode' => 'required', 'no_pax' => 'required|numeric', 'rate' => 'required'];

        $this->validate($request, $rules);
        $menu = Menu::find($request->menuCode);
        $menuRate = MenuRate::find($request->rate);

        $options = ['servingType' => $menuRate->servingType,
        			'menuRateCode' => $menuRate->menuRateCode];

        Cart::instance('order')->add($request->menuCode, $menu->menuName, $request->no_pax, $menuRate->amount, $options);

        return back();
    }

    public function destroyTray()
    {
    	Cart::instance('order')->destroy();

    	return back();
    }

 	public function storeOrder(Request $request)
 	{
 		$rules = ['eventCode' => 'required'];
 		$this->validate($request, $rules);

 		$ids = \DB::table('tblEventOrder')
	     ->select('eventOrderCode')
	     ->orderBy('eventOrderCode', 'desc')
	     ->first();

	     if ($ids == null) {
	       $newID = $this->smartCounter("EVNTODR0000");
	     }else{
	       $newID = $this->smartCounter($ids->eventOrderCode);
	     }

 		$eventOrder = new EventOrder;
 		$eventOrder->eventOrderCode = $newID;
 		$eventOrder->eventCode = $request->eventCode;
 		$eventOrder->status = '1';
 		$eventOrder->save();


 		$eventOrder = EventOrder::find($newID);
 		foreach(Cart::instance('order')->content() as $row){
 			$eventOrder->menus()->attach($row->id, ['menuRateCode' => $row->options->menuRateCode, 'pax' => $row->qty, 'servingType' => $row->options->servingType]);
 		}

 		Cart::instance('order')->destroy();

 		return redirect('eventBooking/'. $request->eventCode);
 	}

    // public function addPackageToTray(Request $request)
    // {
    //     $rules = ['packageCode' => 'required'];

    //     $this->validate($request, $rules);
    //     $package = CateringPackage::find($request->packageCode);

    //     Cart::instance('package')->add($package->cateringPackageCode, $package->cateringPackageName, 1, $package->cateringPackageAmount);

    //     return back();
    // }
}
