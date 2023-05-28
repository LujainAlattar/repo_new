<?php

use App\Http\Controllers\AgemtPageController;
use App\Http\Controllers\AgentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashbourdController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserTicketController;
use Illuminate\Support\Facades\Auth;



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
    if (Auth::check()) {
        return view('welcome');
    } else {
        return view('auth.login');
    }
});

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Login routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::post('logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::resource('dashboard',DashbourdController::class);

Route::resource('agent',AgentController::class);

Route::resource('ticket',TicketController::class);

Route::get('/user/hello', function () {
    return view('user/hello');
});
Route::resource('user',UserTicketController::class);

Route::resource('agent_page' , AgemtPageController::class);




use App\Http\Controllers\AppointmentController;

Route::resource('appointments', AppointmentController::class);
