<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Decor;

class DecorController extends Controller
{
  public function index()
  {

     $idss = \DB::table('tbldecor')
         ->select('decorCode')
         ->orderBy('decorCode', 'desc')
         ->first();

     if ($idss == null) {
       $newID = $this->smartCounter("0000");
     }else{
       $newID = $this->smartCounter($idss->decorCode);
     }

     $decors = Decor::all();
     $decorTypes = ['1' => 'Color Motif', '2' => 'Theme'];

    return view('maintenance/decor')
      ->with('newID', $newID)
      ->with('decors', $decors)
      ->with('decorTypes', $decorTypes);
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
    $rules = ['decor_code' => 'required', 'decor_type' => 'required', 'decor_name' => 'required |unique:tblDecor,decorName| max:100'];

    $this->validate($request, $rules);
    $decor = new Decor;
    $decor->decorCode = $request->decor_code;
    $decor->decorName = $request->decor_name;
    $decor->decorType = $request->decor_type;
    $decor->decorDesc = $request->decor_description;
    $decor->save();

    return redirect('decor')->with('alert-success', 'Decor was successfully saved.');
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
      $decor = Decor::find($id);
      return Response::json($decor);
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
        $decor = Decor::find($id);
        $name = $decor->strEvenTypeName;
        $decor->delete();

        return redirect('decor')->with('alert-success', 'Decor '. $name .' was successfully deleted.');
    }

    public function decor_update(Request $request)
    {
      $rules = ['decor_code' => 'required',
                'decor_name' => 'required',
                'decor_type' => 'required'];

      $id = $request->decor_code;

      $this->validate($request, $rules);
      $decor = Decor::find($id);
      $decor->decorName = $request->decor_name;
      $decor->decorType = $request->decor_type;
      $decor->decorDesc = $request->decor_description;
      $decor->save();

      return redirect('decor')->with('alert-success', 'Decor ' . $id . ' was successfully updated.');
    }

    public function decor_restore(Request $request)
    {
      $id = $request->decor_code;
      $decor = Decor::onlyTrashed()->where('decorCode', '=', $id)->firstOrFail();
      $decor->restore();

      return redirect('decor')->with('alert-success', 'Decor ' . $id . ' was successfully restored.');
    }

    public function showArchive()
    {
        //
       $decors = Decor::onlyTrashed()->get();

        return view('archive.decor')
             ->with('decors', $decors);
    }

}
