<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::where('name', 'admin')->firstOrFail();
        User::create([
            'nom' => 'Adminstrateur',
            'prenom' => 'admin',
            'contact' => '00000000',
            'login' => 'admin',
            'email' => 'admin@admin.com',
            'role_id' => $roles->id,
            'password' => bcrypt('P@ss0rd225@#'),
            'agence_id' => 1
        ]);
    }
}
