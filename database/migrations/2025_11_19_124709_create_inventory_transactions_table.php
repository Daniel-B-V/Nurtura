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
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_item_id')->constrained()->cascadeOnDelete();
            $table->enum('transaction_type', ['in', 'out', 'adjustment', 'return', 'disposal']);
            $table->integer('quantity');
            $table->integer('quantity_before')->default(0);
            $table->integer('quantity_after')->default(0);
            $table->decimal('unit_cost', 10, 2)->nullable();
            $table->decimal('total_cost', 12, 2)->nullable();
            $table->timestamp('transaction_date')->nullable();
            $table->string('reference_number')->nullable();
            $table->text('reason')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('related_donation_id')->nullable()->constrained('donations')->nullOnDelete();
            $table->foreignId('allocated_to_child_id')->nullable()->constrained('children')->nullOnDelete();
            $table->foreignId('performed_by')->constrained('users');
            $table->timestamps();

            $table->index(['inventory_item_id', 'transaction_type']);
            $table->index('transaction_date');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_transactions');
    }
};
