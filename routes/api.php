<?php

use App\Http\Controllers\api\AuthenticationController;
use App\Http\Controllers\api\ContractController;
use App\Http\Controllers\api\ContractPaymentController;
use App\Http\Controllers\api\HouseController;
use App\Http\Controllers\api\HouseFeatureController;
use App\Http\Controllers\api\HouseImageController;
use App\Http\Controllers\api\HouseReviewController;
use App\Http\Controllers\api\HouseRuleController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;

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

Route::controller(AuthenticationController::class)
    ->group(function () {
        Route::post("/register", "register");
        Route::post("/login", "login");
        Route::post("/logout", "logout")->middleware("auth:sanctum");;
    });

Route::controller(UserController::class)
    ->group(function () {
        Route::get("/user/{user:username}/image", "image"); //get the user profile image
        Route::get("/user", "create")->middleware("auth:sanctum"); //get the logged in user information
        Route::post("/user", "update"); //update user info
    });

Route::controller(HouseController::class)
    ->group(function () {
        Route::get("/house", "index"); //get a list of houses
        Route::get("/house/{house:id}", "create"); //get a specific house information
        Route::post("/house", "store")->middleware("auth:sanctum"); //create a new house 
        Route::post("/house/{house}", "update")->middleware("auth:sanctum"); //update a house data
        Route::get('/house/{house}/check/{start_date}/{end_date}', 'check'); //check if the house available to rent in specific duration
    });

Route::controller(HouseImageController::class)->group(function () {
    Route::get("/house/{house:id}/image/{image:id}", "create")->excludedMiddleware(); //get a house image
    Route::post("/house/{house}/image", "store")->middleware("auth:sanctum"); //add new image fot a specific house
    Route::delete("/house/{house:id}/image/{image:id}", "destroy")->middleware("auth:sanctum"); //delete a house image
});

Route::controller(HouseFeatureController::class)->middleware("auth:sanctum")
    ->group(function () {
        Route::post("/house/{house:id}/feature", "store"); //add new features to a house
        Route::delete("/house/{house:id}/feature/{feature:id}", "destroy"); //delete a feature
    });

Route::controller(HouseRuleController::class)->middleware("auth:sanctum")
    ->group(function () {
        Route::post("/house/{house:id}/rule", "store"); //add new rules to a house
        Route::delete("/house/{house:id}/rule/{rule:id}", "destroy"); //delete a rule
    });

Route::controller(ContractController::class)->middleware("auth:sanctum")
    ->group(function () {
        Route::get("/contract", "index"); //get a list of contracts
        Route::get("/contract/{contract:id}", "create"); //get a contract information
        Route::post("/house/{house:id}/contract", "store"); //create a new contract
        Route::delete("/contract/{contract:id}", "destroy"); //delete a contract "works only if the contract is not confirmed"
    });

Route::controller(HouseReviewController::class)
    ->group(function () {
        Route::get("/house/{house:id}/review", "create"); //get a review of the logged in user for a specific house
        Route::get("/house/{house:id}/review/list", "index"); //get a list of reviews for a specific house
        Route::post("/house/{house:id}/review", "store")->middleware("auth:sanctum"); //add "or update if exists" a review
    });

Route::post('/house/{house:id}/contract/{contract:id}/confirm', [ContractPaymentController::class, 'store']) //pay and confirm a contract
    ->middleware("auth:sanctum");
