<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CustomerController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('/' , function () {
//     return "welcome to jwt-api-auth";
// }
// );

Route::group(['middleware'=>'api'] , function($routes){

    // Route::get('user-store' , function () {
    //     return "user store api";
    // });
    Route::post('/user/store' , [CustomerController::class,'store']);

    Route::get('users/' , [CustomerController::class, 'index']);

});



