<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventType;
use Response;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $idss = \DB::table('tbleventtype')
         ->select('eventTypeCode')
         ->orderBy('eventTypeCode', 'desc')
         ->first();

     if ($idss == null) {
       $newID = $this->smartCounter("0000");
     }else{
       $newID = $this->smartCounter($idss->eventTypeCode);
     }

     $eventTypes = EventType::all();

    return view('maintenance.eventType')
      ->with('newID', $newID)
      ->with('eventTypes', $eventTypes);
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
        $rules = ['event_type_code' => 'required',
                  'event_type_name' => 'required|unique:tblEventType,eventTypeName'];

        //Validate request according to defined rules
        $this->validate($request, $rules);

        //Create an instance of EventType Model
        $eventType = new EventType;

        //Passing validated request value to eventType attributes
        $eventType->eventTypeCode = $request->event_type_code;
        $eventType->eventTypeName = $request->event_type_name;
        $eventType->eventTypeDesc = $request->event_type_description;

        //Saving Data
        $eventType->save();

        //redirect to index
        return redirect('eventType')
          ->with('alert-success', 'Event Type was successfully added.');
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
        $eventType = EventType::find($id);
        $name = $eventType->strEvenTypeName;
        $eventType->delete();

        return redirect('eventType')->with('alert-success', 'Event Type '. $name .' was successfully deactivated.');
    }

    public function eventType_update(Request $request)
    {
      $rules = ['event_type_code' => 'required',
                'event_type_name' => 'required|unique:tblEventType,eventTypeName,'.$request->event_type_code.',eventTypeCode' ];

      $id = $request->event_type_code;

      $this->validate($request, $rules);
      $eventType = EventType::find($id);
      $eventType->eventTypeName = $request->event_type_name;
      $eventType->eventTypeDesc = $request->event_type_description;
      $eventType->save();

      return redirect('eventType')->with('alert-success', 'Event Type ' . $id . ' was successfully updated.');
    }

    public function eventType_restore(Request $request)
    {
      $id = $request->event_type_code;
      $eventType = EventType::onlyTrashed()->where('eventTypeCode', '=', $id)->firstOrFail();
      $eventType->restore();

      return redirect('eventType')->with('alert-success', 'Event Type ' . $id . ' was successfully restored.');
    }

    public function showArchive()
    {
        //
       $eventtypes = EventType::onlyTrashed()->get();

        return view('archive.eventType')
            ->with('eventTypes', $eventtypes);
    }
}
