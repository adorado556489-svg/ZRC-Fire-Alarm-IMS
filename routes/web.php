<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProjectMaterialController;
use App\Http\Controllers\EmpAgencyController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\QuotationController;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// All routes protected by Breeze auth middleware
Route::middleware(['auth', 'verified'])->group(function () {

    // Overrides Breeze's default empty dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('clients',           ClientController::class);
    Route::resource('quotations',        QuotationController::class);
    Route::resource('projects',          ProjectController::class);
    Route::resource('suppliers',         SupplierController::class);
    Route::resource('materials',         MaterialController::class);
    Route::resource('project-materials', ProjectMaterialController::class);
    Route::resource('billing',           BillingController::class);

    Route::resource('emp-agency', EmpAgencyController::class)->parameters([
        'emp-agency' => 'agency',
    ]);

    Route::post('quotations/{quotation}/create-project', [QuotationController::class, 'createProject'])
        ->name('quotations.create-project');
});

require __DIR__.'/auth.php';
