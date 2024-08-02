<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('languages')->insert([
            ['id' => fake()->uuid(), 'name' => 'Ukrainian', 'alpha_2_code' => 'uk'],
            ['id' => fake()->uuid(), 'name' => 'English', 'alpha_2_code' => 'en'],
            ['id' => fake()->uuid(), 'name' => 'Russian', 'alpha_2_code' => 'ru'],
            ['id' => fake()->uuid(), 'name' => 'Hungarian', 'alpha_2_code' => 'hu'],
        ]);

    }
}
