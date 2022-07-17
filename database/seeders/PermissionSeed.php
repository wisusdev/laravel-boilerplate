<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
			// Env
			'env.index',
			'env.edit',
			// Addons Permision
			'addons.index',
			'addons.create',
			'addons.show',
			'addons.edit',
			'addons.delete',
			'addons.download',
			'addons.migrate',
            // Roles Permision
            'role.index',
            'role.create',
            'role.show',
            'role.edit',
            'role.delete',
            // Permissions Permision
            'permission.index',
            'permission.create',
            'permission.show',
            'permission.edit',
            'permission.delete',
            // Setting Permision
            'setting.index',
            'setting.create',
            'setting.show',
            'setting.edit',
            'setting.delete',
            // Users Permision
            'users.index',
            'users.create',
            'users.show',
            'users.edit',
            'users.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
