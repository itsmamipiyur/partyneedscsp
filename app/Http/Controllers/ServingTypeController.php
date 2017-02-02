<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServingType;

class ServingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ids = \DB::table('tblServeType')
            ->select('strServTypeCode')
            ->orderBy('strServTypeCode', 'desc')
            ->first();

        if ($ids == null) {
          $newID = $this->smartCounter("SRVTYP000");
        }else{
          $newID = $this->smartCounter($ids->strServTypeCode);
        }

        $servingTypes = ServingType::withTrashed()->get();
        return view('maintenance.servingType')
            ->with('servingTypes', $servingTypes)
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
        $rules = ['serving_type_code' => 'required',
                  'serving_type_name' => 'required'];

        $this->validate($request, $rules);
        $servingType = new ServingType;
        $servingType->strServTypeCode = $request->serving_type_code;
        $servingType->strServTypeName = $request->serving_type_name;
        $servingType->txtServTypeDesc = $request->serving_type_description;
        $servingType->save();

        return redirect('servingType')
          ->with('alert-success', 'Serving Type was successfully added.');
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
        $servingType = ServingType::find($id);
        $name = $servingType->strServTypeName;
        $servingType->delete();

        return redirect('servingType')->with('alert-success', 'ServType '. $name .' was successfully deleted.');
    }

    public function servingType_update(Request $request)
     {
       $rules = ['serving_type_name' => 'required | max:100'];
       $id = $request->serving_type_code;

       $this->validate($request, $rules);
       $servingType = ServingType::find($id);
       $servingType->strServTypeName = $request->serving_type_name;
       $servingType->txtServTypeDesc = $request->serving_type_description;
       $servingType->save();

       return redirect('servingType')->with('alert-success', 'ServType ' . $id . ' was successfully updated.');
     }

     public function servingType_restore(Request $request)
     {
       $id = $request->serving_type_code;
       $servingType = ServinfType::onlyTrashed()->where('strServTypeCode', '=', $id)->firstOrFail();
       $servingType->restore();

       return redirect('servingType')->with('alert-success', 'ServType ' . $id . ' was successfully restored.');
     }
}
