<?php

use App\Http\Controllers\EmployeeManagementController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TeamManagementController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'management'], function () {
    Route::get("/login", [LoginController::class, 'login'])->name('login');
    Route::post("/login", [LoginController::class, 'loginPost'])->name("login.post");
    Route::get("/logout", [LoginController::class, 'logout'])->name("logout");
    Route::get("/home", [LoginController::class, 'home'])->name('home');
    Route::group(['prefix' => 'team'], function () {
        Route::get("/search/{name?}", [TeamManagementController::class, 'search'])->name('team.search');
        Route::get("/edit/{id}", [TeamManagementController::class, 'edit'])->name('team.edit');
        Route::post("/edit_confirm", [TeamManagementController::class, 'editConfirm'])->name('team.edit_confirm');
        Route::get("/add", [TeamManagementController::class, 'create'])->name('team.add');
        Route::post("/add_confirm", [TeamManagementController::class, 'createConfirm'])->name('team.add_confirm');
        Route::get("/delete/{id}", [TeamManagementController::class, 'delete'])->name('team.delete');
    });
    Route::group(['prefix' => 'employee'], function () {
        Route::get("/search/{team?}/{name?}/{email?}", [EmployeeManagementController::class, 'search'])->name('employee.search');
        Route::get("/add", [EmployeeManagementController::class, 'create'])->name('employee.create');
        Route::post("/add_confirm", [EmployeeManagementController::class, 'createConfirm'])->name('employee.create_confirm');
        Route::get("edit/{id}", [EmployeeManagementController::class, 'edit'])->name('employee.edit');
        Route::post("edit_confirm", [EmployeeManagementController::class, 'editconfirm'])->name('employee.edit_confirm');
        Route::get("back/{id}", [EmployeeManagementController::class, 'back'])->name('employee.back');
        Route::get("/delete/{id}", [EmployeeManagementController::class, 'delete'])->name('employee.delete');
    });
});
