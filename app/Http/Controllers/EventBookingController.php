<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Delivery;
use App\Menu;
use App\MenuRate;
use Cart;

class EventBookingController extends Controller
{
    //
    public function index()
    {
    	return view('transaction.eventbooking');
    }

    public function createEventForNewCustomer()
    {
    	$deliveries = Delivery::all();
    	$menus = Menu::all();

    	return view('transaction.orderFood')
    		->with('deliveries', $deliveries)
    		->with('menus', $menus);
    }

    public function addToTray(Request $request)
    {
        $rules = ['menuCode' => 'required', 'no_pax' => 'required|numeric', 'rate' => 'required'];

        $this->validate($request, $rules);
        $menu = Menu::find($request->menuCode);
        $menuRate = MenuRate::find($request->rate);

        $options = ['servingType' => $menuRate->servingType];

        Cart::add($request->menuCode, $menu->menuName, $request->no_pax, $menuRate->amount, $options);

        return back();
    }
}
