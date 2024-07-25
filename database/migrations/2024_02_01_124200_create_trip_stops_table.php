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
        Schema::create('trip_stops', function (Blueprint $table) {
            $table->bigIncrements('trip_stop_id');
            $table->unsignedBigInteger('trip_id');
            $table->foreign('trip_id')->references('trip_id')->on('trips');
            $table->unsignedBigInteger('stop_id');
            $table->foreign('stop_id')->references('stop_id')->on('stops');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_stops');
    }
};
