<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboardadmin', [AdminController::class, 'index'])->name('dashboardadmin');
    Route::get('/approval', [AdminController::class, 'indexadminapproval'])->name('adminapproval');
    Route::get('/viewstaffs', [AdminController::class, 'viewstaffs'])->name('viewstaffs');
    /*    Route::get('/viewstaffs', [AdminController::class, 'viewstaffs'])->name('viewstaffs'); */
});
