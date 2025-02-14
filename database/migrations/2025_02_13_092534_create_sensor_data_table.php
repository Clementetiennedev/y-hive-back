<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sensor_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sensor_id')->constrained();
            $table->string('model_type');
            $table->string('model_id');
            $table->string('data_type');
            $table->float('value');
            $table->dateTime('recorded_at');
            $table->boolean('anomaly')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sensor_data');
    }
};
