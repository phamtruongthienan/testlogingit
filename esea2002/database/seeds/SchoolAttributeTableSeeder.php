<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_school_category')->insert([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
            ['id' => 4],
        ]);

        DB::table('m_school_category_translation')->insert([
            ['name' => 'Cơ sở vật chất', 'language_id' => 1, 'translation_id' => 1],
            ['name' => 'Physical facilities', 'language_id' => 2, 'translation_id' => 1],
            ['name' => 'Sự kiện', 'language_id' => 1, 'translation_id' => 2],
            ['name' => 'Event', 'language_id' => 2, 'translation_id' => 2],
            ['name' => 'Trang thiết bị hiện đại', 'language_id' => 1, 'translation_id' => 3],
            ['name' => 'Modern equipment', 'language_id' => 2, 'translation_id' => 3],
            ['name' => 'Chăm sóc sức khỏe', 'language_id' => 1, 'translation_id' => 4],
            ['name' => 'Health care', 'language_id' => 2, 'translation_id' => 4]
        ]);

        DB::table('m_school_attribute')->insert([
            ['school_category_id' => 2, 'type' => 2, 'search' => 1, 'icon' => 'icon-faci-2'],
            ['school_category_id' => 3, 'type' => 2, 'search' => 1, 'icon' => 'icon-faci-2 _2'],
            ['school_category_id' => 2, 'type' => 2, 'search' => 1, 'icon' => 'icon-faci-2 _3'],
            ['school_category_id' => 2, 'type' => 2, 'search' => 1, 'icon' => 'icon-faci-2 _4'],
            ['school_category_id' => 2, 'type' => 2, 'search' => 1, 'icon' => 'icon-faci-2 _5'],
            ['school_category_id' => 1, 'type' => 2, 'search' => 1, 'icon' => 'icon-faci-2 _6'],
            ['school_category_id' => 1, 'type' => 2, 'search' => 0, 'icon' => 'icon-faci-2 _7'],
            ['school_category_id' => 1, 'type' => 2, 'search' => 0, 'icon' => 'icon-faci-2 _8'],
            ['school_category_id' => 4, 'type' => 2, 'search' => 1, 'icon' => 'icon-faci-2 _9'],
            ['school_category_id' => 3, 'type' => 2, 'search' => 1, 'icon' => 'icon-faci-2 _10'],
        ]);

        DB::table('m_school_attribute_translation')->insert([
            ['name' => 'Giờ học muộn', 'content' => 'Cho phép đi học muộn', 'unit' => '1', 'language_id' => 1, 'translation_id' => 1],
            ['name' => 'Late Service', 'content' => 'Late Service', 'unit' => '1', 'language_id' => 2, 'translation_id' => 1],
            ['name' => 'Xe bus', 'content' => 'Xe bus đưa đón', 'unit' => '1', 'language_id' => 1, 'translation_id' => 2],
            ['name' => 'School bus', 'content' => 'School bus', 'unit' => '1', 'language_id' => 2, 'translation_id' => 2],
            ['name' => 'Hồ bơi', 'content' => 'Hồ bơi', 'unit' => '1', 'language_id' => 1, 'translation_id' => 3],
            ['name' => 'Swimming pool', 'content' => 'Swimming pool', 'unit' => '1', 'language_id' => 2, 'translation_id' => 3],
            ['name' => 'Khu vui chơi', 'content' => 'Khu vui chơi', 'unit' => '1', 'language_id' => 1, 'translation_id' => 4],
            ['name' => 'Sand place', 'content' => 'Sand place', 'unit' => '1', 'language_id' => 2, 'translation_id' => 4],
            ['name' => 'Khu vực ngoài trời', 'content' => 'Khu vực ngoài trời', 'unit' => '1', 'language_id' => 1, 'translation_id' => 5],
            ['name' => 'Outdoor space', 'content' => 'Outdoor space', 'unit' => '1', 'language_id' => 2, 'translation_id' => 5],
            ['name' => 'Phòng Gym', 'content' => 'Phòng Gym', 'unit' => '1', 'language_id' => 1, 'translation_id' => 6],
            ['name' => 'Gym room', 'content' => 'Gym room', 'unit' => '1', 'language_id' => 2, 'translation_id' => 6],
            ['name' => 'Phòng bếp', 'content' => 'Phòng bếp', 'unit' => '1', 'language_id' => 1, 'translation_id' => 7],
            ['name' => 'Kitchen room', 'content' => 'Kitchen room', 'unit' => '1', 'language_id' => 2, 'translation_id' => 7],
            ['name' => 'Phòng ăn', 'content' => 'Phòng ăn', 'unit' => '1', 'language_id' => 1, 'translation_id' => 8],
            ['name' => 'Lunch room', 'content' => 'Lunch room', 'unit' => '1', 'language_id' => 2, 'translation_id' => 8],
            ['name' => 'Phòng y tế', 'content' => 'Phòng y tế', 'unit' => '1', 'language_id' => 1, 'translation_id' => 9],
            ['name' => 'Medical room', 'content' => 'Medical room', 'unit' => '1', 'language_id' => 2, 'translation_id' => 9],
            ['name' => 'Giảng đường', 'content' => 'Giảng đường', 'unit' => '1', 'language_id' => 1, 'translation_id' => 10],
            ['name' => 'Function rooms', 'content' => 'Function rooms', 'unit' => '1', 'language_id' => 2, 'translation_id' => 10],
        ]);
    }
}
