<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $user->email = 'emilioaor@gmail.com';
        $user->name = 'Emilio Ochoa';
        $user->password = bcrypt('123456');

        $user->save();
    }
}
