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
use App\Customer;
use Cart;
use Session;

class RentalManagementController extends Controller
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

        return redirect('/rentalbooking/create/rentItem');
    }


        public function rentItem()
    {
        $custCode = Session::get('custCode');

        $customer = Customer::find($custCode);
        $items = Item::all();
        $rentalPackages = RentalPackage::all();

        return view('transaction.rentItem')
            ->with('item', $items)
            ->with('customer', $customer)
            ->with('rentalPackages', $rentalPackages);
    }
    

  //   public function createRental()
  // {
  //   $decors = Decor::orderBy('decorName')->pluck('decorName', 'decorCode');
  //     $eventTypes = EventType::orderBy('eventTypeName')->pluck('eventTypeName', 'eventTypeCode');
  //     $deliveries = Delivery::orderBy('deliveryLocation')->pluck('deliveryLocation', 'deliveryCode');
  //     $rentalPackages = RentalPackage::all();
  //     $menus = Menu::all();
  //     $items = Item::all();
  //     $servingTypes = ['1' => 'Buffet', '2' => 'Set'];

  //   return view('transaction.createRental')
  //     ->with('deliveries', $deliveries)
  //     ->with('eventTypes', $eventTypes)
  //     ->with('rentalPackages', $rentalPackages)
  //       ->with('decors', $decors)
  //       ->with('menus', $menus)
  //     ->with('items', $items)
  //       ->with('servingTypes', $servingTypes);
  // }


   public function createRentalDetail()
    {
        $deliveries = Delivery::all();
        $decors = Decor::all();
        $types = EventType::all();

        return view('transaction.createRentalDetail')
            ->with('deliveries', $deliveries);

    }
}


