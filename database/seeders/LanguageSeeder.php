<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'Ukrainian', 'alpha_2_code' => 'uk'],
            ['name' => 'English', 'alpha_2_code' => 'en'],
            ['name' => 'Spanish', 'alpha_2_code' => 'es'],
            ['name' => 'French', 'alpha_2_code' => 'fr'],
            ['name' => 'Polish', 'alpha_2_code' => 'pl'],
            ['name' => 'Czech', 'alpha_2_code' => 'cs'],
            ['name' => 'Slovak', 'alpha_2_code' => 'sk'],
            ['name' => 'Hungarian', 'alpha_2_code' => 'hu'],
            ['name' => 'Romanian', 'alpha_2_code' => 'ro'],
            ['name' => 'Bulgarian', 'alpha_2_code' => 'bg'],
            ['name' => 'Serbian', 'alpha_2_code' => 'sr'],
            ['name' => 'Croatian', 'alpha_2_code' => 'hr'],
            ['name' => 'Slovenian', 'alpha_2_code' => 'sl'],
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }

    }
}
