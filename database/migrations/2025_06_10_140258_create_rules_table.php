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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->unsignedBigInteger('solusi');
            $table->unsignedBigInteger('solusi_rekomendasi')->nullable();
            $table->text('description_rekomendasi')->nullable();

            $table->foreign('solusi')->references('id')->on('rakitan');
            $table->foreign('solusi_rekomendasi')
                ->references('id')
                ->on('rakitan')
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
