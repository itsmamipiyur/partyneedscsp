<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;

class MenuController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

 public function index()
 {
     //
     $ids = \DB::table('tblMenu')
         ->select('strMenuCode')
         ->orderBy('strMenuCode', 'desc')
         ->first();

     if ($ids == null) {
       $newID = $this->smartCounter("MNU0000");
     }else{
       $newID = $this->smartCounter($ids->strMenu);
     }

     $menus = Menu::withTrashed()->get();
     return view('maintenance.menu')
         ->with('menus', $menus)
         ->with('newID', $newID);
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
     $rules = ['menu_code' => 'required',
               'menu_name' => 'required'];

     $this->validate($request, $rules);
     $menu = new MenuType;
     $menu->strMenuCode = $request->menu_code;
     $menu->strMenuName = $request->menu_name;
     $menu->txtMenuDesc = $request->menu_description;
     $menu->save();

     return redirect('menu')
       ->with('alert-success', 'Menu was successfully added.');
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
     $menu = Menu::find($id);
     $name = $menu->strMenuName;
     $menu->delete();

     return redirect('menu')->with('alert-success', 'Menu '. $name .' was successfully deleted.');
 }

 public function menu_update(Request $request)
  {
    $rules = ['menu_name' => 'required | max:100'];
    $id = $request->menu_code;

    $this->validate($request, $rules);
    $menu = Menu::find($id);
    $menu->strMenuName = $request->menu_name;
    $menu->txtMenuDesc = $request->menu_description;
    $menu->save();

    return redirect('menu')->with('alert-success', 'Menu ' . $id . ' was successfully updated.');
  }

  public function menu_restore(Request $request)
  {
    $id = $request->menu_code;
    $menu = Menu::onlyTrashed()->where('strMenuCode', '=', $id)->firstOrFail();
    $menu->restore();

    return redirect('menu')->with('alert-success', 'Menu ' . $id . ' was successfully restored.');
  }
}
