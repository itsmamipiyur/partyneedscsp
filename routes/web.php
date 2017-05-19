
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

Route::get('/home', 'UOMController@index');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/archive/uom', 'UOMController@showArchive');
    Route::get('/archive/equipmentType', 'EquipmentTypeController@showArchive');
    Route::get('/archive/dinnerwareType', 'DinnerwareTypeController@showArchive');
    Route::get('/archive/item', 'ItemController@showArchive');
    Route::get('/archive/dishType', 'DishTypeController@showArchive');
    Route::get('/archive/dish', 'DishController@showArchive');
    Route::get('/archive/menu', 'MenuController@showArchive');
    Route::get('/archive/cateringPackage', 'CateringPackageController@showArchive');
    Route::get('/archive/rentalPackage', 'RentalPackageController@showArchive');
    Route::get('/archive/eventType', 'EventTypeController@showArchive');
    Route::get('/archive/decor', 'DecorController@showArchive');
    Route::get('/archive/waiterRatio', 'WaiterRatioController@showArchive');
    Route::get('/archive/delivery', 'DeliveryController@showArchive');
    Route::get('/archive/penalty', 'PenaltyController@showArchive');

    Route::get('/menu/getRates/{id}', 'MenuController@getMenuRate');

    Route::resource('dishType', 'DishTypeController');
    Route::resource('penalty', 'PenaltyController');
    Route::resource('waiterRatio', 'WaiterRatioController');
    Route::resource('eventType', 'EventTypeController');
    Route::resource('manpower', 'ManpowerController');
    Route::resource('dish', 'DishController');
    Route::resource('menu', 'MenuController');
    Route::resource('uom', 'UOMController');
    Route::resource('equipmentType', 'EquipmentTypeController');
    Route::resource('dinnerwareType', 'DinnerwareTypeController');
    Route::resource('item', 'ItemController');
    Route::resource('decor', 'DecorController');
    Route::resource('delivery', 'DeliveryController');
    Route::resource('itemRate', 'ItemRateController');
    Route::resource('menuRate', 'MenuRateController');
    Route::resource('cateringPackage', 'CateringPackageController');
    Route::resource('rentalPackage', 'RentalPackageController');
    Route::resource('inventory', 'InventoryController', ['only' => ['index']]);
    Route::resource('eventBooking', 'EventBookingController', ['only' => ['index']]);
    Route::resource('rentalBooking', 'RentalBookingController', ['only' => ['index']]);
    Route::resource('rentalFill', 'RentalFillController');
    Route::resource('billingCollection', 'BillingCollection');
    Route::resource('inventoryRelease', 'InventoryReleaseController');
    Route::resource('query', 'QueryController');

    Route::get('/eventBooking/create/newCustomer', 'EventBookingController@createCustomer');
    Route::get('/eventBooking/create/existingCustomer', 'EventBookingController@existingCustomer');
    Route::get('/eventBooking/{id}', 'EventBookingController@viewEventDetail');
    Route::post('/eventBooking/create/newCustomer', 'EventBookingController@storeCustomer');
    Route::post('/eventBooking/create/existingCustomer', 'EventBookingController@storeEventDetails');

    Route::get('/orderFood', 'EventOrderController@orderFood');
    Route::post('/orderFood', 'EventOrderController@storeOrder');
    Route::post('/orderFood/addToTray', 'EventOrderController@addToTray');
    Route::post('/orderFood/destroyTray', 'EventOrderController@destroyTray');

    Route::get('/rentalBooking/create/newCustomer', 'RentalBookingController@createCustomer');
    Route::get('/rentalBooking/create/rentItem', 'RentalBookingController@rentItem');
    Route::get('/rentalBooking/create/rentalDetail', 'RentalBookingController@createRentalDetail');
    Route::post('/rentalBooking/process/quotation', 'RentalBookingController@processQuotation');
    Route::post('/rentalBooking/create/newCustomer', 'RentalBookingController@storeCustomer');
    Route::post('/rentalBooking/create/addToTray', 'RentalBookingController@addToTray');
    Route::post('/rentalBooking/create/addPackageToTray', 'RentalBookingController@addPackageToTray');

    Route::post('/inventory/addStock', 'InventoryController@addStock');
    Route::post('/inventory/releaseStock', 'InventoryController@releaseStock');

    Route::post('/menu/menu_update', 'MenuController@menu_update');
    Route::post('/menu/addMenuDish', 'MenuController@menu_addDish');
    Route::post('/menu/removeMenuDish', 'MenuController@menu_removeDish');
    Route::post('/menu/menu_restore', 'MenuController@menu_restore');
    Route::post('/menu/addMenuRate', 'MenuController@menu_addRate');
    Route::post('/menu/updateMenuRate', 'MenuController@menu_updateRate');
    Route::post('/menu/deleteMenuRate', 'MenuController@menu_removeRate');

    Route::post('/uom/uom_update', 'UOMController@uom_update');
    Route::post('/uom/uom_restore', 'UOMController@uom_restore');

    Route::post('/itemRate/itemRate_update', 'ItemRateController@itemRate_update');
    Route::post('/itemRate/itemRate_restore', 'ItemRateController@itemRate_restore');

    Route::post('/menuRate/menuRate_update', 'MenuRateController@menuRate_update');
    Route::post('/menuRate/menuRate_restore', 'MenuRateController@menuRate_restore');

    Route::post('/dish/dish_update', 'DishController@dish_update');
    Route::post('/dish/dish_restore', 'DishController@dish_restore');

    Route::post('/delivery/delivery_update', 'DeliveryController@delivery_update');
    Route::post('/delivery/delivery_restore', 'DeliveryController@delivery_restore');

    Route::post('/decor/decor_update', 'DecorController@decor_update');
    Route::post('/decor/decor_restore', 'DecorController@decor_restore');

    Route::post('/eventType/eventType_update', 'EventTypeController@eventType_update');
    Route::post('/eventType/eventType_restore', 'EventTypeController@eventType_restore');

    Route::post('/manpower/manpower_update', 'ManpowerController@manpower_update');
    Route::post('/manpower/manpower_restore', 'ManpowerController@manpower_restore');

    Route::post('/item/item_update', 'ItemController@item_update');
    Route::post('/item/item_restore', 'ItemController@item_restore');
    Route::post('/item/addItemRate', 'ItemController@item_addRate');
    Route::post('/item/updateItemRate', 'ItemController@item_updateRate');
    Route::post('/item/deleteItemRate', 'ItemController@item_deleteRate');
    Route::post('/item/addPenalty', 'ItemController@item_addPenalty');
    Route::post('/item/updatePenalty', 'ItemController@item_updatePenalty');
    Route::post('/item/deletePenalty', 'ItemController@item_deletePenalty');

    Route::post('/equipmentType/equipmentType_update', 'EquipmentTypeController@equipmentType_update');
    Route::post('/equipmentType/equipmentType_restore', 'EquipmentTypeController@equipmentType_restore');

    Route::post('/dinnerwareType/dinnerwareType_update', 'DinnerwareTypeController@dinnerwareType_update');
    Route::post('/dinnerwareType/dinnerwareType_restore', 'DinnerwareTypeController@dinnerwareType_restore');

    Route::post('/dishType/dishType_update', 'DishTypeController@dishType_update');
    Route::post('/dishType/dishType_restore', 'DishTypeController@dishType_restore');

    Route::post('/cateringPackage/cateringPackage_update', 'CateringPackageController@cateringPackage_update');
    Route::post('/cateringPackage/cateringPackage_restore', 'CateringPackageController@cateringPackage_restore');
    Route::post('/cateringPackage/addMenu', 'CateringPackageController@cateringPackage_addMenu');
    Route::post('/cateringPackage/addItem', 'CateringPackageController@cateringPackage_addItem');
    Route::post('/cateringPackage/removeMenu', 'CateringPackageController@cateringPackage_removeMenu');
    Route::post('/cateringPackage/removeItem', 'CateringPackageController@cateringPackage_removeItem');
    Route::post('/cateringPackage/updateItem', 'CateringPackageController@cateringPackage_updateItem');
    Route::post('/cateringPackage/updateMenu', 'CateringPackageController@cateringPackage_updateMenu');

    Route::post('/rentalPackage/rentalPackage_update', 'RentalPackageController@rentalPackage_update');
    Route::post('/rentalPackage/rentalPackage_restore', 'RentalPackageController@rentalPackage_restore');
    Route::post('/rentalPackage/addItem', 'RentalPackageController@rentalPackage_addItem');
    Route::post('/rentalPackage/removeItem', 'RentalPackageController@rentalPackage_removeItem');
    Route::post('/rentalPackage/updateItem', 'RentalPackageController@rentalPackage_updateItem');

    Route::post('/penalty/penalty_update', 'PenaltyController@penalty_update');
    Route::post('/penalty/penalty_restore', 'PenaltyController@penalty_restore');

    Route::post('/waiterRatio/waiterRatio_update', 'WaiterRatioController@waiterRatio_update');
    Route::post('/waiterRatio/waiterRatio_restore', 'WaiterRatioController@waiterRatio_restore');
});

