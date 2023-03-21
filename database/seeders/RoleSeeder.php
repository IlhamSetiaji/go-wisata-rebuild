<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'wisata',
                'guard_name' => 'web',
            ],
            [
                'name' => 'kuliner',
                'guard_name' => 'web',
            ],
            [
                'name' => 'penginapan',
                'guard_name' => 'web',
            ],
            [
                'name' => 'pelanggan',
                'guard_name' => 'web',
            ],
        ])->each(function ($role) {
            $role = \Spatie\Permission\Models\Role::create($role);
            $user = [
                'name' => $role->name,
                'email' => $role->name . '@test.test',
                'password' => Hash::make('password'),
            ];
            $user = \App\Models\User::create($user);
            $user->assignRole($role);
        });
    }
}
