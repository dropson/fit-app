<?php

declare(strict_types=1);

use App\Models\Workouts\TemplateExercise;
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
        Schema::create('template_sets', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(TemplateExercise::class)->constrained()->onDelete('cascade');
            $table->unsignedInteger('set_number')->nullable();
            $table->unsignedInteger('repetitions')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_sets');
    }
};
