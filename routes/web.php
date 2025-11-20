<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\GoalController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // ✅ 目標体重設定画面と更新処理を保護
    Route::get('/weight_logs/goal_setting', [GoalController::class, 'index'])->name('goal.setting');
    Route::post('/weight_logs/goal_setting', [GoalController::class, 'update'])->name('goal.update');

    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
    Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');
    Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');
    Route::get('/weight_logs/{weightLog}', [WeightLogController::class, 'show'])->name('weight_logs.show');
    Route::post('/weight_logs/{weightLog}/update', [WeightLogController::class, 'update'])->name('weight_logs.update');
    Route::delete('/weight_logs/{weightLog}/delete', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/register/step1', [RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'submitStep1'])->name('register.step1.submit');
Route::get('/register/step2', [RegisterController::class, 'showStep2'])->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'submitStep2'])->name('register.step2.submit');

Route::get('/home', function () {
    return redirect('/weight_logs');
});
