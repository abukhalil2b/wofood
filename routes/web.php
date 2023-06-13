<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\TaskSubtaskController;
use App\Http\Controllers\TaskAttachmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

    /*--    user   --*/
    Route::get('user/index', [HomeController::class, 'userIndex'])->name('user.index');

    Route::post('user/search', [HomeController::class, 'userSearch'])->name('user.search');

/*--    user - today --*/
    Route::get('user/late/tasks', [HomeController::class, 'lateTasks'])->name('user.late.tasks');

    Route::get('user/today/tasks', [HomeController::class, 'todayTasks'])->name('user.today.tasks');

    Route::get('user/today/subtasks', [HomeController::class, 'todaySubtasks'])->name('user.today.subtasks');

    Route::get('user/today/attachments', [HomeController::class, 'todayAttachments'])->name('user.today.attachments');
});


/*--    super_admin   --*/
Route::group(['middleware' => ['auth', 'super_admin']], function () {

     /*--    tasks   --*/
     Route::get('super_admin/user/orderby_task_count', [SuperAdminController::class, 'orderbyTaskCount'])->name('super_admin.user.orderby_task_count');

     /*--    day   --*/
    Route::get('super_admin/day/show/{day}', [SuperAdminController::class, 'dayShow'])->name('super_admin.day.show');

    Route::post('super_admin/day/update/{day}', [SuperAdminController::class, 'dayUpdate'])->name('super_admin.day.update');

    Route::get('super_admin/day/index', [SuperAdminController::class, 'dayIndex'])->name('super_admin.day.index');

    Route::post('super_admin/day/store', [SuperAdminController::class, 'dayStore'])->name('super_admin.day.store');

    /*--    group   --*/
    Route::get('super_admin/group/index', [SuperAdminController::class, 'groupIndex'])
        ->middleware('super_admin')
        ->name('super_admin.group.index');

    Route::post('super_admin/group/store', [SuperAdminController::class, 'groupStore'])
        ->middleware('super_admin')
        ->name('super_admin.group.store');

        Route::post('super_admin/group/update_status', [SuperAdminController::class, 'groupUpdateStatus'])
        ->middleware('super_admin')
        ->name('super_admin.group.update_status');

        
    Route::get('super_admin/group/user/index/{group}', [SuperAdminController::class, 'groupUserIndex'])
        ->middleware('super_admin')
        ->name('super_admin.group.user.index');

    Route::post('super_admin/group/user/store', [SuperAdminController::class, 'groupUserStore'])->name('super_admin.group.user.store');

    Route::get('super_admin/group/user/show/{user}', [SuperAdminController::class, 'groupUserShow'])->name('super_admin.group.user.show');

    Route::post('super_admin/group/user/update/{user}', [SuperAdminController::class, 'groupUserUpdate'])->name('super_admin.group.user.update');

    Route::post('super_admin/group/user/password/update/{user}', [SuperAdminController::class, 'groupUserPasswordUpdate'])->name('super_admin.group.user.password.update');

    Route::post('super_admin/group/user/shfit_to_other_group', [SuperAdminController::class, 'shfitToOtherGroup'])
        ->middleware('super_admin')
        ->name('super_admin.group.user.shfit_to_other_group');
});

/*--   day   --*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('day/index', [DayController::class, 'index'])->name('day.index');

    Route::get('day/show/{day}', [DayController::class, 'show'])->name('day.show');
});


/*--   task   --*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('task/show/{task}', [TaskController::class, 'show'])->name('task.show');

    Route::get('task/edit/{task}/{day}', [TaskController::class, 'edit'])->name('task.edit');

    Route::post('task/update/{task}', [TaskController::class, 'update'])->name('task.update');

    Route::get('task/delete/{task}/{day}', [TaskController::class, 'delete'])->name('task.delete');

    Route::post('task/for_me/store', [TaskController::class, 'forMeStore'])->name('task.for_me.store');

    Route::post('task/for_my_team/store', [TaskController::class, 'forMyTeamStore'])->name('task.for_my_team.store');

    Route::get('user/day/index/{user}', [TaskController::class, 'userDayIndex'])->name('user.day.index');

    Route::get('user/day/show/{user}/{day}', [TaskController::class, 'userDayShow'])->name('user.day.show');
});

/*--   subtask   --*/
Route::group(['middleware' => 'auth'], function () {
    Route::post('task/subtask/store', [TaskSubtaskController::class, 'store'])->name('task.subtask.store');
    Route::get('task/subtask/index/{task}', [TaskSubtaskController::class, 'index'])->name('task.subtask.index');
    Route::get('task/subtask/delete/{subtask}', [TaskSubtaskController::class, 'delete'])->name('task.subtask.delete');
});


/*--   attachment   --*/
Route::group(['middleware' => 'auth'], function () {
    Route::post('task/attachment/store', [TaskAttachmentController::class, 'store'])->name('task.attachment.store');
    Route::get('task/attachment/delete/{attachment}', [TaskAttachmentController::class, 'delete'])->name('task.attachment.delete');
});


/*--   profile   --*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
