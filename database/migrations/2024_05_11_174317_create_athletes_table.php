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
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('phone')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->double('height')->nullable();
            $table->double('weight')->nullable();
            $table->string('position')->nullable();
            $table->string('status')->nullable();
            $table->string('achievement')->nullable();
            $table->foreignId('level_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};
