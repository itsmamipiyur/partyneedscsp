<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RentalManagement;

class RentalManagementController extends Controller
{
    public function index()
  {
    
    return view('maintenance/rentalManagement');
    
  }
}
