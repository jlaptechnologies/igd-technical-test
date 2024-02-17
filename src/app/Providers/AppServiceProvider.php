<?php

namespace App\Providers;

use App\Http\Controllers\GameController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberDetailsController;
use App\Http\Controllers\ScoreboardController;
use App\Repositories\GameRepository;
use App\Repositories\MemberRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this
            ->app
            ->when(ScoreboardController::class)
            ->needs(RepositoryInterface::class)
            ->give(function(){
                return new GameRepository();
            });

        $this
            ->app
            ->when(MemberController::class)
            ->needs(RepositoryInterface::class)
            ->give(function(){
                return new MemberRepository();
            });

        $this
            ->app
            ->when(MemberDetailsController::class)
            ->needs(RepositoryInterface::class)
            ->give(function(){
                return new MemberRepository();
            });

        $this
            ->app
            ->when(GameController::class)
            ->needs(RepositoryInterface::class)
            ->give(function(){
                return new GameRepository();
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
