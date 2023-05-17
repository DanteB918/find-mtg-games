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
        if (!Schema::hasTable('games')) {
            // Code to create table
            Schema::create('games', function (Blueprint $table) {
                $table->increments('id')->unique();
                $table->time('time');
                $table->date('date');
                $table->integer('power_level');
                $table->string('state', 30);
                $table->string('country', 30);
                $table->integer('number_players');
                $table->string('format', 30);
                $table->string('description', 200);
                $table->boolean('status');
                $table->integer('created_by');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
