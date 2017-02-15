<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MenuType;

class MenuTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ids = \DB::table('tblMenuType')
            ->select('strMenuTypeCode')
            ->orderBy('strMenuTypeCode', 'desc')
            ->first();

        if ($ids == null) {
          $newID = $this->smartCounter("MNT0000");
        }else{
          $newID = $this->smartCounter($ids->strMenuTypeCode);
        }

        $menuTypes = MenuType::all();
        return view('maintenance.menuType')
            ->with('menuTypes', $menuTypes)
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
        $rules = ['menu_type_code' => 'required',
                  'menu_type_name' => 'required'];

        $this->validate($request, $rules);
        $menuType = new MenuType;
        $menuType->strMenuTypeCode = $request->menu_type_code;
        $menuType->strMenuTypeName = $request->menu_type_name;
        $menuType->txtMenuTypeDesc = $request->menu_type_description;
        $menuType->save();

        return redirect('menuType')
          ->with('alert-success', 'Menu Type was successfully added.');
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
        $menuType = MenuType::find($id);
        $name = $menuType->strMenuTypeName;
        $menuType->delete();

        return redirect('menuType')->with('alert-success', 'Menu Type '. $name .' was successfully deleted.');
    }

    public function menuType_update(Request $request)
     {
       $rules = ['menu_type_name' => 'required | max:100'];
       $id = $request->menu_type_code;

       $this->validate($request, $rules);
       $menuType = MenuType::find($id);
       $menuType->strMenuTypeName = $request->menu_type_name;
       $menuType->txtMenuTypeDesc = $request->menu_type_description;
       $menuType->save();

       return redirect('menuType')->with('alert-success', 'Menu Type ' . $id . ' was successfully updated.');
     }

     public function menuType_restore(Request $request)
     {
       $id = $request->menu_type_code;
       $menuType = MenuType::onlyTrashed()->where('strMenuTypeCode', '=', $id)->firstOrFail();
       $menuType->restore();

       return redirect('menuType')->with('alert-success', 'Menu Type ' . $id . ' was successfully restored.');
     }
}
