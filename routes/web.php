
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
    Route::resource('eventType', 'EventTypeController');
    Route::resource('dish', 'DishController');
    Route::resource('menu', 'MenuController');
    Route::resource('uom', 'UOMController');
    Route::resource('equipmentType', 'EquipmentTypeController');
    Route::resource('dinnerwareType', 'DinnerwareTypeController');
    Route::resource('item', 'ItemController');
    Route::resource('decor', 'DecorController');
    Route::resource('delivery', 'DeliveryController');

    Route::post('/menu/menu_update', 'MenuController@menu_update');
    Route::post('/menu/addMenuDish', 'MenuController@menu_addDish');
    Route::post('/menu/removeMenuDish', 'MenuController@menu_removeDish');
    Route::post('/menu/menu_restore', 'MenuController@menu_restore');

    Route::post('/uom/uom_update', 'UOMController@uom_update');
    Route::post('/uom/uom_restore', 'UOMController@uom_restore');

    Route::post('/dish/dish_update', 'DishController@dish_update');
    Route::post('/dish/dish_restore', 'DishController@dish_restore');

    Route::post('/delivery/delivery_update', 'DeliveryController@delivery_update');
    Route::post('/delivery/delivery_restore', 'DeliveryController@delivery_restore');

    Route::post('/decor/decor_update', 'DecorController@decor_update');
    Route::post('/decor/decor_restore', 'DecorController@decor_restore');

    Route::post('/eventType/eventType_update', 'EventTypeController@eventType_update');
    Route::post('/eventType/eventType_restore', 'EventTypeController@eventType_restore');

    Route::post('/item/item_update', 'ItemController@item_update');
    Route::post('/item/item_restore', 'ItemController@item_restore');

    Route::post('/equipmentType/equipmentType_update', 'EquipmentTypeController@equipmentType_update');
    Route::post('/equipmentType/equipmentType_restore', 'EquipmentTypeController@equipmentType_restore');

    Route::post('/dinnerwareType/dinnerwareType_update', 'DinnerwareTypeController@dinnerwareType_update');
    Route::post('/dinnerwareType/dinnerwareType_restore', 'DinnerwareTypeController@dinnerwareType_restore');

    Route::post('/dishType/dishType_update', 'DishTypeController@dishType_update');
    Route::post('/dishType/dishType_restore', 'DishTypeController@dishType_restore');

    Route::post('/penalty/penalty_update', 'PenaltyController@penalty_update');
    Route::post('/penalty/penalty_restore', 'PenaltyController@penalty_restore');

    Route::post('/waiterRatio/waiterRatio_update', 'WaiterRatioController@waiterRatio_update');
    Route::post('/waiterRatio/waiterRatio_restore', 'WaiterRatioController@waiterRatio_restore');
});

