<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
           'editor',
           'subscriber',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $role = Role::create(['name' => 'admin']);
        
        $role->givePermissionTo(Permission::all());
    }
}
