<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        Role::create([
            'name' => 'admin'
        ]);
        
        Role::create([
            'name' => 'doctor'
        ]);
        
        Role::create([
            'name' => 'patient'
        ]);

        User::create([
            'name' => 'John',
            'email' => 'john.paul.casey@test.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);
        User::create([
            'name' => 'Jade',
            'email' => 'jade.houng@test.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
            'gender' => 'female',
            'address' => '31 lorikee',
            
        ]);
        User::create([
            'name' => 'Mike',
            'email' => 'mike.doe@test.com',
            'password' => Hash::make('password'),
            'role_id' => 3
        ]);
    }
}
