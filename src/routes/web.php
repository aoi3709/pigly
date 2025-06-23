<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\GoalSettingController;
use App\Http\Controllers\RegisterController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [WeightLogController::class, 'index'])->name('home');
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');

    Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');

    Route::get('/weight_logs/{weightLogId}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');

    Route::post('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'update'])->name('weight_logs.update');

    Route::delete('/weight_logs/{weightLogId}/delete', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');


    Route::get('/weight_logs/goal_setting', [GoalSettingController::class, 'showGoalSetting'])->name('weight_logs.goal_setting');

    Route::post('/weight_logs/goal_setting', [GoalSettingController::class, 'updateGoalSetting'])->name('weight_logs.goal_setting.update');

    Route::post('/logout', [CustomLoginController::class, 'destroy'])->name('logout');
});

Route::get('/register/step1', [RegisterController::class, 'showStep1Form'])->name('register.step1');

Route::post('/register/step1', [RegisterController::class, 'processStep1'])->name('register.processStep1');

Route::get('/register/step2', [RegisterController::class, 'showStep2Form'])->name('register.step2');

Route::post('/register/step2', [RegisterController::class, 'processStep2'])->name('register.processStep2');

Route::post('/login', [CustomLoginController::class, 'store'])
    ->middleware(['guest']) 
    ->name('login');