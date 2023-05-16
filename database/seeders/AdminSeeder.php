<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Hamza',
            'email' => 'test@gmail.com',
            'isAdmin' => true,
            'password' => Hash::make('password')
        ]);
    }
}
