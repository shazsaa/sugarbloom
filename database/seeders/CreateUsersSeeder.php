<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
               'name'=>'Admin User',
               'email'=>'admin@example.com',
               'type'=>1,
               'password'=> bcrypt('12345'),
            ],
            [
               'name'=>'User',
               'email'=>'user@example.com',
               'type'=>0,
               'password'=> bcrypt('12345'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
