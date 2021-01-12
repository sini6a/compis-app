<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/modify', 'EditProfileController@edit')->name('edit');

Route::resource('user', 'EditProfileController')->only([
    'edit', 'update'
]);

Route::resource('computer', 'ComputerController')->only([
    'index', 'show', 'update'
]);

Route::resource('service', 'ServiceController')->only([
    'index', 'show'
]);


Route::resource('admin', 'Admin\AdminController')->only([
    'index',
]);
Route::resource('admin/computer', 'Admin\ComputerController', [
    'as' => 'admin'
])->only([
    'index', 'show', 'update', 'store'
]);
Route::get('admin/computer/create/{user}', 'Admin\ComputerController@create')->name('admin.computer.create');
Route::resource('admin/user', 'Admin\UserController', [
    'as' => 'admin'
])->only([
    'show', 'update', 'edit', 'create', 'store', 'five', 'twenty'
]);
Route::patch('admin/user/{user}/{discount}', 'Admin\UserController@discount')->name('admin.user.discount');
Route::resource('admin/part', 'Admin\PartController', [
    'as' => 'admin'
])->only([
    'store', 'destroy'
]);
Route::get('admin/part/create/{service}', 'Admin\PartController@create')->name('admin.part.create');

Route::get('admin/service/create/{computer}', 'Admin\ServiceController@create')->name('admin.service.create');
Route::resource('admin/service', 'Admin\ServiceController', [
    'as' => 'admin'
])->only([
    'store', 'show', 'destroy'
]);