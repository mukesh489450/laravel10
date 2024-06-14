<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::get('/', [HomeController::class, 'dashboard']);
Route::get('/home', [HomeController::class, 'dashboard']);

Route::group(['middleware' => 'AdminAuthLoggIn','namespace' => 'App\Http\Controllers'],function (){
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/delete/{slug}', 'PermissionController@destroy')->name('permissions.delete');

    Route::resource('roles', RoleController::class);
    Route::get('roles/delete/{slug}', 'RoleController@destroy')->name('roles.delete');
    Route::get('roles/{roleId}/give-permissions',  'RoleController@addPermissionToRole')->name('roles.addPermissionToRole');
    Route::put('roles/{roleId}/give-permissions', 'RoleController@updatePermissionToRole')->name('roles.updatePermissionToRole');

    Route::resource('categories', CategoryController::class);
    Route::get('categories/change-status/{slug}', 'CategoryController@changeStatus')->name('categories.changeStatus');
    Route::get('categories/delete/{slug}', 'CategoryController@destroy')->name('categories.delete');

    Route::resource('products', ProductController::class);
    Route::get('products/change-status/{slug}', 'ProductController@changeStatus')->name('products.changeStatus');
    Route::get('products/delete/{slug}', 'ProductController@destroy')->name('products.delete');

});