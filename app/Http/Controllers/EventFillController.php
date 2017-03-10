<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FillEvent;
use App\EventType;
use App\Decor;

class EventFillController extends Controller
{
    public function index()
  {
    $eventTypes = EventType::all();
    $decors = Decor::orderBy('decorName')->pluck('decorName', 'decorCode');
    $eventTypes = EventType::orderBy('eventTypeName')->pluck('eventTypeName', 'eventTypeCode');
    $cateringTypes = ['1' => 'Buffet', '2' => 'Set'];



    return view('maintenance/eventFill')
    ->with('eventTypes', $eventTypes)
    ->with('decors', $decors)
    ->with('cateringTypes', $cateringTypes);


  }
}
