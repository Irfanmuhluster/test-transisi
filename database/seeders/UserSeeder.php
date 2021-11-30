<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        //
        User::create([
            'name' => 'Admin',
            'email'  => 'admin@transisi.id',
            'password' => Hash::make('transisi'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
