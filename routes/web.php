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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('students')->middleware(['auth'])->group(function(){
    Route::get('/view',[StudentController::class,'viewStudents']);
    Route::get('/student-list',[StudentController::class,'getStudentListByDate']);   
    Route::get('/add',[StudentController::class,'uploadAddForm']);
    Route::post('/add',[StudentController::class,'createNewStudent']); 
    Route::get('/update',[StudentController::class,'uploadUpdateForm']); 
    Route::get('/select/roll_no',[StudentController::class,'rollNoByYear']);
    Route::get('/select/student_info',[StudentController::class,'getstudentByRollNo']);
    Route::patch('/edit',[StudentController::class,'editStudent']);
    Route::get('/delete',[StudentController::class,'getStudentListToDelete']);
    Route::get('/destroy',[StudentController::class,'destroyStudent']);   
   
});

Route::get("locale/{language}",[LocalizationController::class,'setLangauge']);

Route::get('/server-error', function () {return view('dberror');})->name('server-error');

