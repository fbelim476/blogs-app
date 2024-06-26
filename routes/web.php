<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddBlogsController;
use App\Http\Controllers\DatatableController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// add blogs cruid operations

Route::get('/addblogs',[AddBlogsController::class,'index']);
Route::post('/addblogs',[AddBlogsController::class,'store']);
Route::get('/manageblogs',[AddBlogsController::class,'show']);
Route::get('/manageblogs/{id}',[AddBlogsController::class,'destroy']);
Route::get('/editblogs/{id}',[AddBlogsController::class,'edit']);
Route::post('/editblogs/{id}',[AddBlogsController::class,'update']);


// datatable

//  Route::resource('datatable','DatatableController');
 Route::get('/datatable',[DatatableController::class,'showAllData']);
 Route::post('/datatable',[DatatableController::class,'store']);
 Route::get('/datatable/create',[DatatableController::class,'show'])->name('allData');
 Route::post('/datatable/edit',[DatatableController::class,'edit'])->name('editData');
 Route::get('/datatable/delete/{id}',[DatatableController::class,'deleteData'])->name('deleteData');

