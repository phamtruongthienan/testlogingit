<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_school_class')->insert([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
            ['id' => 4],
        ]);

        DB::table('m_school_class_translation')->insert([
            ['name' => 'Phòng anh văn', 'position' => 'Tầng 1', 'language_id' => 1, 'translation_id' => 1],
            ['name' => 'English room', 'position' => '1st floor', 'language_id' => 2, 'translation_id' => 1],
            ['name' => 'Phòng lab', 'position' => 'Tầng 2', 'language_id' => 1, 'translation_id' => 2],
            ['name' => 'Lab room', 'position' => '2nd floor', 'language_id' => 2, 'translation_id' => 2],
            ['name' => 'Phòng A001', 'position' => 'Tầng 3', 'language_id' => 1, 'translation_id' => 3],
            ['name' => 'A001 room', 'position' => '3rd floor', 'language_id' => 2, 'translation_id' => 3],
            ['name' => 'Phòng A002', 'position' => 'Tầng 3', 'language_id' => 1, 'translation_id' => 4],
            ['name' => 'A002 room', 'position' => '3rd floor', 'language_id' => 2, 'translation_id' => 4]
        ]);

        DB::table('m_school_class_addon')->insert([
            ['school_class_id' => 1],
            ['school_class_id' => 2]
        ]);

        DB::table('m_school_class_addon_translation')->insert([
            ['name' => 'Khu vực', 'content' => 'A', 'language_id' => 1, 'translation_id' => 1],
            ['name' => 'Area', 'content' => 'A side', 'language_id' => 2, 'translation_id' => 1],
            ['name' => 'Dãy', 'content' => '2', 'language_id' => 1, 'translation_id' => 2],
            ['name' => 'Row', 'content' => '2ndr', 'language_id' => 2, 'translation_id' => 2],
        ]);
    }
}
