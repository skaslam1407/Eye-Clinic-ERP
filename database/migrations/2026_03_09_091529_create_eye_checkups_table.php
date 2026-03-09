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
        Schema::create('eye_checkups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('doctor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('vision_test')->nullable();
            $table->string('right_eye_vision')->nullable();
            $table->string('left_eye_vision')->nullable();
            $table->string('lens_power')->nullable();
            $table->string('sph')->nullable();
            $table->string('cyl')->nullable();
            $table->string('axis')->nullable();
            $table->enum('eye_condition', ['Cataract', 'Glaucoma', 'Dry Eye', 'Normal'])->default('Normal');
            $table->text('doctor_notes')->nullable();
            $table->text('prescription')->nullable();
            $table->string('recommended_glasses')->nullable();
            $table->date('follow_up_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eye_checkups');
    }
};
