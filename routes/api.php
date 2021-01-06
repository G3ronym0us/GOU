<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getModelCars', function(Request $request){
    $model_cars = DB::table('model_cars')
    ->join('brands', 'brands.id', '=', 'model_cars.brand_id')
    ->select('model_cars.*', 'brands.name as brand')
    ->orderBy('id', 'DESC')
    ->paginate(10);
    return [
        'pagination' => [
            'total'         => $model_cars->total(),
            'current_page'  => $model_cars->currentPage(),
            'per_page'      => $model_cars->perPage(),
            'last_page'     => $model_cars->lastPage(),
            'from'          => $model_cars->firstItem(),
            'to'            => $model_cars->lastItem(),
        ],
        'model_cars' => $model_cars
    ];;
});

Route::get('getCars', function(Request $request){
    $cars = DB::table('cars')
    ->join('users', 'users.id', '=', 'cars.user_id')
    ->join('model_cars', 'model_cars.id', '=', 'cars.model_id')
    ->join('brands', 'brands.id', '=', 'model_cars.brand_id')
    ->select('cars.*', 'brands.name as brand', 'model_cars.model_car as model','users.name as user','users.id as user_id','brands.id as brand_id','model_cars.id as model_id')
    ->orderBy('id', 'DESC')
    ->paginate(10);
    return [
        'pagination' => [
            'total'         => $cars->total(),
            'current_page'  => $cars->currentPage(),
            'per_page'      => $cars->perPage(),
            'last_page'     => $cars->lastPage(),
            'from'          => $cars->firstItem(),
            'to'            => $cars->lastItem(),
        ],
        'cars' => $cars
    ];;
});

Route::get('getBrands', function(){
    $brands = App\Models\Brand::get();
    return $brands;
});

Route::get('getUsers', function(){
    $users = App\Models\User::get();
    return $users;
});

Route::get('getCarModels/{id}', function($id){
    $brands = App\Models\ModelCar::get()->where('brand_id','=',$id);
    return $brands;
});
