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
        Schema::create('channel_content_type', function (Blueprint $table) {
            $table->foreignUuid('chat_id')->constrained('chats')->onDelete('cascade');
            $table->foreignUuid('content_type_id')->constrained('content_types')->onDelete('cascade');
            $table->primary(['chat_id', 'content_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channel_content_type');
    }
};
