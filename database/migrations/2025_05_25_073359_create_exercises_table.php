<?php

declare(strict_types=1);

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
        Schema::create('exercises', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->text('instruction')->nullable();
            $table->foreignId('main_muscle_group_id')->constrained('muscle_groups')->onDelete('cascade');
            $table->foreignId('second_muscle_group_id')->nullable()->constrained('muscle_groups')->onDelete('cascade');
            $table->foreignId('equipment_group_id')->constrained('equipment_groups')->onDelete('cascade');
            $table->boolean('visibility')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelet('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
