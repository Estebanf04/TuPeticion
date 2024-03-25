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
        Schema::create('peticions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->string('content', 250);
            $table->string('file')->nullable();
            $table->string('status')->default('pendiente');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');  
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peticions');
    }
};
