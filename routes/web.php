<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminpermissionController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NhanvienController;
use App\Http\Controllers\PhongBanController;
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
    return redirect()->route('login');
});



Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/login', [AdminController::class, 'checkLogin'])->name('checkLogin');
Route::get('/register', [AdminController::class, 'register'])->name('register');
Route::post('/register', [AdminController::class, 'registerStore'])->name('registerStore');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/storage/nhanvien/{file}', [FileController::class, 'images'])->middleware('auth');

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('home');
    })->name('home');
    //ROUTE NHAN VIEN
    Route::get('/nhanvien', [NhanvienController::class, 'index'])->name('nhanvien.index')->middleware('can:employee-list');
    Route::get('/nhanvien/all', [NhanvienController::class, 'allData']);
    Route::post('/nhanvien/store', [NhanvienController::class, 'store'])->middleware('can:employee-add');
    Route::post('/nhanvien/edit', [NhanvienController::class, 'edit'])->middleware('can:employee-edit');
    Route::post('/nhanvien/update', [NhanvienController::class, 'update']);
    Route::post('/nhanvien/delete', [NhanvienController::class, 'delete'])->middleware('can:employee-delete');

    //ROUTE PHONG BAN
    Route::get('/phongban', [PhongBanController::class, 'index'])->name('phongban.index')->middleware('can:department-list');
    Route::get('/phongban/all', [PhongBanController::class, 'allData']);
    Route::post('/phongban/store', [PhongBanController::class, 'store'])->middleware('can:department-add');
    Route::post('/phongban/edit', [PhongBanController::class, 'edit'])->middleware('can:department-edit');
    Route::post('/phongban/update', [PhongBanController::class, 'update']);
    Route::post('/phongban/delete', [PhongBanController::class, 'delete'])->middleware('can:department-delete');

    //ROUTE DEGREE
    Route::get('/degree', [DegreeController::class, 'index'])->name('degree.index')->middleware('can:degree-list');
    Route::get('/degree/all', [DegreeController::class, 'allData']);
    Route::post('/degree/store', [DegreeController::class, 'store'])->middleware('can:degree-add');
    Route::post('/degree/edit', [DegreeController::class, 'edit'])->middleware('can:degree-edit');
    Route::post('/degree/update', [DegreeController::class, 'update']);
    Route::post('/degree/delete', [DegreeController::class, 'delete'])->middleware('can:degree-delete');

    //ROUTE USERS
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index')->middleware('can:user-list');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create')->middleware('can:user-add');
    Route::post('/users/store', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [AdminUserController::class, 'edit'])->name('users.edit')->middleware('can:user-edit');
    Route::post('/users/update/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::get('/users/delete/{id}', [AdminUserController::class, 'delete'])->name('users.delete')->middleware('can:user-delete');


    //ROUTE roles
    Route::get('/roles', [AdminRoleController::class, 'index'])->name('roles.index')->middleware('can:role-list');
    Route::get('/roles/create', [AdminRoleController::class, 'create'])->name('roles.create')->middleware('can:role-add');
    Route::post('/roles/store', [AdminRoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [AdminRoleController::class, 'edit'])->name('roles.edit')->middleware('can:role-edit');
    Route::post('/roles/update/{id}', [AdminRoleController::class, 'update'])->name('roles.update');
    Route::get('/roles/delete/{id}', [AdminRoleController::class, 'delete'])->name('roles.delete')->middleware('can:role-delete');

    //ROUTE permissions
    Route::get('/permissions/create', [AdminpermissionController::class, 'create'])->name('permissions.create')->middleware('can:is_admin');
    Route::post('/permissions/store', [AdminpermissionController::class, 'store'])->name('permissions.store')->middleware('can:is_admin');
});
