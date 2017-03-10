<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventManagement;
use App\EventType;

class EventManagementController extends Controller
{
    public function index()
  {
    $eventTypes = EventType::all();
    
    $cateringTypes = ['1' => 'Buffet', '2' => 'Lauriat', '3' => 'Yon'];


    return view('maintenance/eventManagement')
    ->with('eventTypes', $eventTypes)
    ->with('cateringTypes', $cateringTypes);
  }
}
