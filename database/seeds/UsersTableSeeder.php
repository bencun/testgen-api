<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Admin",
            'password' => password_hash('pass123', PASSWORD_DEFAULT),
            'details' => "This is the admin user.",
            'admin' => true
        ]);
        User::create([
            'name' => "User",
            'password' => password_hash('pass123', PASSWORD_DEFAULT),
            'details' => "This is a regular user.",
            'admin' => false,
            'tests' => [
                'id' => 1
            ]
        ]);
    }
}
