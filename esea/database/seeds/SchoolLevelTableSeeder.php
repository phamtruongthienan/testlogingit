<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_school_level')->insert([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
            ['id' => 4],
        ]);

        DB::table('m_school_level_translation')->insert([
            ['name' => 'Preschools', 'language_id' => 1, 'translation_id' => 1],
            ['name' => 'Preschools', 'language_id' => 2, 'translation_id' => 1],
            ['name' => 'Kindergarten', 'language_id' => 1, 'translation_id' => 2],
            ['name' => 'Kindergarten', 'language_id' => 2, 'translation_id' => 2],
            ['name' => 'Primary', 'language_id' => 1, 'translation_id' => 3],
            ['name' => 'Primary', 'language_id' => 2, 'translation_id' => 3],
            ['name' => 'Language Courses', 'language_id' => 1, 'translation_id' => 4],
            ['name' => 'Language Courses', 'language_id' => 2, 'translation_id' => 4]
        ]);
    }
}
