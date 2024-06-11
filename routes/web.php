<?php

use App\Http\Controllers\EmployerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jobcontroller;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Models\Job;


Route::view('/home', 'home');
Route::view('/contact', 'contact');


Route::prefix('jobs')->controller(Jobcontroller::class)->group(function (){
    Route::get('/', 'index');
    Route::get('/create', 'create');
    Route::get('/{job}', 'show');
    
});

Route::post('/jobs', [Jobcontroller::class, 'store'])->middleware('auth')->name('jobpage');
Route::get('/jobs/{job}/edit', [Jobcontroller::class, 'edit'])
        ->middleware(['auth','self-change']);

Route::patch('/jobs/{job}',[Jobcontroller::class, 'update']);
Route::delete('/jobs/{job}',[Jobcontroller::class, 'destroy']);
Route::get('/myjob', [JobController::class, 'owner']);


//Authorize
Route::get('/register', [SessionController::class, 'createRegistration']);
 Route::post('/register', [SessionController::class, 'storeRegistration']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
Route::post('/reset', [SessionController::class, 'reset'])->name('password.update');