<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RentalManagement;
use App\EventType;
use App\Decor;
use App\Delivery;
use App\Item;
use App\ItemRate;
use App\RentalPackage;
use App\Customer;
use Cart;
use Session;

class RentalBookingController extends Controller
{
    public function index()
  {
    
    return view('transaction.rentalbooking');
    
  }

  public function createCustomer()
    {
      return view('transaction.createCustomer1');
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

        return redirect('/rentalBooking/create/rentItem');
    }


        public function rentItem()
    {
        $custCode = Session::get('custCode');

        $customer = Customer::find($custCode);
        $items = Item::all();
        $rentalPackages = RentalPackage::all();

        return view('transaction.rentItem')
            ->with('items', $items)
            ->with('customer', $customer)
            ->with('rentalPackages', $rentalPackages);
    }


    public function addToTray(Request $request)
    {
        $rules = ['itemCode' => 'required', 'qty' => 'required|numeric', 'rate' => 'required', 'duration' => 'required|numeric'];

        $this->validate($request, $rules);
        $item = Item::find($request->itemCode);
        $itemRate = ItemRate::find($request->rate);
        $options = ['unitType' => $itemRate->unitType];
        $duration = ['duration' => $item->duration];

        Cart::instance('order')->add($request->itemCode, $item->itemName, $request->qty, $itemRate->amount, $options, $duration);

        return back();
    }


    public function addPackageToTray(Request $request)
    {
        $rules = ['packageCode' => 'required'];

        $this->validate($request, $rules);
        $package = RentalPackage::find($request->packageCode);

        Cart::instance('package')->add($package->rentalPackageCode, $package->rentalPackageName, 1, $package->rentalPackageAmount);

        return back();
    }

        public function createRentalDetail()
    {
        $deliveries = Delivery::all();
        $decors = Decor::all();
        $types = EventType::all();

        return view('transaction.createEventDetail')
            ->with('deliveries', $deliveries)
            ->with('decors', $decors)
            ->with('types', $types);
    }
    



}


