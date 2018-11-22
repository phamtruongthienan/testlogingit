<?php

use Illuminate\Database\Seeder;
// use App\Model\rolesModel;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
                // 'rolename' => 'admin','description' => 'quyen admin'
                'rolename' => 'customer','description' => 'quyen nguoi dung'
        ]);
        // rolesModel::create($data);

    }

}
