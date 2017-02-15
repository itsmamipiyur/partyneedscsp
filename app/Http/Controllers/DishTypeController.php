<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DishType;

class DishTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $idss = \DB::table('tblDishType')
           ->select('dishTypeCode')
           ->orderBy('dishTypeCode', 'desc')
           ->first();

       if ($idss == null) {
         $newID = $this->smartCounter("0000");
       }else{
         $newID = $this->smartCounter($idss->dishTypeCode);
       }

       $dishtypes = DishType::all();

        return view('maintenance.dishtype')
            ->with('newID', $newID)
            ->with('dishtypes', $dishtypes);
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
        $rules = ['dishtype_name' => 'required|unique:tblDishtype,dishTypeName'];
        $this->validate($request, $rules);

        $dishType = new DishType;
        $dishType->dishTypeCode = $request->dishtype_code;
        $dishType->dishTypeName = $request->dishtype_name;
        $dishType->dishTypeDesc = $request->dishtype_description;
        $dishType->save();

        return redirect('/dishType')->with('alert-success', 'Dish Type was successfully created!');
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
    }

    public function dishType_update(Request $request){
        $rules = [
            'dishtype_name' => 'required',
            'dishtype_code' => 'required',
            ];
        $this->validate($request, $rules);

        $id = $request->dishtype_code;

        $dishType = DishType::find($id);
        $dishType->dishTypeName = $request->dishtype_name;
        $dishType->dishTypeDesc = $request->dishtype_description;
        $dishType->save();

        return redirect('/dishType')->with('alert-success', 'Dish Type was successfully updated!');
    }
}
