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
        Schema::create('attribute_person', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('person_id')->index('person_id');
            $table->integer('attribute_id')->index('attribute_id');
            $table->integer('value');
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('attributes_index_4');
        });

        Schema::create('bloodlines', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('bloodlines_index_1');
        });

        Schema::create('item_modifiers', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('item_id')->index('item_id');
            $table->integer('attribute_id')->nullable()->index('attribute_id');
            $table->integer('multiplier')->nullable();
            $table->integer('difference')->nullable();
        });

        Schema::create('item_person', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('person_id')->index('person_id');
            $table->integer('item_id')->index('item_id');
            $table->integer('quantity');
        });

        Schema::create('items', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('items_index_15');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');

        Schema::dropIfExists('item_person');

        Schema::dropIfExists('item_modifiers');

        Schema::dropIfExists('bloodlines');

        Schema::dropIfExists('attributes');

        Schema::dropIfExists('attribute_person');
    }
};
