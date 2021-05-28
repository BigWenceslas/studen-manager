<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@enset.cm',
            'password' => '12345678',
            'active'=> 1
        ]);
        $user = User::create([
            'name' => 'larissa',
            'email' => 'ltabit@enset.cm',
            'password' => '12345678',
            'active'=> 1
        ]);
        $user->assignRole('administrator');
    }
}
