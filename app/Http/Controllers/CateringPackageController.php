<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\CateringPackage;
use App\Menu;
use App\Item;

class CateringPackageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
     //
   $cateringPackages = CateringPackage::all();

   return view('maintenance.cateringPackage')
   ->with('cateringPackages', $cateringPackages);
 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
     //
     $ids = \DB::table('tblCateringPackage')
     ->select('cateringPackageCode')
     ->orderBy('cateringPackageCode', 'desc')
     ->first();

     if ($ids == null) {
       $newID = $this->smartCounter("PKG0000");
     }else{
       $newID = $this->smartCounter($ids->cateringPackageCode);
     }

     $menus = Menu::orderBy('menuName')->get();
     $items = Item::orderBy('itemName')->get();

     return view('maintenance.cateringPackageCreate')
       ->with('newID', $newID)
       ->with('menus', $menus)
       ->with('items', $items);
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
   $rules = ['cateringPackage_code' => 'required',
   'cateringPackage_name' => 'required|unique:tblCateringPackage,cateringPackageName',
   'amount' => 'required',
   'servingType' => 'required',
   'cateringPackage_menu' => 'required|array|min:1',
   'cateringPackage_item' => 'required|array|min:1',
   'quantity' => 'required|array|min:1',
   'hour' => 'required|array|min:1',
   'cateringPackage_pax' => 'required|numeric'];

   $this->validate($request, $rules);
   $amount = preg_replace('/[\,]/', '', $request->amount);
   $amount = floatval($amount);
   $cateringPackage = new CateringPackage;
   $cateringPackage->cateringPackageCode = $request->cateringPackage_code;
   $cateringPackage->cateringPackageName = $request->cateringPackage_name;
   $cateringPackage->cateringPackageDesc = $request->cateringPackage_description;
   $cateringPackage->cateringPackagePax = $request->cateringPackage_pax;
   $cateringPackage->cateringPackageServingType = $request->servingType;
   $cateringPackage->cateringPackageAmount = $amount;
   $cateringPackage->save();

   $cateringPackage = CateringPackage::find($request->cateringPackage_code);
   $menus = Input::get('cateringPackage_menu');
   $items = Input::get('cateringPackage_item');
   $quantities = Input::get('quantity');
   $duration = Input::get('hour');


   foreach($menus as $menu){
      $cateringPackage->menus()->attach($menu);
   }

   foreach($items as $item){
      $cateringPackage->items()->attach($item, ['quantity' => $quantities[$item], 'duration' => $duration[$item]]);
   }

   return redirect('cateringPackage')
   ->with('alert-success', 'Catering Package was successfully added.');
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
  $cateringPackage = CateringPackage::find($id);
  $menus = CateringPackage::availableMenus($id)->pluck('menuName', 'menuCode');
  $items = CateringPackage::availableItems($id)->pluck('itemName', 'itemCode');

  return view('maintenance.cateringPackageDetail')
  ->with('cateringPackage', $cateringPackage)
  ->with('menus', $menus)
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
   $cateringPackage = CateringPackage::find($id);
   $name = $cateringPackage->cateringPackageName;
   $cateringPackage->delete();

   return redirect('cateringPackage')->with('alert-success', 'CateringPackage '. $name .' was successfully deleted.');
 }

 public function cateringPackage_update(Request $request)
 {
    $rules = ['cateringPackage_code' => 'required',
    'cateringPackage_name' => 'required|unique:tblCateringPackage,cateringPackageName,'.$request->cateringPackage_code.',cateringPackageCode',
    'amount' => 'required',];
    $this->validate($request, $rules);
    $amount = preg_replace('/[\,]/', '', $request->amount);
    $amount = floatval($amount);
    $id = $request->cateringPackage_code;
    $cateringPackage = CateringPackage::find($id);
    $cateringPackage->cateringPackageName = $request->cateringPackage_name;
    $cateringPackage->cateringPackageDesc = $request->cateringPackage_description;
    $cateringPackage->cateringPackageAmount = $amount;
    $cateringPackage->save();

    return redirect('cateringPackage')->with('alert-success', 'CateringPackage ' . $id . ' was successfully updated.');
  }

  public function cateringPackage_restore(Request $request)
  {
    $id = $request->cateringPackage_code;
    $cateringPackage = CateringPackage::onlyTrashed()->where('cateringPackageCode', '=', $id)->firstOrFail();
    $cateringPackage->restore();

    return redirect('cateringPackage')->with('alert-success', 'CateringPackage ' . $id . ' was successfully restored.');
  }

  public function cateringPackage_addMenu(Request $request)
  {
    $rules = ['cateringPackage_code' => 'required',
              'menu_code' => 'required'];
    $id = $request->cateringPackage_code;
    $cateringPackage = CateringPackage::find($id);
    $cateringPackage->menus()->attach($request->menu_code);

    return redirect('/cateringPackage/'.$id)->with('alert-success', 'Catering Package Dish was successfully added.');
  }

  public function cateringPackage_addItem(Request $request)
  {
    $rules = ['cateringPackage_code' => 'required',
              'item_code' => 'required',
              'quantity' => 'required|digits:11',
              'duration' => 'required'];
    $id = $request->cateringPackage_code;
    $cateringPackage = CateringPackage::find($id);
    $cateringPackage->items()->attach($request->item_code, ['quantity' => $request->quantity, 'duration' => $request->duration]);

    return redirect('/cateringPackage/'.$id)->with('alert-success', 'Catering Package Item was successfully added.');
  }

  public function cateringPackage_removeMenu(Request $request)
  {
    $rules = ['cateringPackage_code' => 'required',
    'menu_code' => 'required'];
    $id = $request->cateringPackage_code;
    $cateringPackage = CateringPackage::find($id);
    $cateringPackage->menus()->detach($request->menu_code);

    return redirect('/cateringPackage/'.$id)->with('alert-success', 'Catering Package Dish was successfully removed.');
  }

  public function cateringPackage_removeItem(Request $request)
  {
    $rules = ['cateringPackage_code' => 'required',
    'item_code' => 'required'];
    $id = $request->cateringPackage_code;
    $cateringPackage = CateringPackage::find($id);
    $cateringPackage->items()->detach($request->item_code);

    return redirect('/cateringPackage/'.$id)->with('alert-success', 'Catering Package Item was successfully removed.');
  }

  public function cateringPackage_updateMenu(Request $request)
  {
    $rules = ['cateringPackage_code' => 'required',
              'menu_code' => 'required'];
    $id = $request->cateringPackage_code;
    $cateringPackage = CateringPackage::find($id);
    $cateringPackage->menus()->updateExistingPivot($request->menu_code);

    return redirect('/cateringPackage/'.$id)->with('alert-success', 'Catering Package Menu was successfully updated.');
  }

  public function cateringPackage_updateItem(Request $request)
  {
    $rules = ['cateringPackage_code' => 'required',
              'item_code' => 'required',
              'quantity' => 'required',
              'duration' => 'required'];
    $id = $request->cateringPackage_code;
    $cateringPackage = CateringPackage::find($id);
    $cateringPackage->items()->updateExistingPivot($request->item_code, ['quantity' => $request->quantity, 'duration' => '$request->duration']);

    return redirect('/cateringPackage/'.$id)->with('alert-success', 'Catering Package Item was successfully updated.');
  }

  public function showArchive()
  {
        //
     $cateringPackages = CateringPackage::onlyTrashed()->get();

      return view('archive.cateringPackage')
           ->with('cateringPackages', $cateringPackages);
  }
}
