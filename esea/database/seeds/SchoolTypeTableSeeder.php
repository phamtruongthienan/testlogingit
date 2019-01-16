<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_school_type')->insert([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
            ['id' => 4],
        ]);

        DB::table('m_school_type_translation')->insert([
            ['name' => 'Internatinal', 'language_id' => 1, 'translation_id' => 1],
            ['name' => 'Internatinal', 'language_id' => 2, 'translation_id' => 1],
            ['name' => 'Binglingual', 'language_id' => 1, 'translation_id' => 2],
            ['name' => 'Binglingual', 'language_id' => 2, 'translation_id' => 2],
            ['name' => 'Private', 'language_id' => 1, 'translation_id' => 3],
            ['name' => 'Private', 'language_id' => 2, 'translation_id' => 3],
            ['name' => 'Local preschool', 'language_id' => 1, 'translation_id' => 4],
            ['name' => 'Local preschool', 'language_id' => 2, 'translation_id' => 4]
        ]);
    }
}
