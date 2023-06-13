<?php

use App\Http\Controllers\api\TaskController;
use App\Http\Controllers\api\TaskSubtaskController;
use App\Http\Controllers\api\DayController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\SuperAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('user/login', [AuthController::class, 'login']);


/*--   auth   --*/
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('user/password/update', [AuthController::class, 'passwordUpdate']);
});

/*--   users   --*/
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('user', [UserController::class, 'show']);

    Route::get('user/index', [HomeController::class, 'userIndex']);

    Route::post('user/search', [HomeController::class, 'userSearch']);

    Route::get('user/late/tasks', [HomeController::class, 'lateTasks']);

    Route::get('user/today/tasks', [HomeController::class, 'todayTasks']);

    Route::get('user/today/subtasks', [HomeController::class, 'todaySubtasks']);

    Route::get('user/day/index/{user}', [TaskController::class, 'userDayIndex']);

    Route::get('user/day/show/{user}/{day}', [TaskController::class, 'userDayShow']);

});

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

   Route::get('task/{task}/show', [TaskController::class, 'show']); 

    Route::post('task/for_me/store', [TaskController::class, 'forMeStore']);

    Route::put('task/for_me/update/{task}', [TaskController::class, 'forMeUpdate']);

    Route::delete('task/for_me/delete/{task}', [TaskController::class, 'forMeDelete']);

    Route::post('task/for_my_team/store', [TaskController::class, 'forMyTeamStore']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('task/subtask/store', [TaskSubtaskController::class, 'store']);
});

/*--   admin - super_admin   --*/
Route::group(['middleware' => 'auth:sanctum'], function () {

    // Route::get('user/today/tasks', [TaskController::class, 'todayTasks']);
    Route::get('super_admin/user/orderby_task_count', [SuperAdminController::class, 'orderbyTaskCount']);

});


