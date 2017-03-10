<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RentalFill;
use App\EventType;



class RentalFillController extends Controller
{
    public function index()
  {
    $eventTypes = EventType::all();
    $type = ['1' => 'Package', '2' => 'Package+Menu'];
    $cateringTypes = ['1' => 'Buffet', '2' => 'Set'];



    return view('maintenance/rentalFill')
    ->with('eventTypes', $eventTypes)
    ->with('cateringTypes', $cateringTypes)
    ->with('type', $type);
}
}
