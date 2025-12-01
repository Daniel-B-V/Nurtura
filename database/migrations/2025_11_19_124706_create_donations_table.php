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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained()->cascadeOnDelete();
            $table->enum('donation_type', ['monetary', 'in_kind', 'service', 'sponsorship']);
            $table->decimal('amount', 12, 2)->nullable();
            $table->string('currency')->default('USD');
            $table->text('description')->nullable();
            $table->text('items')->nullable(); // JSON for in-kind donations
            $table->date('donation_date');
            $table->enum('payment_method', ['cash', 'check', 'bank_transfer', 'credit_card', 'paypal', 'other'])->nullable();
            $table->string('reference_number')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->boolean('is_recurring')->default(false);
            $table->enum('frequency', ['one_time', 'weekly', 'monthly', 'quarterly', 'yearly'])->default('one_time');
            $table->foreignId('allocated_to_child_id')->nullable()->constrained('children')->nullOnDelete();
            $table->text('purpose')->nullable();
            $table->text('thank_you_note')->nullable();
            $table->date('thank_you_sent_date')->nullable();
            $table->foreignId('recorded_by')->constrained('users');
            $table->timestamps();

            $table->index(['donor_id', 'donation_date']);
            $table->index(['donation_type', 'donation_date']);
            $table->index('allocated_to_child_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
