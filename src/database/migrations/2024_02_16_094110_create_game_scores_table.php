<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_scores', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('gameId');
            $table->unsignedBigInteger('memberId');
            $table->mediumInteger('playerScore', false, true);

            $table->foreign('gameId')->references('id')->on('games');
            $table->foreign('memberId')->references('id')->on('members');

            $table->timestamps();

            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_scores');
    }
};
