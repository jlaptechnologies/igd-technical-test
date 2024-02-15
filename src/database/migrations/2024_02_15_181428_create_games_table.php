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
        Schema::create('games', function (Blueprint $table) {
            $table->id();

            $table->dateTime('gameDateTime');
            $table->unsignedBigInteger('playerOneMemberId');
            $table->mediumInteger('playerOneScore', false, true);
            $table->unsignedBigInteger('playerTwoMemberId');
            $table->mediumInteger('playerTwoScore', false, true);

            $table->foreign('playerOneMemberId')->references('id')->on('members');
            $table->foreign('playerTwoMemberId')->references('id')->on('members');

            $table->timestamps();

            $table->index('gameDateTime');
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
