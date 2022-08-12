<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'  => 'Admin',
                'email' => 'aisadmin@gmail.com',
                'password' => Hash::make('ais1234'),
                'role' => 'admin'
            ],
            [
                'name'  => 'Shumaru Corp.',
                'email' => 'companyais@gmail.com',
                'password' => Hash::make('ais1234'),
                'role' => 'owner'
            ],
            
        ];

        User::insert($users);
    }
}
