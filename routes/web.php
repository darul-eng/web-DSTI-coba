<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategoryController,
    PeopleController,
    DashboardController,
    AuthController,
};
use App\Http\Middleware\cekRole;
// use App\Http\Controllers\PeopleController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


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

// Route::get('/', function () {
//     return view('welcome');
// });

/* 
| Dibawah ini adalah contoh Route
|
|
| Bagian pertama adalah grupping menggunakan middleware. Hal tersbut 
| berfungsi agar url / dam /logout itu hanya bisa di akses oleh 
| orang yang pernah login baik itu admin maupun superadmin
|
| Bagian kedua itu adalah grupping menggunakan middleware + autorization 
| menggunakan auth dan cekrole. cek role ini di gunakan untuk mengecek 
| apakah yang login itu adalah superadmin...jika ya maka Route 
| didalam grupping tersebut dapatdi akses. jadi Untuk Route 
| tersebut hanya  dapat di akses oleh superadmim saja.
|
| Kemudian yang ketiga adalah beberapa contoh penamaan menggunakan 
| ->name('namanya') lalu ada juga bagian middleware yang bisa 
| di tambahkan di akhir Route untuk membatasi Route 
| tersebut bisa di akses oleh siapa saja, jika 
| menggunakan ->middleware('guest') maka 
| Route tersebut hanya dapat di akses 
| oleh user yang tidak login. 
| ->middleware('auth') 
| berarti Route 
| tersebut 
| hanya 
| dapat di akses oleh user yang telah ter-authenticate atau login.



*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index']);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['auth', 'cekrole:superadmin']], function () {

    // Super Admin
    Route::group(['prefix' => 'people'], function () {
        Route::get('/create', [PeopleController::class, 'create']);
        Route::post('/store', [PeopleController::class, 'store']);
    });

    Route::get('people', [PeopleController::class, 'index']);
    // Route::get('people/create', [PeopleController::class, 'create']);
    // Route::post('people/store', [PeopleController::class, 'store']);
    Route::get('people/{people}', [PeopleController::class, 'show']);
    Route::get('people/edit/{people}', [PeopleController::class, 'edit']);
    Route::patch('people/{people}', [PeopleController::class, 'update']);
    Route::get('people/destroy/{people}', [PeopleController::class, 'destroy']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category:slug}', function (Category $category) {
        return view('pages.category', [
            'title' => $category->name,
            'peoples' => $category->peoples,
            'category' => $category->name
        ]);
    });
});

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');


// Route::group(['middleware' => ['guest']], function () {
//     Route::get('/login', [AuthController::class, 'index'])->name('login');
//     Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
// });
