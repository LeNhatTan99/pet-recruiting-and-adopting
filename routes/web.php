<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdoptionApplicationController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Admin\AnimalCasesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Web\AdoptionController;
use App\Http\Controllers\Web\AnimalController;
use App\Http\Controllers\Web\DonationController as WebDonationController;
use App\Http\Controllers\Web\NewsController as WebNewsController;
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
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    //Admin route manage animal case 
    Route::group(['prefix' => 'animal-cases'], function () {
        Route::get('/', [AnimalCasesController::class, 'index'])->name('animal.cases');
        Route::get('/create', [AnimalCasesController::class, 'create'])->name('create.animal-case');
        Route::post('/store', [AnimalCasesController::class, 'store'])->name('store.animal-case');
        Route::get('/edit/{id}', [AnimalCasesController::class, 'edit'])->name('edit.animal-case');
        Route::post('/update/{id}', [AnimalCasesController::class, 'update'])->name('update.animal-case');
        Route::post('/update-status/{id}', [AnimalCasesController::class, 'updateStatus'])->name('update-status.animal-case');
        Route::get('/show/{id}', [AnimalCasesController::class, 'show'])->name('show.animal-case');
    });
    //Admin route manage user 
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('admin.user');
        Route::get('/create', [AdminUserController::class, 'create'])->name('create.user');
        Route::post('/store', [AdminUserController::class, 'store'])->name('store.user');
        Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('edit.user');
        Route::post('/update/{id}', [AdminUserController::class, 'update'])->name('update.user');
        Route::post('/delete/{id}', [AdminUserController::class, 'delete'])->name('delete.user');
    });

    //Admin route manager adoption application
    Route::group(['prefix' => 'adoption-application'], function () {
        Route::get('/', [AdoptionApplicationController::class, 'index'])->name('admin.adoption-application');
        Route::get('/edit/{id}', [AdoptionApplicationController::class, 'edit'])->name('edit.adoption-application');
        Route::post('/update/{id}', [AdoptionApplicationController::class, 'update'])->name('update.adoption-application');
        Route::post('/delete/{id}', [AdoptionApplicationController::class, 'delete'])->name('delete.adoption-application');
    });
    //Admin route manager donation
    Route::group(['prefix' => 'donation'], function () {
        Route::get('/', [DonationController::class, 'index'])->name('admin.donation');
    });
    //Admin route manager news
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', [NewsController::class, 'index'])->name('admin.news');
        Route::get('/create', [NewsController::class, 'create'])->name('create.news');
        Route::post('/store', [NewsController::class, 'store'])->name('store.news');
        Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('edit.news');
        Route::post('/update/{id}', [NewsController::class, 'update'])->name('update.news');
        Route::post('/delete/{id}', [NewsController::class, 'delete'])->name('delete.news');
    });
});

//User route with user has login
Route::group(['prefix' => '/user', 'middleware' => 'auth'], function () {
    Route::get('profile', [UserController::class, 'showProfile'])->name('show.profile');
    Route::post('edit-profile/{username}', [UserController::class, 'editProfile'])->name('edit.profile');
    Route::post('adopt-animal/{username}', [AdoptionController::class, 'adopt'])->name('user.adopt');
    Route::post('donation', [WebDonationController::class, 'donate'])->name('user.donate');
    Route::get('create-donation', [WebDonationController::class, 'createDonate'])->name('user.create.donate');
    Route::post('news', [WebNewsController::class, 'create'])->name('user.create.news');
});

//Route for guest
Route::get('/', function () {
    return view('pages.home.index');
})->name('home');
Route::get('adoption-cases', [AnimalController::class, 'adoptionCases'])->name('adoptionCases');
Route::get('donation-cases', [AnimalController::class, 'adoptionCases'])->name('donationCases');
Route::get('news', [WebNewsController::class, 'index'])->name('news');