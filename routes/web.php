
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
    Route::resource('equipmentRate', 'EquipmentRateController');
    Route::resource('staff', 'StaffController');
    Route::resource('servingType', 'ServingTypeController');
    Route::resource('eventType', 'EventTypeController');
    Route::resource('motif', 'MotifController');
    Route::resource('menu', 'MenuController');
    Route::resource('menuType', 'MenuTypeController');
    Route::resource('unit', 'UnitController');
    Route::resource('delivery', 'DeliveryController');


    Route::post('/equipmentType/equipmentType_update', 'EquipmentTypeController@equipmentType_update');
    Route::post('/equipmentType/equipmentType_restore', 'EquipmentTypeController@equipmentType_restore');

    Route::post('/equipmentRate/equipmentRate_update', 'EquipmentTypeController@equipmentRate_update');
    Route::post('/equipmentRate/equipmentRate_restore', 'EquipmentTypeController@equipmentRate_restore');

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

    Route::post('/unit/unit_update', 'UnitController@unit_update');
    Route::post('/unit/unit_restore', 'UnitController@unit_restore');

    Route::post('/menuType/menuType_update', 'MenuTypeController@menuType_update');
    Route::post('/menuType/menuType_restore', 'MenuTypeController@menuType_restore');

    Route::post('/servingType/servingType_update', 'ServingTypeController@servingType_update');
    Route::post('/servingType/servingType_restore', 'ServingTypeController@servingType_restore');

    Route::post('/delivery/delivery_update', 'ServingTypeController@delivery_update');
    Route::post('/delivery/delivery_restore', 'ServingTypeController@delivery_restore');
});

