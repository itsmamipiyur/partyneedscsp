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
use Cart;
use Session;

class EventBookingController extends Controller
{
    //
    public function index()
    {
    	return view('transaction.eventbooking');
    }

    public function createCustomer()
    {
    	return view('transaction.createCustomer');
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

        if (!Session::has('custCode')) {
            Session::put('custCode', $newID);
        }

        return redirect('/eventBooking/create/orderFood');
    }

    public function createEventDetail()
    {
        $deliveries = Delivery::all();
        $decors = Decor::all();
        $types = EventType::all();

        return view('transaction.createEventDetail')
            ->with('deliveries', $deliveries)
            ->with('decors', $decors)
            ->with('types', $types);
    }

    public function orderFood()
    {
        $custCode = Session::get('custCode');

        $customer = Customer::find($custCode);
        $menus = Menu::all();
        $cateringPackages = CateringPackage::all();

        return view('transaction.orderFood')
            ->with('menus', $menus)
            ->with('customer', $customer)
            ->with('cateringPackages', $cateringPackages);
    }

    public function addToTray(Request $request)
    {
        $rules = ['menuCode' => 'required', 'no_pax' => 'required|numeric', 'rate' => 'required'];

        $this->validate($request, $rules);
        $menu = Menu::find($request->menuCode);
        $menuRate = MenuRate::find($request->rate);

        $options = ['servingType' => $menuRate->servingType];

        Cart::instance('order')->add($request->menuCode, $menu->menuName, $request->no_pax, $menuRate->amount, $options);

        return back();
    }

    public function addPackageToTray(Request $request)
    {
        $rules = ['packageCode' => 'required'];

        $this->validate($request, $rules);
        $package = CateringPackage::find($request->packageCode);

        Cart::instance('package')->add($package->cateringPackageCode, $package->cateringPackageName, 1, $package->cateringPackageAmount);

        return back();
    }

    public function processQuotation(Request $request)
    {
        $rules = ['event_title' => 'required',
                  'event_start' => 'required',
                  'event_end' => 'required',
                  'event_types' => 'required|array|min:1',
                  'event_decors' => 'required|array|min:1',
                  'event_address' => 'required',
                  'event_delivery' => 'required'];

        $this->validate($request, $rules);

        $types = EventType::find($request->event_types);
        $decors = Decor::find($request->event_decors);
        $delivery = Delivery::find($request->event_delivery);
        $customer = Customer::find(Session::get('custCode'));

        return redirect('eventBooking/viewQuotation')
            ->with('eventDetail', $request->all())
            ->with('types', $types)
            ->with('decors', $decors)
            ->with('delivery', $delivery);
    }

    public function viewQuotation()
    {
        return view('transaction.viewQuotation');
    }
}
