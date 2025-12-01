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
        Schema::create('child_welfare_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained()->cascadeOnDelete();
            $table->enum('note_type', ['behavioral', 'emotional', 'social', 'developmental', 'incident', 'achievement', 'concern', 'other']);
            $table->string('title');
            $table->text('description');
            $table->enum('severity', ['low', 'medium', 'high', 'critical'])->default('low');
            $table->enum('emotional_state', ['happy', 'sad', 'anxious', 'angry', 'calm', 'distressed', 'other'])->nullable();
            $table->text('action_taken')->nullable();
            $table->text('recommendations')->nullable();
            $table->boolean('requires_attention')->default(false);
            $table->date('follow_up_date')->nullable();
            $table->foreignId('recorded_by')->constrained('users');
            $table->timestamps();

            $table->index(['child_id', 'note_type']);
            $table->index(['severity', 'requires_attention']);
            $table->index('follow_up_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_welfare_notes');
    }
};
