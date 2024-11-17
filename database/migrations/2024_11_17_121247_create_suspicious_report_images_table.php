<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suspicious_report_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suspicious_report_id')->constrained('suspicious_reports')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('image_url',2083);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suspicious_report_images');
    }
};
