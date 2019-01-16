<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayoutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_layout')->insert([
            [
                'name' => 'Layout About Us',
                'path' => 'theme.layout.frontend.template.aboutus',
                'models' => null
            ],
            [
                'name' => 'Layout Contact',
                'path' => 'theme.layout.frontend.template.contact',
                'models' => null
            ],
            [
                'name' => 'Layout FAQ',
                'path' => 'theme.layout.frontend.template.faq',
                'models' => null
            ],
            [
                'name' => 'Layout Help',
                'path' => 'theme.layout.frontend.template.help',
                'models' => null
            ],
            [
                'name' => 'Layout News',
                'path' => 'theme.frontend.page.news',
                'models' => 'MNews'

            ]
        ]);
    }
}
