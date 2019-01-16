<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolLanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_school_language')->insert([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
            ['id' => 4],
        ]);

        DB::table('m_school_language_translation')->insert([
            ['name' => 'Anh', 'language_id' => 1, 'translation_id' => 1],
            ['name' => 'English', 'language_id' => 2, 'translation_id' => 1],
            ['name' => 'Hoa', 'language_id' => 1, 'translation_id' => 2],
            ['name' => 'China', 'language_id' => 2, 'translation_id' => 2],
            ['name' => 'Hàn', 'language_id' => 1, 'translation_id' => 3],
            ['name' => 'Korea', 'language_id' => 2, 'translation_id' => 3],
            ['name' => 'Nhật', 'language_id' => 1, 'translation_id' => 4],
            ['name' => 'Japn', 'language_id' => 2, 'translation_id' => 4]
        ]);
    }
}
