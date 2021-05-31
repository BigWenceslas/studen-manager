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
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@enset.cm',
            'password' => '12345678',
            'active'=> 1
        ]);
        $etudiant = User::create([
            'name' => 'larissa',
            'email' => 'ltabit@enset.cm',
            'password' => '12345678',
            'active'=> 1
        ]);
        $admin->assignRole('administrator');
        $etudiant->assignRole('etudiant');
    }
}
