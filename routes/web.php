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
    Route::get('/view',[StudentController::class,'viewStudents'])->name('students.view');
    Route::get('/student-list',[StudentController::class,'studentList']);   
    Route::get('/add',[StudentController::class,'add']);
    Route::post('/add',[StudentController::class,'createNewStudent']); 
    Route::get('/update',[StudentController::class,'showStudentRollNo']); 
    Route::get('/select',[StudentController::class,'studentByRollNo']);
    Route::patch('/edit',[StudentController::class,'editStudent']);
    Route::get('/delete',[StudentController::class,'viewStudentToDelete'])->name('students.delete');
    Route::get('/destroy',[StudentController::class,'destroyStudent']);     
   
});

Route::get("locale/{language}",[LocalizationController::class,'setLangauge']);



