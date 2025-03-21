<?php

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
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Middleware\CheckAge;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\PengalamanKerjaController;
use App\Http\Controllers\backend\PendidikanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CobaController;




Route::get('/', function () {
    return view('welcome');
});

Route::view('/welcome', 'welcome');
Route::view('/welcome', 'welcome', ['name' => 'Taylor']);


// Acara 3
// Route::get('/index', function () {
//     return view('welcome');
// });
// Route::get('/user', [UserController::class, 'index']);

// Route::any('/', function () {
//     return 'ini any';
// });

// Route::redirect('/here', '/there', 301);
// Route::view('/welcome2', 'welcome');
// Route::view('/welcome3', 'welcome')->name('Taylor');

// Route::get('user/acara3/{name?}', function ($name = "John") {
//     return $name;
// })->where('name', '[A-Za-z]+');

// Route::get('user/{id}', function ($id) {
//     return $id;
// })->where('id', '[0-9]+');

// Route::get('user/{id}/{name}', function ($id, $name) {
//     return "User ID: $id, Username: $name";
// })->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

// Route::get('search/{search}', function ($search) {
//     return $search;
// })->where('search', '.*');

// // Acara 4
// Route::get('/user/{id}/profile', function ($id) {
//     return "Profil user dengan ID $id";
// })->name('profile');

// Route::get('/generate-url', function () {
//     $url = route('profile', ['id' => 5]);
//     return "URL ke profile: $url";
// });

// Route::get('/redirect-profile', function () {
//     return redirect()->route('profile', ['id' => 5]);
// });

// Route::middleware(['first', 'second'])->group(function () {
//     Route::get('/first', function () {});
//     Route::get('/user/profile', function () {});
// });

// Route::domain('{account}.myapp.com')->group(function () {
//     Route::get('user/{id}', function ($account, $id) {
//         return "Akun: $account, ID: $id";
//     });
// });

// Route::prefix('admin')->group(function () {
//     Route::get('users', function () {});
// });

// Route::name('admin.')->group(function () {
//     Route::get('users', function () {})->name('users');
// });


// //Acara 5
Route::get('user', [ManagementUserController::class, 'index']);
Route::get('user/create', [ManagementUserController::class, 'create']);
Route::post('user', [ManagementUserController::class, 'store']);
Route::get('user/{id}', [ManagementUserController::class, 'show']);
Route::get('user/{id}/edit', [ManagementUserController::class, 'edit']);
Route::put('user/{id}', [ManagementUserController::class, 'update']);
Route::delete('user/{id}', [ManagementUserController::class, 'destroy']);

// //Acara 6
Route::get("/home", function(){
    return view("home");
});
Route::get('/home', [ManagementUserController::class, 'index']);

//Acara 7
Route::group(['namespace'=> 'Frontend'], function () {
    Route::resource('home', 'HomeController');
});

//Acara 8
Route::group(['namespace' => 'backend'], function () 
{
    Route::resource('dashboard', 'DashboardController');
});

// Route::get('/dashboard', [DashboardController::class, 'index']);

// Route::controller('backend/DashboardController')->group(function () {
//     Route::get('/dashboard', 'index');
//     // Route::post('/orders', 'store');
// });

Route::get('/session/create','SessionController@create');
Route::get('/session/show','SessionController@show');

// Route::get('/dashboard','');


//Acara 11
// Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//Acara 12
Route::get('admin/profile', function() {
    //
})->middleware('auth');

Route::get('admin/profile', function() {
    //
})->middleware(CheckAge::class);

Route::get('/', function() {
    //
})->middleware('auth');
Route::get('/', function() {
    //
})->middleware('web');
Route::group(['middleware'=> ['web']], function() {
    //
});
Route::middleware(['web', 'subscribed'])->group(function() {
    //
});
Route::put('post/{id}', function ($id) {
    //
})->middleware('role:editor');

//Acara 13 dan 14
Route::group(['namespace' => 'backend'], function()
    {
        Route::resource('dashboard','DashboardController');
        Route::resource('pendidikan','PendidikanController');
        Route::resource('pengalaman_kerja','backend\PengalamanKerjaController');

    });

//Acara 15 dan 16
Route::group(['namespace' => 'backend'], function()
    {
        Route::resource('dashboard','DashboardController');
        Route::resource('pendidikan','PendidikanController');
    });

//Acara 17
Route::get('/session/create', [SessionController::class, 'create']);
Route::get('/session/show', [SessionController::class, 'show']);
Route::get('/session/delete', [SessionController::class, 'delete']);

//Acara 18
Route::get('/pegawai/{nama}', [PegawaiController::class, 'index']);

Route::get('/formulir', [PegawaiController::class, 'formulir']);
Route::post('/formulir/proses', [PegawaiController::class, 'proses']);
Route::get('/cobaerror/{nama?}', [CobaController::class, 'index']);

    //Acara 19
Route::get('/upload', [UploadController::class, 'upload'])->name('upload');

Route::post('/upload/proses', [UploadController::class, 'proses_upload'])->name('upload.proses');

Route::post('/upload/resize', [UploadController::class, 'resize_upload'])->name('upload.resize');
