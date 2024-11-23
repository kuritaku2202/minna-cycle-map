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
        Schema::create('safety_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('spot_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('time_period_id')->nullable()->constrained('time_periods')->cascadeOnUpdate();
            $table->date('date');
            $table->string('description',1000)->nullable();
            $table->tinyInteger('security_staff')->default(0)->comment('0=不明,1=はい,-1=いいえ');
            $table->tinyInteger('security_camera')->default(0)->comment('0=不明,1=はい,-1=いいえ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safety__reports');
    }
};
