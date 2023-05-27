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
        if (!Schema::hasTable('notifications')) {
            // Code to create table
            Schema::create('notifications', function (Blueprint $table) {
                $table->increments('id')->unique();
                $table->string('content');
                $table->time('time');
                $table->date('date');
                $table->boolean('status');
                $table->string('link');
                $table->integer('from'); //User ID
                $table->integer('to'); //User ID
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
