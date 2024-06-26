<?php

use App\Enums\AccessType;
use App\Enums\ChatType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('chat_id')->unique();
            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('language_id')->constrained();
            $table->string('username', 32)->unique();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->enum('access_type', AccessType::values());
            $table->enum('type', ChatType::values());
            $table->string('avatar', 2048)->nullable();
            $table->boolean('is_published')->default(false);
            $table->string('invite_link', 2048)->nullable();
            $table->integer('avg_views')->nullable();
            $table->integer('subscribers')->nullable();
            $table->string('meta_title', 128)->unique();
            $table->string('meta_description', 278);
            $table->string('image', 128)->nullable();
            $table->string('image_alt', 256)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
