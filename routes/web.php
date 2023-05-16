<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

    /*--    group   --*/ 
    Route::get('group/index', [HomeController::class, 'groupIndex'])->name('group.index');

    Route::post('group/store', [HomeController::class, 'groupStore'])->name('group.store');

    Route::get('group/user/index/{group}', [HomeController::class, 'groupUserIndex'])->name('group.user.index');

    Route::post('group/user/shfit_to_other_group', [HomeController::class, 'shfitToOtherGroup'])->name('group.user.shfit_to_other_group');

    
   
    /*--    user   --*/ 
    Route::get('user/index', [HomeController::class, 'userIndex'])->name('user.index');

    Route::get('user/show/{user}', [HomeController::class, 'userShow'])->name('user.show');

    Route::post('user/search', [HomeController::class, 'userSearch'])->name('user.search');

    Route::post('user/store', [HomeController::class, 'userStore'])->name('user.store');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('task/show/{task}', [TaskController::class, 'show'])->name('task.show');

    Route::get('task/delete/{task}', [TaskController::class, 'delete'])->name('task.delete');

    Route::post('task/for_me/store', [TaskController::class, 'forMeStore'])->name('task.for_me.store');

    Route::post('task/for_my_team/store', [TaskController::class, 'forMyTeamStore'])->name('task.for_my_team.store');

    Route::get('user/task/index/{userId}', [TaskController::class, 'userTaskIndex'])->name('user.task.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
