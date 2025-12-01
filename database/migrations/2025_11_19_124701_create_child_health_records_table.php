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
        Schema::create('child_health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained()->cascadeOnDelete();
            $table->date('checkup_date');
            $table->enum('record_type', ['checkup', 'vaccination', 'illness', 'injury', 'medication', 'other']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('facility')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->text('medications')->nullable();
            $table->text('allergies')->nullable();
            $table->text('notes')->nullable();
            $table->date('next_appointment')->nullable();
            $table->boolean('requires_followup')->default(false);
            $table->string('attachments')->nullable(); // JSON array of file paths
            $table->foreignId('recorded_by')->nullable()->constrained('users');
            $table->timestamps();

            $table->index(['child_id', 'checkup_date']);
            $table->index(['record_type', 'requires_followup']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_health_records');
    }
};
