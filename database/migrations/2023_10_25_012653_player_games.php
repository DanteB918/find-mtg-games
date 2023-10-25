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
        if (!Schema::hasTable('player_games')) {
            // Code to create table
            Schema::create('player_games', function (Blueprint $table) {
                $table->increments('id')->unique();
                $table->integer('game_id');
                $table->integer('player_id');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_games');
    }
};
