<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           // Create the SuperAdmin role
           Role::create(['name' => 'SuperAdmin']);
           Role::create(['name' => 'Agent']);
           Role::create(['name' => 'Employee']);
           Role::create(['name' => 'Member']);
           Role::create(['name' => 'Promoter']);
           Role::create(['name' => 'Director']);
           $user = User::find(1); // Assuming the first user is the SuperAdmin
           $role = Role::where('name', 'SuperAdmin')->first();
           
           if ($user && $role) {
               $user->assignRole($role);
           }
    }
}
