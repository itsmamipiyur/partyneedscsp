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
    Route::resource('food', 'FoodController');
    Route::resource('foodCategory', 'FoodCategoryController');
    Route::resource('equipment', 'EquipmentController');
    Route::resource('equipmentType', 'EquipmentTypeController');
    Route::resource('staff', 'StaffController');
    Route::resource('package', 'PackageController');
    Route::resource('eventType', 'EventTypeController');
    Route::resource('motif', 'MotifController');
    Route::resource('menu', 'MenuController');
    Route::resource('menuType', 'MenuTypeController');
    Route::resource('drink', 'DrinkController');

    Route::post('/equipmentType/equipmentType_update', 'EquipmentTypeController@equipmentType_update');
    Route::post('/equipmentType/equipmentType_restore', 'EquipmentTypeController@equipmentType_restore');

    Route::post('/equipment/equipment_update', 'EquipmentController@equipment_update');
    Route::post('/equipment/equipment_restore', 'EquipmentController@equipment_restore');

    Route::post('/foodCategory/foodCategory_update', 'FoodCategoryController@foodCategory_update');
    Route::post('/foodCategory/foodCategory_restore', 'FoodCategoryController@foodCategory_restore');

    Route::post('/food/food_update', 'FoodController@food_update');
    Route::post('/food/food_restore', 'FoodController@food_restore');

    Route::post('/eventType/eventType_update', 'EventTypeController@eventType_update');
    Route::post('/eventType/eventType_restore', 'EventTypeController@eventType_restore');

    Route::post('/motif/motif_update', 'MotifController@motif_update');
    Route::post('/motif/motif_restore', 'MotifController@motif_restore');

    Route::post('/drink/drink_update', 'DrinkController@drink_update');
    Route::post('/drink/drink_restore', 'DrinkController@drink_restore');

    Route::post('/menuType/menuType_update', 'MenuTypeController@menuType_update');
    Route::post('/menuType/menuType_restore', 'MenuTypeController@menuType_restore');
});

