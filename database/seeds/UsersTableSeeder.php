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
            'name' => 'Paulo Mendes Silva',
            'email' => 'paulomendesdigital@gmail.com',
            'password' => bcrypt('mendes2paulo')
        ]);
    }
}
