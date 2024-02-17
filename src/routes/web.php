<?php

use App\Http\Controllers\GameController;
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

    Route::get('/profile/{id}', [MemberController::class, 'profile'])
        ->name('profile');

    // Two routes with the same URI, but different HTTP verbs
    Route::get('/updateMemberDetails/{id}', [MemberController::class, 'showUpdateMemberDetails'])
        ->name('showUpdateMemberDetails');

    Route::put('/updateMemberDetails', [MemberController::class, 'updateMemberDetails'])
        ->name('updateMemberDetails');

});

Route::group(['prefix' => 'game', 'as' => 'game.'], function() {

    Route::get('/{id}', [GameController::class, 'showGame'])
        ->name('showGame');

    Route::get('/create', [GameController::class, 'create'])
        ->name('create');

    Route::post('/create', [GameController::class, 'insert'])
        ->name('insert');

    Route::delete('/delete/{id}', [GameController::class, 'delete'])
        ->name('delete');
});
