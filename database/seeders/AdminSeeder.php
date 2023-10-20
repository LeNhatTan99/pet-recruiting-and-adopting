<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'first_name' => 'test',
                'last_name' => 'admin',
                'phone_number' => '0123456789',
                'password' => '123123123'
            ]
        ];
        foreach ($datas as $key => $data) {
            DB::table('admins')->insert([
                [                   
                    "username" => $data['username'],
                    "email" => $data['email'],
                    "first_name" => $data['first_name'],
                    "last_name" => $data['last_name'],
                    "phone_number" => $data['phone_number'],
                    "password" => Hash::make($data['password'])
                ],
            ]);
        }
    }
}
