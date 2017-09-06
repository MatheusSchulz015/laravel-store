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
        //
        User::create([
        	'name' => 'Matheus Souza',
        	'email' => 'matheus.kruzsouza@gmail.com',
        	'password' => bcrypt('05092013'),
        	]);
    }
}
