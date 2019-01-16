<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = ['name' => 'admin', 'display_name' => 'Admin', 'description' => 'Admin role'];
        $role = Role::create($role);
        $permission_data = Permission::get();
        foreach ($permission_data as $key => $value) {
            $role->attachPermission($value);
        }

        $role2 = ['name' => 'moderator', 'display_name' => 'Moderator', 'description' => 'Moderator role'];
        $role2 = Role::create($role2);
        $permission_data2 = Permission::where('id', '<=', 60)->get();
        foreach ($permission_data2 as $key => $value) {
            $role2->attachPermission($value);
        }

        $role3 = ['name' => 'member', 'display_name' => 'Member', 'description' => 'Member role'];
        $role3 = Role::create($role3);
        $permission_data3 = Permission::whereIn('id', [3, 7, 12, 13, 14, 15, 16, 17, 18, 19, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60])->get();
        foreach ($permission_data3 as $key => $value) {
            $role3->attachPermission($value);
        }
    }
}
