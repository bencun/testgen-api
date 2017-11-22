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
            'name' => "Jane.Doe",
            'password' => password_hash('pass123', PASSWORD_DEFAULT),
            'details' => "This user is an administrator.",
            'admin' => true
        ]);
        User::create([
            'name' => "John.Doe",
            'password' => password_hash('pass123', PASSWORD_DEFAULT),
            'details' => "This is a regular user with a test assigned to them.",
            'admin' => false,
            'tests' => [
                ['id' => 1],
                ['id' => 2]
            ]
        ]);

        User::create([
            'name' => "Mike.Anderson",
            'password' => password_hash('pass123', PASSWORD_DEFAULT),
            'details' => "This is a regular user with no tests assigned to them.",
            'admin' => false,
            'tests' => []
        ]);
    }
}
