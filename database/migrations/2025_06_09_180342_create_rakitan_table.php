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
        Schema::create('rakitan', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100);
            $table->string('name', 255);
            $table->unsignedBigInteger('motherboard')->nullable();
            $table->unsignedBigInteger('processor')->nullable();
            $table->unsignedBigInteger('ram')->nullable();
            $table->unsignedBigInteger('casing')->nullable();
            $table->unsignedBigInteger('storage_primary')->nullable();
            $table->unsignedBigInteger('storage_secondary')->nullable();
            $table->unsignedBigInteger('vga')->nullable();
            $table->unsignedBigInteger('psu')->nullable();
            $table->unsignedBigInteger('monitor')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->foreign('motherboard')->references('id')->on('components');
            $table->foreign('processor')->references('id')->on('components');
            $table->foreign('ram')->references('id')->on('components');
            $table->foreign('casing')->references('id')->on('components');
            $table->foreign('storage_primary')->references('id')->on('components');
            $table->foreign('storage_secondary')->references('id')->on('components');
            $table->foreign('vga')->references('id')->on('components');
            $table->foreign('psu')->references('id')->on('components');
            $table->foreign('monitor')->references('id')->on('components');
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rakitan');
    }
};
