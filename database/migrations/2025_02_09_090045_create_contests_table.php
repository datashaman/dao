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
        Schema::create('contests', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('name')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedTinyInteger('min_contestants');
            $table->unsignedTinyInteger('max_contestants');
            $table->unsignedTinyInteger('timeout_minutes');
            $table->unsignedTinyInteger('countdown_seconds');
            $table->string('winner')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contests');
    }
};
