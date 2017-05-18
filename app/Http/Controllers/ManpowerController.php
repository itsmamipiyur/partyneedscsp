<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Manpower;

class ManpowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $idss = \DB::table('tblmanpower')
         ->select('manpowerCode')
         ->orderBy('manpowerCode', 'desc')
         ->first();

     if ($idss == null) {
       $newID = $this->smartCounter("0000");
     }else{
       $newID = $this->smartCounter($idss->manpowerCode);
     }

     $manpowers = Manpower::all();

    return view('maintenance.manpower')
      ->with('newID', $newID)
      ->with('manpowers', $manpowers);
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
        //Define Validation Rules
        $rules = ['manpower_code' => 'required',
                  'manpower_position' => 'required|unique:tblManpower,manpowerPosition'];

        //Validate request according to defined rules
        $this->validate($request, $rules);

        //Create an instance of Manpower Model
        $manpower = new Manpower;

        //Passing validated request value to manpower attributes
        $manpower->manpowerCode = $request->manpower_code;
        $manpower->manpowerPosition = $request->manpower_position;
        $manpower->manpowerDesc = $request->manpower_description;
        $manpower->manpowerRate = $request->manpower_rate;

        //Saving Data
        $manpower->save();

        //redirect to index
        return redirect('manpower')
          ->with('alert-success', 'Manpower was successfully added.');
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
        $manpower = Manpower::find($id);
        $position = $manpower->manpowerPosition;
        $manpower->delete();

        return redirect('manpower')->with('alert-success', 'Manpower '. $position .' was successfully deactivated.');
    }

    public function manpower_update(Request $request)
    {
      $rules = ['manpower_code' => 'required',
                'manpower_position' => 'required|unique:tblManpower,manpowerPosition,'.$request->manpower_code.',manpowerCode' ];

      $id = $request->manpower_code;

      $this->validate($request, $rules);
      $manpower = Manpower::find($id);
      $manpower->manpowerPosition = $request->manpower_position;
      $manpower->manpowerDesc = $request->manpower_description;
      $manpower->manpowerRate = $request->manpower_rate;
      $manpower->save();

      return redirect('manpower')->with('alert-success', 'Manpower ' . $id . ' was successfully updated.');
    }

    public function manpower_restore(Request $request)
    {
      $id = $request->manpower_code;
      $manpower = Manpower::onlyTrashed()->where('manpowerCode', '=', $id)->firstOrFail();
      $manpower->restore();

      return redirect('manpower')->with('alert-success', 'Manpower ' . $id . ' was successfully restored.');
    }

    public function showArchive()
    {
        //
       $manpowers = Manpower::onlyTrashed()->get();

        return view('archive.manpower')
            ->with('manpowers', $manpowers);
    }
}
