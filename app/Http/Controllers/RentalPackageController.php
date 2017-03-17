<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\RentalPackage;
use App\Item;

class RentalPackageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

 public function index()
 {
     //
     $ids = \DB::table('tblRentalPackage')
         ->select('rentalPackageCode')
         ->orderBy('rentalPackageCode', 'desc')
         ->first();

     if ($ids == null) {
       $newID = $this->smartCounter("RNTPKG-000");
     }else{
       $newID = $this->smartCounter($ids->rentalPackageCode);
     }

     $rentalPackages = RentalPackage::all();
     $items = Item::orderBy('itemName')->pluck('itemName', 'itemCode');
     $units = ['1' => 'Hour', '2' => 'Day'];


     return view('maintenance.rentalPackage')
         ->with('rentalPackages', $rentalPackages)
         ->with('newID', $newID)
         ->with('items', $items)
         ->with('units', $units);
 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
     //
 }

 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function store(Request $request)
 {
     //
     $rules = ['rentalPackage_code' => 'required',
               'rentalPackage_name' => 'required|unique:tblRentalPackage,rentalPackageName',
               'amount' => 'required',
               'rentalPackage_duration' => 'required',
               'rentalPackage_unit' => 'required',
               'rentalPackage_item'  => 'required|array|min:1',];

     $this->validate($request, $rules);
     $amount = preg_replace('/[\,]/', '', $request->amount);
     $amount = floatval($amount);
     $rentalPackage = new RentalPackage;
     $rentalPackage->rentalPackageCode = $request->rentalPackage_code;
     $rentalPackage->rentalPackageName = $request->rentalPackage_name;
     $rentalPackage->rentalPackageDesc = $request->rentalPackage_description;
     $rentalPackage->rentalPackageDuration = $request->rentalPackage_duration;
     $rentalPackage->rentalPackageUnit = $request->rentalPackage_unit;
     $rentalPackage->rentalPackageAmount = $amount;
     $rentalPackage->save();

     $rentalPackage = RentalPackage::find($request->rentalPackage_code);
     $items = Input::get('rentalPackage_item');
     $quantities = Input::get('quantity');

     foreach($items as $item){
     	$rentalPackage->items()->attach($item, ['quantity' => $quantities[$item]]);    	
     }


     return redirect('rentalPackage')
       ->with('alert-success', 'RentalPackage was successfully added.');
 }

 /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function show($id)
 {
     //
      $rentalPackage = RentalPackage::find($id);
      $items = RentalPackage::availableItems($id);

      return view('maintenance.rentalPackageDetail')
        ->with('rentalPackage', $rentalPackage)
        ->with('items', $items);
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function edit($id)
 {
     //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, $id)
 {
     //
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function destroy($id)
 {
     //
     $rentalPackage = RentalPackage::find($id);
     $name = $rentalPackage->rentalPackageName;
     $rentalPackage->delete();

     return redirect('rentalPackage')->with('alert-success', 'RentalPackage '. $name .' was successfully deleted.');
 }

 public function rentalPackage_update(Request $request)
  {
    $rules = ['rentalPackage_code' => 'required',
			 'rentalPackage_name' => 'required|unique:tblRentalPackage,rentalPackageName,'.$request->rentalPackage_code.',rentalPackageCode',
			 'amount' => 'required'];
    $this->validate($request, $rules);
    $amount = preg_replace('/[\,]/', '', $request->amount);
    $amount = floatval($amount);
    $id = $request->rentalPackage_code;
    $rentalPackage = RentalPackage::find($id);
    $rentalPackage->rentalPackageName = $request->rentalPackage_name;
  	$rentalPackage->rentalPackageDesc = $request->rentalPackage_description;
  	$rentalPackage->rentalPackageAmount = $amount;
    $rentalPackage->rentalPackageDuration = $request->rentalPackage_duration;
    $rentalPackage->rentalPackageUnit = $request->rentalPackage_unit;
    $rentalPackage->save();

    return redirect('rentalPackage')->with('alert-success', 'RentalPackage ' . $id . ' was successfully updated.');
  }

  public function rentalPackage_restore(Request $request)
  {
    $id = $request->rentalPackage_code;
    $rentalPackage = RentalPackage::onlyTrashed()->where('rentalPackageCode', '=', $id)->firstOrFail();
    $rentalPackage->restore();

    return redirect('rentalPackage')->with('alert-success', 'RentalPackage ' . $id . ' was successfully restored.');
  }

  public function rentalPackage_addItem(Request $request)
  {
    $rules = ['rentalPackage_code' => 'required',
              'item_code' => 'required'];
    $id = $request->rentalPackage_code;
    $rentalPackage = RentalPackage::find($request->rentalPackage_code);
	$items = Input::get('rentalPackage_item');
	$quantities = Input::get('quantity');

	foreach($items as $item){
		$rentalPackage->items()->attach($item, ['quantity' => $quantities[$item]]);    	
	}

    return redirect('/rentalPackage/'.$id)->with('alert-success', 'Rental Package Item was successfully added.');
  }

  public function rentalPackage_updateItem(Request $request)
  {
    $rules = ['rentalPackage_code' => 'required',
              'item_code' => 'required',
              'quantity' => 'required'];
    $id = $request->rentalPackage_code;
    $rentalPackage = RentalPackage::find($id);
    $rentalPackage->items()->updateExistingPivot($request->item_code, ['quantity' => $request->quantity]);

    return redirect('/rentalPackage/'.$id)->with('alert-success', 'Rental Package Item was successfully updated.');
  }

  public function rentalPackage_removeItem(Request $request)
  {
    $rules = ['rentalPackage_code' => 'required',
              'item_code' => 'required'];
    $id = $request->rentalPackage_code;
    $rentalPackage = RentalPackage::find($id);
    $rentalPackage->items()->detach($request->item_code);

    return redirect('/rentalPackage/'.$id)->with('alert-success', 'Rental Package Item was successfully removed.');
  }

  public function showArchive()
  {
      //
     $rentalPackages = RentalPackage::onlyTrashed()->get();

      return view('archive.rentalPackage')
           ->with('rentalPackages', $rentalPackages);
  }
}
