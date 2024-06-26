<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('parent_id')->nullable(); //->constrained('categories')
            $table->string('name', 32);
            $table->string('slug', 71)->unique();
            $table->json('aliases');
            $table->string('icon')->nullable();
            $table->string('avatar')->nullable();
            $table->string('meta_title', 128)->unique();
            $table->string('meta_description', 278);
            $table->string('image', 128)->nullable();
            $table->string('image_alt', 256)->nullable();
        });

        // Окремо визначаємо зовнішній ключ, вказуючи явно на таблицю та стовпець
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
