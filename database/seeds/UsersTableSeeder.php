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
            'name' => 'Carlos Ferreira',
            'email' => 'c@c.com',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'name' => 'Outro usuario',
            'email' => 'o@o.com',
            'password' => bcrypt('123456')
        ]);
    }
}
