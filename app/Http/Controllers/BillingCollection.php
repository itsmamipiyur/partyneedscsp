<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BillCollection;

class BillingCollection extends Controller
{
    public function index()
  {
    
    return view('maintenance/billingCollection');
	}
}
