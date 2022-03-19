<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@dashboard.com',
            'password' => Hash::make('password'),
            'role_id'  => Role::find(1)->id,
        ]);
    }
}
