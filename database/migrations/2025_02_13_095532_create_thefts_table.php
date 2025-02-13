<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('thefts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hive_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->dateTime('reported_date');
            $table->string('last_known_location');
            $table->text('picture_path')->nullable();
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('thefts');
    }
};
