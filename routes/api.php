<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\AuthAdminController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AdminForgotPasswordController;
use App\Http\Controllers\Api\AdminResetPasswordController;
use App\Http\Controllers\Api\StripeController;
use App\Http\Controllers\Api\DiscordController;
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

Route::group(['middleware' => 'api','prefix' => 'Discord'], function ($router) {
    Route::get('/auth', [DiscordController::class, 'auth']);
    Route::get('/join', [DiscordController::class, 'join']);
    Route::get('/kick/{id}', [DiscordController::class, 'kick']);
});

Route::group(['middleware' => 'api','prefix' => 'Stripe'], function ($router) {
    Route::post('/subscribe', [StripeController::class, 'subscribe']);
    Route::post('/cancel', [StripeController::class, 'cancel']);
    Route::post('/resume', [StripeController::class, 'resume']);
    Route::post('/update_card', [StripeController::class, 'update_card']);
    Route::get('/status', [StripeController::class, 'status']);
});


Route::group(['middleware' => 'api','prefix' => 'Users'], function ($router) {

    // Auth
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);   
    Route::post("/password/email", [ForgotPasswordController::class,"sendResetLinkEmail"]);
    Route::post("/password/reset/{token}", [ResetPasswordController::class,"reset"]);

    // Users
    Route::post("/edit/{id}", [UsersController::class,"update"]);
    Route::post("/", [AuthController::class,"register"]);

});


Route::group(['middleware' => ['api','auth:admin'],'prefix' => 'Users'], function ($router) {

    Route::get("/", [UsersController::class,"index"]);
    Route::get("/counts", [UsersController::class,"counts"]);
    Route::get("/ovice_register/{id}", [UsersController::class,"ovice_register"]);
    Route::get("/ovice_unregister/{id}", [UsersController::class,"ovice_unregister"]);
    Route::get("/{id}", [UsersController::class,"show"]);

});

Route::group(['middleware' => 'api','prefix' => 'Admin'], function ($router) {

    // AuthAdmin
    Route::post('/login', [AuthAdminController::class, 'login']);
    Route::post('/logout', [AuthAdminController::class, 'logout']);
    Route::post('/refresh', [AuthAdminController::class, 'refresh']);
    Route::get('/me', [AuthAdminController::class, 'me']);   
    Route::post("/password/email", [AdminForgotPasswordController::class,"sendResetLinkEmail"]);
    Route::post("/password/reset/{token}", [AdminResetPasswordController::class,"reset"]);

    // Admin
    Route::post("/edit/{id}", [AdminController::class,"update"]);
    Route::get("/", [AdminController::class,"index"]);
    Route::get("/{id}", [AdminController::class,"show"]);
    Route::post("/", [AuthAdminController::class,"register"]);
    Route::post("/delete/{id}", [AdminController::class,"softDelete"]);
    Route::post("/restore/{id}", [AdminController::class,"restore"]);
    Route::post("/destroy/{id}", [AdminController::class,"destroy"]);
    Route::post('/withdrawal/{id}', [AdminController::class, 'withdrawal']);

});

