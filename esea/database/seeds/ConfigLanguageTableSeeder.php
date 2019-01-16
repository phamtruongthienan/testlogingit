<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigLanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('config_language')->insert([
            [
                'name' => 'Tiếng Việt',
                'code' => 'vi',
                'default' => 1,
                'currency_code' => 'VNĐ',
                'date_format' => 'd/m/Y'
            ],
            [
                'name' => 'Tiếng Anh',
                'code' => 'en',
                'default' => 0,
                'currency_code' => 'USD',
                'date_format' => 'Y-m-d'
            ],
        ]);
    }
}
