<?php

use Illuminate\Database\Seeder;
use App\Model\decentralizationModel;
class DecentralizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('decentralization')->insert([
            // 'rolename' => 'admin','description' => 'quyen admin'
            // ['id_user' => '1','id_role' => '1'],
            // ['id_user' => '2','id_role' => '2'],
            ['id_user' => '3','id_role' => '2']
    ]);
    }
}
