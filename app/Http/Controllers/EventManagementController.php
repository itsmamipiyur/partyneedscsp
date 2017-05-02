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
use App\Customer;


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

	public function storeEvent(Request $request)
	{
		echo $request->firstName;
		echo $request->middleName;
		echo $request->lastName;
		echo $request->contactNumber;
		echo $request->billingAddress;
		//end of customerInfo

		echo $request->eventTitle;
		echo $request->eventStart;
		echo $request->eventEnd;
		echo $request->eventAddress;
		echo $request->eventDesc;
		echo $request->deliveryCode;

		foreach($request->eventType as $eventType){
			echo $eventType;
		}
		//echo $request->eventType;
		foreach($request->decor as $decor){
			echo $decor;
		}
		//end of event Detail

		$rules = ['firstName' => 'required',
				  'lastName' => 'required',
				  'contactNumber' => 'required',
				  'biliingAddress' => 'required'];

		$this->validate($request, $rules);
		$customer = new Customer;
		$customer->customerFirst = $request->firstName;
		$customer->customerMiddle = $request->middleName;
		$customer->customerLast = $request->lastName;
		$customer->customerContact = $request->contactNumber;
		$customer->customerAddress = $request->billingAddress;
		$customer->save();
		return redirect('/eventManagement');
	}

}
