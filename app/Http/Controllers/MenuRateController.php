<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MenuRate;
use App\Menu;


class MenuRateController extends Controller
{
  public function index()
  {

     $idss = \DB::table('tblmenurate')
         ->select('menuRateCode')
         ->orderBy('menuRateCode', 'desc')
         ->first();

     if ($idss == null) {
       $newID = $this->smartCounter("0000");
     }else{
       $newID = $this->smartCounter($idss->menuRateCode);
     }

     $servingTypes = ['1' => 'Buffet', '2' => 'Set'];
     $menus = Menu::orderBy('menuName')->pluck('menuName', 'menuCode');
     $menuRates = MenuRate::all();

    return view('maintenance.menuRate')
      ->with('newID', $newID)
      ->with('menuRates', $menuRates)
      ->with('servingTypes', $servingTypes)
      ->with('menus', $menus);
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
    $rules = ['menu_rate_code' => 'required', 'menu_code' => 'required', 'serving_type' => 'required', 'amount' => 'required | max:100'];

    $this->validate($request, $rules);

    if($request->serving_type == '1'){
    	$this->validate($request, ['quantity' => 'required']);
    }

    $menuRate = new MenuRate;
    $menuRate->menuRateCode = $request->menu_rate_code;
    $menuRate->menuCode = $request->menu_code;
    $menuRate->servingType = $request->serving_type;
	  $menuRate->quantity = $request->quantity;   
    $menuRate->amount = $request->amount;
    $menuRate->save();

    return redirect('menuRate')->with('alert-success', 'Menu Rate was successfully saved.');
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
      $uom = MenuRate::find($id);
      return Response::json($menuRate);
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
      $menu = Menu::find($id);
      $menu->delete();

      return redirect('menuRate')->with('alert-success', 'Menu Rate was successfully deleted.');
    }

    public function menuRate_update(Request $request)
    {
      $rules = ['menu_rate_code' => 'required', 'menu_code' => 'required', 'serving_type' => 'required', 'amount' => 'required | max:100'];

    $this->validate($request, $rules);

    if($request->serving_type == '1'){
    	$this->validate($request, ['quantity' => 'required']);
    }

    $id = $request->menu_rate_code;
    $menuRate = MenuRate::find($id);
    $menuRate->menuCode = $request->menu_code;
    $menuRate->servingType = $request->serving_type;
	  $menuRate->quantity = $request->quantity;   
    $menuRate->amount = $request->amount;
    $menuRate->save();

      return redirect('menuRate')->with('alert-success', 'Menu Rate was successfully updated.');
    }

    public function menuRate_restore(Request $request)
    {
      $id = $request->menu_rate_code;
      $menu = Menu::onlyTrashed()->where('menuRateCode', '=', $id)->firstOrFail();
      $menu->restore();

      return redirect('menuRate')->with('alert-success', 'Menu Rate was successfully restored.');
    }


}
