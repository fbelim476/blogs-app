<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;
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
// register & login middleware

Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});

// add product api routing in api.php in routes
// Route::get('/',[ProductController::class,'index']);
// Route::get('show',[ProductController::class,'show']);
// Route::post('products',[ProductController::class,'store']);
// Route::get('delete/{id}',[ProductController::class,'destroy']);
// Route::get('edit/{id}',[ProductController::class,'edit']);
// Route::post('edit/{id}',[ProductController::class,'update']);
// add register api register and login api
// Route::get('/',[RegisterController::class,'index']);
// Route::get('usershow',[RegisterController::class,'show']);
// Route::post('register',[RegisterController::class,'store']);
// Route::post('login',[RegisterController::class,'login']);
// Route::get('userdelete/{id}',[RegisterController::class,'destroy']);
// Route::get('useredit/{id}',[RegisterController::class,'edit']);
// Route::post('useredit/{id}',[RegisterController::class,'update']);


