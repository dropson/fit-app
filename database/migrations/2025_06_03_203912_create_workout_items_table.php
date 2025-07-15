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
        Schema::create('workout_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workoutable_id');
            $table->string('workoutable_type');
            $table->foreignId('exercise_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('order')->nullable();
            $table->unsignedInteger('set_number');
            $table->unsignedInteger('repetitions')->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->timestamps();

            $table->index(['workoutable_type', 'workoutable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_items');
    }
};
