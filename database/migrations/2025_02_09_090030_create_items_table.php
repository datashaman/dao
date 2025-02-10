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
        Schema::create('items', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('item_type_id');
            $table->string('name');
            $table->unsignedTinyInteger('dice_count')->nullable();
            $table->unsignedTinyInteger('dice_size')->nullable();
            $table->tinyInteger('base_modifier')->nullable();
            $table->tinyInteger('modifier')->nullable();
            $table->unsignedTinyInteger('defence')->nullable();
            $table->boolean('quantifiable')->default(false);
            $table->timestamps();

            $table->foreign('item_type_id')
                ->references('id')
                ->on('item_types')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
