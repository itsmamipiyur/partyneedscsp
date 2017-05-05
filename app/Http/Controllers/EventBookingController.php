<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Delivery;
use App\Menu;

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
}
