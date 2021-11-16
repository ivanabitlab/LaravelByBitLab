<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user= User::create([
            'name' => 'Admin User',
            'username' => 'administrator',
            'email' => 'admin@cms.com',
            'password' => '1111111' // mozemo ovako jer u modelu User imamo setPasswordAttribute metodu, inace bi ovde moralo hashovanje
        ]);

        $user->assignRole('admin');
    }
}
