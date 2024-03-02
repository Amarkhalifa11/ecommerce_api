<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

Route::controller(BrandController::class)->group(function(){

    Route::get('brand/all_brand'           , 'all_brand');
    Route::get('brand/show_brand/{id}'     , 'show');
    Route::post('brand/store_brand'        , 'store');
    Route::post('brand/update_brand/{id}'  , 'update');
    Route::get('brand/destroy_brand/{id}'  , 'destroy');
    
});

Route::controller(CategoryController::class)->group(function(){

    Route::get('category/all_category'           , 'all_category');
    Route::get('category/show_category/{id}'     , 'show');
    Route::post('category/store_category'        , 'store');
    Route::post('category/update_category/{id}'  , 'update');
    Route::get('category/destroy_category/{id}'  , 'destroy');
    
});