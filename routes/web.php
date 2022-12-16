<?php

use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('students')->middleware(['auth'])->group(function(){
    Route::get('/show',[StudentController::class,'show'])->name('students.show');
    Route::get('/student-list',[StudentController::class,'studentList']);
    Route::get('/search',[StudentController::class,'search']);
    Route::get('/add',[StudentController::class,'add']);
    Route::post('/add',[StudentController::class,'create']); 
    Route::get('/update',[StudentController::class,'showData']); 
    Route::get('/select',[StudentController::class,'studentByRollNo']);
    Route::patch('/edit',[StudentController::class,'edit']);
    Route::get('/delete',[StudentController::class,'delete'])->name('students.delete');
    Route::get('/destroy',[StudentController::class,'destroy']);     
   
});

Route::get("locale/{language}",[LocalizationController::class,'setLangauge']);



