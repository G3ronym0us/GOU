<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ModelCarController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DocumentationController as DocumentationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\settingPriceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BalanceDriverController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\VirtualWalletDriverController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PushNotificationController;
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

Route::get('/', [DriverController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('cars', CarController::class);
Route::resource('model_cars', ModelCarController::class);
Route::resource('documentation', DocumentationController::class);
Route::resource('driver', DriverController::class);
Route::resource('client', ClientController::class);
Route::resource('user', UserController::class);
Route::resource('price', PriceController::class);
Route::resource('setting_price', SettingPriceController::class);
Route::resource('balance_driver', BalanceDriverController::class);
Route::resource('payment_methods', PaymentMethodController::class);
Route::resource('virtual_wallet', VirtualWalletDriverController::class);
Route::resource('notification', NotificationController::class);
Route::resource('push_notification', PushNotificationController::class);


Route::post('updateDocumentation', [DocumentationController::class, 'update']);

Route::get('getDrivers', function(Request $request){
    $drivers = DB::table('drivers')
    ->join('users', 'users.id', '=', 'drivers.user_id')
    ->select('drivers.*','users.*')
    ->where('users.active','=',1)
    ->orderBy('drivers.id', 'DESC')
    ->paginate(10);
    return [
        'pagination' => [
            'total'         => $drivers->total(),
            'current_page'  => $drivers->currentPage(),
            'per_page'      => $drivers->perPage(),
            'last_page'     => $drivers->lastPage(),
            'from'          => $drivers->firstItem(),
            'to'            => $drivers->lastItem(),
        ],
        'drivers' => $drivers
    ];;
});

Route::get('getDocumentation/{id}', function($id){
    $documentation = App\Models\Documentation::where('user_id','=',$id)->first();
    return $documentation;
});

Route::get('getSettingPrice', function(){
    $setting_price = App\Models\SettingPrice::first();
    return $setting_price;
});

Route::get('getPrice', function(){
    $price = App\Models\Price::all();
    return $price;
});

Route::get('checkCar/{id}', function($id){
    $price = App\Models\Car::where('user_id','=',$id)->first();
    return $price;
});

Route::get('getBrandFromModel/{id}', function($id){
    $price = App\Models\ModelCar::where('id','=',$id)->first();
    return $price;
});

Route::post('checkPasswordUser', [UserController::class, 'checkPasswordUser']);
Route::post('approveDocumentation/{id}', [DocumentationController::class, 'approveDocument']);

require __DIR__.'/auth.php';
