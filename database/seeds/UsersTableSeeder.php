<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Model\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            //    'username' => 'admin','password' => hash::make('123456'),'raw_password' => '123456','status' => 1,
                // 'username' => 'thienan','password' => hash::make('456456'),'raw_password' => '456456','status' => 1,
                'username' => 'abc123','password' => hash::make('456789'),'raw_password' => '456789','status' => 0

        ];
        User::create($data);
      
    }
}

