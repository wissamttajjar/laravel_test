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
        Schema::create('year_users', function (Blueprint $table) {
            $table->bigIncrements('yuser_id');
            $table->unsignedBigInteger('duser_id');
            $table->foreign('duser_id')->references('duser_id')->on('dashboard_users');
            $table->unsignedBigInteger('year_id');
            $table->foreign('year_id')->references('year_id')->on('years');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('year_users');
    }
};
