<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\ScoreboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ScoreboardController::class, 'showMainScoreBoard'])
    ->name('mainScoreBoard');

Route::group(['prefix' => '/member', 'as' => 'member.'], function() {

    Route::get('/list', [MemberController::class, 'list'])
        ->name('list');

    Route::get('/{id}', [MemberController::class, 'memberPage'])
        ->name('profile');

    Route::put('/updateMemberDetails', [MemberController::class, 'updateMemberDetails'])
        ->name('updateMemberDetails');

});
