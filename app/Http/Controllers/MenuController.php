<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuType;
use App\Dish;

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
         ->select('menuCode')
         ->orderBy('menuCode', 'desc')
         ->first();

     if ($ids == null) {
       $newID = $this->smartCounter("MEN0000");
     }else{
       $newID = $this->smartCounter($ids->menuCode);
     }

     $menus = Menu::all();
     $menuTypes = array('1' => 'Buffet', '2' => 'Set');
     $dishes = Dish::orderBy('dishName')->pluck('dishName', 'dishCode');

     return view('maintenance.menu')
         ->with('menus', $menus)
         ->with('menuTypes', $menuTypes)
         ->with('newID', $newID)
         ->with('dishes', $dishes);
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
               'menu_name' => 'required|unique:tblMenu,menuName',
               'menu_type' => 'required'];

     $this->validate($request, $rules);

     if($request->menu_code == '1'){
      $this->validate($request, ['dish_code' => 'required']);
     }

     $menu = new Menu;
     $menu->menuCode = $request->menu_code;
     $menu->menuName = $request->menu_name;
     $menu->menuType = $request->menu_type;
     $menu->menuDesc = $request->menu_description;
     $menu->save();

     if($request->menu_code == '1'){
      $menu->dishes()->attach($request->dish_code);
    }

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
      $menu = Menu::find($id);
      $dishes = Dish::orderBy('dishName')->pluck('dishName', 'dishCode');

      return view('maintenance.menuDetail')
        ->with('menu', $menu)
        ->with('dishes', $dishes);
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
    $rules = ['menu_name' => 'required | max:100',
              'menu_type' => 'required'];
    $id = $request->menu_code;

    if($request->menu_code == '1'){
      $this->validate($request, ['dish_code' => 'required']);
    }

    $this->validate($request, $rules);
    $menu = Menu::find($id);
    $menu->menuName = $request->menu_name;
    $menu->menuType = $request->menu_type;
    $menu->menuDesc = $request->menu_description;
    $menu->save();

    if($request->menu_code == '1'){
      $menu->dishes()->attach($request->dish_code);
    }

    return redirect('menu')->with('alert-success', 'Menu ' . $id . ' was successfully updated.');
  }

  public function menu_restore(Request $request)
  {
    $id = $request->menu_code;
    $menu = Menu::onlyTrashed()->where('strMenuCode', '=', $id)->firstOrFail();
    $menu->restore();

    return redirect('menu')->with('alert-success', 'Menu ' . $id . ' was successfully restored.');
  }

  public function menu_addDish(Request $request)
  {
    $rules = ['menu_code' => 'required',
              'dish_code' => 'required'];
    $id = $request->menu_code;
    $menu = Menu::find($id);

    $menu->dishes()->attach($request->dish_code);

    return redirect('/menu/'.$id)->with('alert-success', 'Menu Dish was successfully added.');
  }

  public function menu_removeDish(Request $request)
  {
    $rules = ['menu_code' => 'required'];
    $id = $request->menu_code;
    $menu = Menu::find($id);

    $menu->dishes()->detach($request->dish_code);

    return redirect('/menu/'.$id)->with('alert-success', 'Menu Dish was successfully removed.');
  }
}
