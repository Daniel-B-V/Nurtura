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
        Schema::create('child_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained()->cascadeOnDelete();
            $table->string('item_name');
            $table->text('description')->nullable();
            $table->enum('category', ['clothing', 'food', 'medical', 'education', 'hygiene', 'other']);
            $table->enum('urgency', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->enum('status', ['pending', 'in_progress', 'fulfilled', 'cancelled'])->default('pending');
            $table->integer('quantity')->default(1);
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->date('needed_by')->nullable();
            $table->date('fulfilled_date')->nullable();
            $table->foreignId('fulfilled_by_donor_id')->nullable()->constrained('donors')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->foreignId('recorded_by')->constrained('users');
            $table->timestamps();

            $table->index(['child_id', 'status', 'urgency']);
            $table->index(['category', 'status']);
            $table->index('needed_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_needs');
    }
};
