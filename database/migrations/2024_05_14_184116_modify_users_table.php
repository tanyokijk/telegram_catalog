<?php

use App\Enums\UserRoleEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Додаємо нові поля
            $table->bigInteger('telegram_id')->unique()->nullable();
            $table->string('username', 32)->unique()->nullable();
            $table->string('avatar_url', 2048)->nullable();
            $table->string('first_name', 64)->nullable();
            $table->string('last_name', 64)->nullable();
            $table->enum('role', UserRoleEnum::values())->default('user');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Тут вказуйте, як відкотити зміни
            $table->dropColumn(['telegram_id', 'username', 'avatar_url', 'first_name', 'last_name']);
        });

    }
};
