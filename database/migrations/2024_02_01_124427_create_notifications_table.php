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
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('notification_id');
            $table->string('title');
            $table->text('contant');
            $table->date('date');
            $table->enum('type', ['info', 'warning', 'action']);
            $table->enum('recipient_type', ['subscriber', 'driver', 'company']);
            $table->enum('state', ['read', 'unread']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
