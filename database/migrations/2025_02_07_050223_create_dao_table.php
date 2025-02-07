<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('attributes_index_7');
        });

        Schema::create('bloodlines', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('bloodlines_index_4');
        });

        Schema::create('entity_attributes', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('entity_type');
            $table->integer('entity_id');
            $table->integer('attribute_id')->index('attribute_id');
            $table->integer('value');
            $table->integer('max_value')->nullable();

            $table->unique(['entity_type', 'entity_id', 'attribute_id'], 'entity_attributes_index_8');
        });

        Schema::create('entity_items', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('entity_type');
            $table->integer('entity_id');
            $table->integer('item_id')->index('item_id');
            $table->integer('quantity');

            $table->unique(['entity_type', 'entity_id', 'item_id'], 'entity_items_index_22');
        });

        Schema::create('items', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('items_index_21');
        });

        Schema::create('modifiers', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('modifier_type');
            $table->integer('modifier_id');
            $table->integer('attribute_id')->index('modifiers_index_10');
            $table->integer('multiplier')->nullable();
            $table->integer('difference')->nullable();
            $table->integer('base_difference')->nullable();
            $table->integer('max_difference')->nullable();

            $table->index(['modifier_type', 'modifier_id'], 'modifiers_index_9');
        });

        Schema::create('person_professions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('person_id');
            $table->integer('profession_id')->index('profession_id');
            $table->integer('profession_level_id')->index('profession_level_id');

            $table->unique(['person_id', 'profession_id'], 'person_professions_index_16');
        });

        Schema::create('person_skills', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('person_id');
            $table->integer('skill_id')->index('skill_id');
            $table->integer('skill_level_id')->index('skill_level_id');

            $table->unique(['person_id', 'skill_id'], 'person_skills_index_20');
        });

        Schema::create('person_title', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('person_id');
            $table->integer('title_id')->index('title_id');

            $table->unique(['person_id', 'title_id'], 'person_title_index_13');
        });

        Schema::create('persons', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('user_id')->index('user_id');
            $table->string('family_name');
            $table->string('given_name');
            $table->string('honorific')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('birth_region_id')->index('birth_region_id');
            $table->integer('current_region_id')->index('current_region_id');
            $table->integer('race_id')->index('race_id');
            $table->integer('bloodline_id')->nullable()->index('bloodline_id');

            $table->unique(['family_name', 'given_name'], 'persons_index_6');
        });

        Schema::create('planets', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('sector_id')->nullable();
            $table->string('name');

            $table->unique(['sector_id', 'name'], 'planets_index_2');
        });

        Schema::create('profession_levels', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('profession_levels_index_14');
        });

        Schema::create('professions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('professions_index_15');
        });

        Schema::create('races', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('races_index_5');
        });

        Schema::create('regions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('planet_id');
            $table->string('name');

            $table->unique(['planet_id', 'name'], 'regions_index_3');
        });

        Schema::create('sectors', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('universe_id')->nullable();
            $table->string('name');

            $table->unique(['universe_id', 'name'], 'sectors_index_1');
        });

        Schema::create('skill_levels', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('skill_levels_index_19');
        });

        Schema::create('skill_types', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('skill_types_index_17');
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('skills_index_18');
            $table->integer('skill_type_id')->index('skill_type_id');
        });

        Schema::create('title_types', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('title_types_index_11');
        });

        Schema::create('titles', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('titles_index_12');
            $table->integer('title_type_id')->index('title_type_id');
        });

        Schema::create('universes', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->unique('universes_index_0');
        });

        Schema::table('entity_attributes', function (Blueprint $table) {
            $table->foreign(['attribute_id'], 'entity_attributes_ibfk_1')->references(['id'])->on('attributes')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('entity_items', function (Blueprint $table) {
            $table->foreign(['item_id'], 'entity_items_ibfk_1')->references(['id'])->on('items')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('modifiers', function (Blueprint $table) {
            $table->foreign(['attribute_id'], 'modifiers_ibfk_1')->references(['id'])->on('attributes')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('person_professions', function (Blueprint $table) {
            $table->foreign(['person_id'], 'person_professions_ibfk_1')->references(['id'])->on('persons')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['profession_id'], 'person_professions_ibfk_2')->references(['id'])->on('professions')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['profession_level_id'], 'person_professions_ibfk_3')->references(['id'])->on('profession_levels')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('person_skills', function (Blueprint $table) {
            $table->foreign(['person_id'], 'person_skills_ibfk_1')->references(['id'])->on('persons')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['skill_id'], 'person_skills_ibfk_2')->references(['id'])->on('skills')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['skill_level_id'], 'person_skills_ibfk_3')->references(['id'])->on('skill_levels')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('person_title', function (Blueprint $table) {
            $table->foreign(['person_id'], 'person_title_ibfk_1')->references(['id'])->on('persons')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['title_id'], 'person_title_ibfk_2')->references(['id'])->on('titles')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('persons', function (Blueprint $table) {
            $table->foreign(['user_id'], 'persons_ibfk_1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['birth_region_id'], 'persons_ibfk_2')->references(['id'])->on('regions')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['current_region_id'], 'persons_ibfk_3')->references(['id'])->on('regions')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['race_id'], 'persons_ibfk_4')->references(['id'])->on('races')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['bloodline_id'], 'persons_ibfk_5')->references(['id'])->on('bloodlines')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('planets', function (Blueprint $table) {
            $table->foreign(['sector_id'], 'planets_ibfk_1')->references(['id'])->on('sectors')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('regions', function (Blueprint $table) {
            $table->foreign(['planet_id'], 'regions_ibfk_1')->references(['id'])->on('planets')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('sectors', function (Blueprint $table) {
            $table->foreign(['universe_id'], 'sectors_ibfk_1')->references(['id'])->on('universes')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->foreign(['skill_type_id'], 'skills_ibfk_1')->references(['id'])->on('skill_types')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('titles', function (Blueprint $table) {
            $table->foreign(['title_type_id'], 'titles_ibfk_1')->references(['id'])->on('title_types')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('titles', function (Blueprint $table) {
            $table->dropForeign('titles_ibfk_1');
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->dropForeign('skills_ibfk_1');
        });

        Schema::table('sectors', function (Blueprint $table) {
            $table->dropForeign('sectors_ibfk_1');
        });

        Schema::table('regions', function (Blueprint $table) {
            $table->dropForeign('regions_ibfk_1');
        });

        Schema::table('planets', function (Blueprint $table) {
            $table->dropForeign('planets_ibfk_1');
        });

        Schema::table('persons', function (Blueprint $table) {
            $table->dropForeign('persons_ibfk_1');
            $table->dropForeign('persons_ibfk_2');
            $table->dropForeign('persons_ibfk_3');
            $table->dropForeign('persons_ibfk_4');
            $table->dropForeign('persons_ibfk_5');
        });

        Schema::table('person_title', function (Blueprint $table) {
            $table->dropForeign('person_title_ibfk_1');
            $table->dropForeign('person_title_ibfk_2');
        });

        Schema::table('person_skills', function (Blueprint $table) {
            $table->dropForeign('person_skills_ibfk_1');
            $table->dropForeign('person_skills_ibfk_2');
            $table->dropForeign('person_skills_ibfk_3');
        });

        Schema::table('person_professions', function (Blueprint $table) {
            $table->dropForeign('person_professions_ibfk_1');
            $table->dropForeign('person_professions_ibfk_2');
            $table->dropForeign('person_professions_ibfk_3');
        });

        Schema::table('modifiers', function (Blueprint $table) {
            $table->dropForeign('modifiers_ibfk_1');
        });

        Schema::table('entity_items', function (Blueprint $table) {
            $table->dropForeign('entity_items_ibfk_1');
        });

        Schema::table('entity_attributes', function (Blueprint $table) {
            $table->dropForeign('entity_attributes_ibfk_1');
        });

        Schema::dropIfExists('universes');

        Schema::dropIfExists('titles');

        Schema::dropIfExists('title_types');

        Schema::dropIfExists('skills');

        Schema::dropIfExists('skill_types');

        Schema::dropIfExists('skill_levels');

        Schema::dropIfExists('sectors');

        Schema::dropIfExists('regions');

        Schema::dropIfExists('races');

        Schema::dropIfExists('professions');

        Schema::dropIfExists('profession_levels');

        Schema::dropIfExists('planets');

        Schema::dropIfExists('persons');

        Schema::dropIfExists('person_title');

        Schema::dropIfExists('person_skills');

        Schema::dropIfExists('person_professions');

        Schema::dropIfExists('modifiers');

        Schema::dropIfExists('items');

        Schema::dropIfExists('entity_items');

        Schema::dropIfExists('entity_attributes');

        Schema::dropIfExists('bloodlines');

        Schema::dropIfExists('attributes');
    }
};
