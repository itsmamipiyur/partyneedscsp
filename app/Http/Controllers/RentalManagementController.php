<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RentalManagement;
use App\EventType;
use App\Decor;
use App\Delivery;
use App\Menu;
use App\Item;
use App\RentalPackage;

class RentalManagementController extends Controller
{
    public function index()
  {
    
    $eventTypes = EventType::all();
		$cateringTypes = ['1' => 'Buffet', '2' => 'Lauriat', '3' => 'Yon'];

		return view('maintenance/rentalManagement')
		->with('eventTypes', $eventTypes)
		->with('cateringTypes', $cateringTypes);
    
  }

  	public function createRental()
	{
		$decors = Decor::orderBy('decorName')->pluck('decorName', 'decorCode');
    	$eventTypes = EventType::orderBy('eventTypeName')->pluck('eventTypeName', 'eventTypeCode');
    	$deliveries = Delivery::orderBy('deliveryLocation')->pluck('deliveryLocation', 'deliveryCode');
    	$rentalPackages = RentalPackage::all();
    	$menus = Menu::all();
    	$items = Item::all();
    	$servingTypes = ['1' => 'Buffet', '2' => 'Set'];

		return view('transaction.createRental')
			->with('deliveries', $deliveries)
			->with('eventTypes', $eventTypes)
			->with('rentalPackages', $rentalPackages)
    		->with('decors', $decors)
    		->with('menus', $menus)
			->with('items', $items)
    		->with('servingTypes', $servingTypes);
	}
}


