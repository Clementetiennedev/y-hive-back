<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('queen_reproductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hive_id')->constrained();
            $table->dateTime('reproduction_date');
            $table->boolean('new_colony_created')->default(false);
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('queen_reproductions');
    }
};
