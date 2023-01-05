<?php

use App\Http\Controllers\AuthController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::match(['get', 'post'], '/logout', [AuthController::class, 'Logout']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('get_register');
    Route::post('/register', [AuthController::class, 'Register'])->name('post_register');

    Route::get('/login', function () {
        return view('auth.login');
    })->name('get_login');
    Route::post('/login', [AuthController::class, 'Login'])->name('post_login');
});





// Route::get('/info', function () {
//     return phpinfo();
// });
