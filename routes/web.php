
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('dishType', 'DishTypeController');
    Route::resource('penalty', 'PenaltyController');
    Route::resource('waiterRatio', 'WaiterRatioController');


    Route::post('/dishType/dishType_update', 'DishTypeController@dishType_update');
    Route::post('/dishType/dishType_restore', 'DishTypeController@dishType_restore');

    Route::post('/penalty/penalty_update', 'PenaltyController@penalty_update');
    Route::post('/penalty/penalty_restore', 'PenaltyController@penalty_restore');

    Route::post('/waiterRatio/waiterRatio_update', 'WaiterRatioController@waiterRatio_update');
    Route::post('/waiterRatio/waiterRatio_restore', 'WaiterRatioController@waiterRatio_restore');
});

