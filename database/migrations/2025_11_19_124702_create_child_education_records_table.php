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
        Schema::create('child_education_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained()->cascadeOnDelete();
            $table->string('school_name')->nullable();
            $table->string('grade_level')->nullable();
            $table->enum('enrollment_status', ['enrolled', 'not_enrolled', 'homeschooled', 'graduated', 'dropped_out'])->default('not_enrolled');
            $table->date('enrollment_date')->nullable();
            $table->string('academic_year')->nullable();
            $table->text('performance_notes')->nullable();
            $table->decimal('gpa', 3, 2)->nullable();
            $table->text('subjects')->nullable(); // JSON array
            $table->text('achievements')->nullable();
            $table->text('challenges')->nullable();
            $table->text('special_needs')->nullable();
            $table->text('extracurricular_activities')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users');
            $table->timestamps();

            $table->index(['child_id', 'enrollment_status']);
            $table->index('academic_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_education_records');
    }
};
