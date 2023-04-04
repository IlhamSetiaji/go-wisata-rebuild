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
                'name' => 'admin-city',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin-tour',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin-culinary',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin-hotel',
                'guard_name' => 'web',
            ],
            [
                'name' => 'customer',
                'guard_name' => 'web',
            ],
        ])->each(function ($role) {
            $role = \Spatie\Permission\Models\Role::create($role);
            $user = [
                'name' => ucwords(str_replace('-', ' ', $role->name)),
                'email' => $role->name . '@test.test',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ];
            switch ($role->name) {
                case 'admin':
                    $user['parent_id'] = null;
                    break;
                case 'admin-city':
                    $user['parent_id'] = 1;
                    break;
                case 'admin-tour':
                    $user['parent_id'] = 2;
                    break;
                case 'admin-culinary':
                    $user['parent_id'] = 3;
                    break;
                case 'admin-hotel':
                    $user['parent_id'] = 4;
                    break;
                default:
                    break;
            }
            $user = \App\Models\User::create($user);
            $user->assignRole($role);
        });
    }
}
