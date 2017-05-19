<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Delivery;
use App\EventType;
use App\Decor;
use App\Menu;
use App\MenuRate;
use App\CateringPackage;
use App\Customer;
use App\Event;
use Illuminate\Support\Collection;

class EventBookingController extends Controller
{
    //
    public function index()
    {
      $events = Event::all();
    	return view('transaction.eventbooking')
        ->with('events', $events);
    }

    public function createCustomer()
    {
      $deliveries = Delivery::all();
      $decors = Decor::all();
      $types = EventType::all();
      $idss = \DB::table('tblEvent')
           ->select('eventCode')
           ->orderBy('eventCode', 'desc')
           ->first();

       if ($idss == null) {
         $newID = $this->smartCounter("EVNT0000");
       }else{
         $newID = $this->smartCounter($idss->eventCode);
       }
    	return view('transaction.createCustomer')
        ->with('deliveries', $deliveries)
        ->with('decors', $decors)
        ->with('types', $types)
        ->with('event_code', $newID);
    }

    public function existingCustomer()
    {
      $customers = Customer::all();

      $deliveries = Delivery::all();
      $decors = Decor::all();
      $types = EventType::all();
      $idss = \DB::table('tblEvent')
           ->select('eventCode')
           ->orderBy('eventCode', 'desc')
           ->first();

       if ($idss == null) {
         $newID = $this->smartCounter("EVNT0000");
       }else{
         $newID = $this->smartCounter($idss->eventCode);
       }
      return view('transaction.existingCustomer')
        ->with('deliveries', $deliveries)
        ->with('decors', $decors)
        ->with('types', $types)
        ->with('event_code', $newID)
        ->with('customers', $customers);
    }

    public function storeEventDetails(Request $request)
    {
        $eventRules = ['event_code' => 'required',
                  'event_title' => 'required',
                  'event_start' => 'required',
                  'event_end' => 'required',
                  'event_types' => 'required|array|min:1',
                  'event_decors' => 'required|array|min:1',
                  'event_address' => 'required',
                  'event_delivery' => 'required',
                  'customer_code' => 'required'];

        $this->validate($request, $eventRules);

        $event = new Event;
        $event->eventCode = $request->event_code;
        $event->customerCode = $request->customer_code;
        $event->eventTitle = $request->event_title;
        $event->eventStart = $request->event_start;
        $event->eventEnd = $request->event_end;
        $event->eventAddress = $request->event_address;
        $event->deliveryId = $request->event_delivery;
        $event->save();

        $event = Event::find($request->event_code);
        $event->decors()->attach($request->get('event_decors'));
        $event->types()->attach($request->get('event_types'));

        return redirect('/eventBooking/' . $request->event_code);
    }

    public function storeCustomer(Request $request)
    {
        $rules = ['first_name' => 'required',
                  'last_name' => 'required',
                  'billing_address' => 'required',
                  'contact_no' => 'required'];

        $this->validate($request, $rules);

        $idss = \DB::table('tblCustomer')
             ->select('customerCode')
             ->orderBy('customerCode', 'desc')
             ->first();

         if ($idss == null) {
           $newID = $this->smartCounter("0000");
         }else{
           $newID = $this->smartCounter($idss->customerCode);
         }


        $customer = new Customer;
        $customer->customerCode = $newID;
        $customer->customerFirst = $request->first_name;
        $customer->customerMiddle = $request->middle_name;
        $customer->customerLast = $request->last_name;
        $customer->customerAddress = $request->billing_address;
        $customer->customerContact = $request->contact_no;
        $customer->save();

        $eventRules = ['event_code' => 'required',
                  'event_title' => 'required',
                  'event_start' => 'required',
                  'event_end' => 'required',
                  'event_types' => 'required|array|min:1',
                  'event_decors' => 'required|array|min:1',
                  'event_address' => 'required',
                  'event_delivery' => 'required'];

        $this->validate($request, $eventRules);

        $event = new Event;
        $event->eventCode = $request->event_code;
        $event->customerCode = $newID;
        $event->eventTitle = $request->event_title;
        $event->eventStart = $request->event_start;
        $event->eventEnd = $request->event_end;
        $event->eventAddress = $request->event_address;
        $event->deliveryId = $request->event_delivery;
        $event->save();

        $event = Event::find($request->event_code);
        $event->decors()->attach($request->get('event_decors'));
        $event->types()->attach($request->get('event_types'));

        return redirect('/eventBooking/' . $request->event_code);
    }

    public function viewEventDetail($id)
    {
      $event = Event::find($id);
      $totalOrderAmount = \DB::select("select sum(a.amount * b.pax) as amount, sum(b.pax) as pax from tblMenuRate a inner JOIN tblEventOrderDetail b on a.menuRateCode = b.menuRateCode inner join tblEventOrder c on b.eventOrderCode = c.eventOrderCode where c.eventCode = '$id'");

      $total = collect($totalOrderAmount)->first();

      //dd($total);

      return view('transaction.eventDetail')
        ->with('event', $event)
        ->with('total', $total);
    }
}
