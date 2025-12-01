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
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained()->cascadeOnDelete();
            $table->foreignId('donor_id')->constrained()->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['active', 'paused', 'completed', 'cancelled'])->default('active');
            $table->decimal('monthly_amount', 10, 2);
            $table->enum('payment_frequency', ['monthly', 'quarterly', 'yearly']);
            $table->date('last_payment_date')->nullable();
            $table->date('next_payment_date')->nullable();
            $table->integer('total_payments')->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->text('special_requests')->nullable();
            $table->boolean('wants_updates')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['child_id', 'status']);
            $table->index(['donor_id', 'status']);
            $table->index('next_payment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsorships');
    }
};
