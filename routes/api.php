
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


//product routes
Route::group(['as' => 'products.', 'prefix' => 'products'], function () {
    Route::get('/',[ProductController::class,'index'])->name('index');
    Route::post('/',[ProductController::class,'store'])->name('store');
    Route::get('/{id}',[ProductController::class,'show'])->name('show');
    Route::match(['put', 'patch'], '/{id}',[ProductController::class,'update'])->name('update');
    Route::delete('/{id}',[ProductController::class,'destroy'])->name('destroy');

    //comments routes
    Route::group(['as' => 'comments.', 'prefix' => 'products/{product_id}/comments'], function () {
        Route::get('/',[CommentController::class,'index'])->name('index');
        Route::post('/',[CommentController::class,'store'])->name('store');
        Route::match(['put', 'patch'], '/{id}',[CommentController::class,'update'])->name('update');
        Route::delete('/{id}',[CommentController::class,'destroy'])->name('destroy');
    });

    //votes routes
    Route::group(['as' => 'votes.', 'prefix' => 'products/{product_id}/votes'], function () {
        Route::get('/',[VoteController::class,'index'])->name('index');
        Route::post('/',[VoteController::class,'store'])->name('store');
        Route::match(['put', 'patch'], '/{id}',[VoteController::class,'update'])->name('update');
        Route::delete('/{id}',[VoteController::class,'destroy'])->name('destroy');
    });
});