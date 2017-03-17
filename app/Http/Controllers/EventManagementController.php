<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventManagement;
use App\EventType;
use App\Decor;
use App\Delivery;
use App\CateringPackage;
use App\Menu;

class EventManagementController extends Controller
{
	public function index()
	{
		return view('maintenance/eventManagement');
	}

	public function createEvent()
	{
		$decors = Decor::orderBy('decorName')->pluck('decorName', 'decorCode');
    	$eventTypes = EventType::orderBy('eventTypeName')->pluck('eventTypeName', 'eventTypeCode');
    	$deliveries = Delivery::orderBy('deliveryLocation')->pluck('deliveryLocation', 'deliveryCode');
    	$cateringPackages = CateringPackage::all();
    	$menus = Menu::all();
    	$servingTypes = ['1' => 'Buffet', '2' => 'Set'];

		return view('transaction.createEvent')
			->with('deliveries', $deliveries)
			->with('eventTypes', $eventTypes)
			->with('cateringPackages', $cateringPackages)
    		->with('decors', $decors)
    		->with('menus', $menus)
    		->with('servingTypes', $servingTypes);
	}
}
