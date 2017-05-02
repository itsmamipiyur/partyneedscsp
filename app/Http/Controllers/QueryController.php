<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QueryController extends Controller
{
    public function index(){
    	$query = ['1' => 'Most Avail Catering Package', '2' => 'Most Avail Menu','3' => 'Most Avail Rental Package', '4' => 'Most Rented Equipment',];

    	return view('maintenance/query')
    	->with('query', $query);
    }
}
