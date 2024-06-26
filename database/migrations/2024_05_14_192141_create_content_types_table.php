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
        Schema::create('content_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 64);
            $table->string('slug', 71)->unique();
            $table->string('icon', 64)->nullable();
            $table->char('background_color', 6);
            $table->string('text_color', 6);
            $table->string('meta_title', 128)->unique();
            $table->string('meta_description', 278);
            $table->string('image', 128)->nullable();
            $table->string('image_alt', 256)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_types');
    }
};
