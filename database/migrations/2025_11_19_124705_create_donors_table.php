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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->enum('donor_type', ['individual', 'organization', 'corporate', 'foundation'])->default('individual');
            $table->enum('status', ['active', 'inactive', 'blacklisted'])->default('active');
            $table->date('first_donation_date')->nullable();
            $table->date('last_donation_date')->nullable();
            $table->decimal('total_donated', 12, 2)->default(0);
            $table->integer('donation_count')->default(0);
            $table->text('notes')->nullable();
            $table->text('preferences')->nullable(); // JSON for AI matching
            $table->json('ai_metadata')->nullable(); // AI engagement scores, etc.
            $table->timestamps();
            $table->softDeletes();

            $table->index(['donor_type', 'status']);
            $table->index('last_donation_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
