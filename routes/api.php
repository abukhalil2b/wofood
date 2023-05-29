<?php

use App\Http\Controllers\api\TaskController;
use App\Http\Controllers\api\DayController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('user/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->put('user/password/update', [AuthController::class, 'passwordUpdate']);

Route::middleware('auth:sanctum')->get('dashboard', [HomeController::class, 'dashboard']);

/*--   day   --*/
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('day/index', [DayController::class, 'index']);

    Route::get('day/show/{day}', [DayController::class, 'show']);
});

/*--   day   --*/
/*
title - group_id -assign_for_id - day_id - start_at - end_at
*/
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('task/for_me/store', [TaskController::class, 'forMeStore']);

    Route::put('task/for_me/update/{task}', [TaskController::class, 'forMeUpdate']);

    Route::delete('task/for_me/delete/{task}', [TaskController::class, 'forMeDelete']);

    Route::post('task/for_my_team/store', [TaskController::class, 'forMyTeamStore']);
});


/*--   admin - super_admin   --*/
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('user/today/tasks', [TaskController::class, 'todayTasks']);

});


