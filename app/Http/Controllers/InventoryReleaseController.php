<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InventoryRelease;


class InventoryReleaseController extends Controller
{
    public function index()
  {

    return view('maintenance/inventoryRelease');
   
  }
}
