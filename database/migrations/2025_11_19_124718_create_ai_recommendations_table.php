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
        Schema::create('ai_recommendations', function (Blueprint $table) {
            $table->id();
            $table->enum('recommendation_type', ['donor_contact', 'donor_matching', 'inventory_restock', 'welfare_risk', 'child_needs', 'volunteer_match', 'event_suggestion']);
            $table->string('title');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->json('data')->nullable(); // Stores relevant IDs and metadata
            $table->decimal('confidence_score', 5, 2)->nullable(); // AI confidence 0-100
            $table->enum('status', ['pending', 'viewed', 'actioned', 'dismissed'])->default('pending');
            $table->timestamp('actioned_at')->nullable();
            $table->foreignId('actioned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('action_notes')->nullable();
            $table->timestamps();

            $table->index(['recommendation_type', 'status']);
            $table->index(['priority', 'status']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_recommendations');
    }
};
