<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id' => Str::uuid(), 'name' => 'Ukrainian', 'alpha_2_code' => 'uk'],
            ['id' => Str::uuid(), 'name' => 'English', 'alpha_2_code' => 'en'],
            ['id' => Str::uuid(), 'name' => 'Russian', 'alpha_2_code' => 'ru'],
            ['id' => Str::uuid(), 'name' => 'Hungarian', 'alpha_2_code' => 'hu'],
        ]);

    }
}
