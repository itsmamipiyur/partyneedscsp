<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DinnerwareType;

class DinnerwareTypeController extends Controller
{
  public function index()
  {

     $idss = \DB::table('tbldinnerwaretype')
         ->select('dinnerwareTypeCode')
         ->orderBy('dinnerwareTypeCode', 'desc')
         ->first();

     if ($idss == null) {
       $newID = $this->smartCounter("0000");
     }else{
       $newID = $this->smartCounter($idss->dinnerwareTypeCode);
     }

     $dinnerwareTypes = DinnerwareType::all();

    return view('maintenance.dinnerwareType')
      ->with('newID', $newID)
      ->with('dinnerwareTypes', $dinnerwareTypes);
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
    $rules = ['dinnerware_type_code' => 'required', 'dinnerware_type_name' => 'required | max:100'];

    $this->validate($request, $rules);
    $dinnerwareType = new DinnerwareType;
    $dinnerwareType->dinnerwareTypeCode = $request->dinnerware_type_code;
    $dinnerwareType->dinnerwareTypeName = $request->dinnerware_type_name;
    $dinnerwareType->dinnerwareTypeDesc = $request->dinnerware_type_description;
    $dinnerwareType->save();

    return redirect('dinnerwareType')->with('alert-success', 'Dinnerware Type was successfully saved.');
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
      $dinnerwareType = DinnerwareType::find($id);
      return Response::json($dinnerType);
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

    $dinnerwareType = DinnerwareType::find($id);
        $name = $dinnerwareType->dinnerwareTypeName;
        $dinnerwareType->delete();

        return redirect('dinnerwareType')->with('alert-success', 'Dinnerware Type '. $name .' was successfully deleted.');
  }

  public function dinnerwareType_update(Request $request)
    {
      $rules = ['dinnerware_type_name' => 'required | max:100'];
      $id = $request->dinnerware_type_code;

      $this->validate($request, $rules);
      $dinnerwareType = DinnerwareType::find($id);
      $dinnerwareType->dinnerwareTypeName = $request->dinnerware_type_name;
      $dinnerwareType->dinnerwareTypeDesc = $request->dinnerware_type_description;
      $dinnerwareType->save();

      return redirect('dinnerwareType')->with('alert-success', 'Dinnerware Type ' . $id . ' was successfully updated.');
    }

    public function dinnerwareType_restore(Request $request)
    {
      $id = $request->dinnerware_type_code;
      $dinnerwareType = DinnerwareType::onlyTrashed()->where('dinnerwareTypeCode', '=', $id)->firstOrFail();
      $dinnerwareType->restore();

      return redirect('dinnerwareType')->with('alert-success', 'Dinnerware Type ' . $id . ' was successfully restored.');
    }

}
