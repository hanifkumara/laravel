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
            'name' => 'Hanif Kumara',
            'username' => 'hanifkumara',
            'password' => bcrypt('hanifkumara'),
            'email' => 'hanifkumara00@gmail.com'
        ]);
    }
}
