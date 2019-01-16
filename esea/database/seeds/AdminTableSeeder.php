<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MUser;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = ['email' => 'admin@admin.com', 'password' => Hash::make('123456'), 'name' => 'Administrator', 'dob' => '1991-12-23', 'phone' => '0937796986', 'locked' => 0];
        $user = MUser::create($user);
        $user->attachRole(1);

        $user2 = ['email' => 'admin2@admin.com', 'password' => Hash::make('123456'), 'name' => 'Administrator 2', 'dob' => '1991-12-23', 'phone' => '0937796986', 'locked' => 0];
        $user2 = MUser::create($user2);
        $user2->attachRole(1);

        $user3 = ['email' => 'moderator@admin.com', 'password' => Hash::make('123456'), 'name' => 'Moderator', 'dob' => '1991-12-23', 'phone' => '0937796986', 'locked' => 0];
        $user3 = MUser::create($user3);
        $user3->attachRole(2);

        $user4 = ['email' => 'moderator2@admin.com', 'password' => Hash::make('123456'), 'name' => 'Moderator 2', 'dob' => '1991-12-23', 'phone' => '0937796986', 'locked' => 0];
        $user4 = MUser::create($user4);
        $user4->attachRole(2);

        $user5 = ['email' => 'member@admin.com', 'password' => Hash::make('123456'), 'name' => 'Member', 'dob' => '1991-12-23', 'phone' => '0937796986', 'locked' => 0];
        $user5 = MUser::create($user5);
        $user5->attachRole(3);

        $user6 = ['email' => 'member2@admin.com', 'password' => Hash::make('123456'), 'name' => 'Member 2', 'dob' => '1991-12-23', 'phone' => '0937796986', 'locked' => 0];
        $user6 = MUser::create($user6);
        $user6->attachRole(3);
    }
}
