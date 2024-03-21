<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellStateController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// login and logout
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::post('/register', [UserController::class, 'store']);

// sale state routes
Route::resource('sell/states', SellStateController::class);
Route::get('sell/state/list', [SellStateController::class, 'sellStateList']);

Route::get('provider/list', [ProviderController::class, 'providerList']);
Route::resource('providers', ProviderController::class);

Route::resource('machines', MachineController::class);
Route::get('machine/list', [MachineController::class, 'machineList']);

Route::resource('clients', ClientController::class);
// Route::resource('', CommentController::class);
Route::resource('sales', SaleController::class);

Route::get('sale/edit/{sale}', [SaleController::class,'showEdit']);
Route::get('sale/{sale_id}/comments/', [CommentController::class,'showSaleComments']);
Route::post('sale/comments/', [CommentController::class,'store']);

Route::post('/logout', [AuthController::class, 'logout']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('users/{user_id}', [UserController::class, 'destroy']);

// Other Routers if login
Route::group(['middleware' => ['jwt.verify']], function () {
  Route::get('/me', [UserController::class, 'getMe']);
  Route::get('/users', [UserController::class, 'index']);
  Route::post('/users', [UserController::class, 'store']);
});
