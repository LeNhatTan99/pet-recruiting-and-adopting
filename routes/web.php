<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AnimalCasesController;
use App\Http\Controllers\Web\AnimalController;
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
    return view('pages.home.index');
})->name('home');

//Auth route
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('post.login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postRegister'])->name('post.register');
Route::group(['middleware' => ['auth']], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

//Admin route
Route::get('/admin/login', [AdminAuthController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'postAdminLogin'])->name('post.admin.login');
Route::group(['prefix' => '/admin', 'middleware' => 'admin'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/animal-cases', [AnimalCasesController::class,'index'])->name('animal.cases');
});

Route::group(['prefix' => '/user'], function () {
    Route::get('profile', [UserController::class, 'showProfile'])->name('show.profile');
    Route::post('edit-profile/{username}', [UserController::class, 'editProfile'])->name('edit.profile');
});
Route::get('adoption-cases', [AnimalController::class, 'adoptionCases'])->name('gallery');