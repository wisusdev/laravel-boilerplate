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
            // Blog Permision
            'blog.index',
            'blog.create',
            'blog.show',
            'blog.edit',
            'blog.delete',
            // Page Permision
            'page.index',
            'page.create',
            'page.show',
            'page.edit',
            'page.delete',
            // Category Permision
            'category.index',
            'category.create',
            'category.show',
            'category.edit',
            'category.delete',
            // Menu Permision
            'menu.index',
            'menu.create',
            'menu.show',
            'menu.edit',
            'menu.delete',
            // Media Permision
            'media.index',
            'media.create',
            'media.show',
            'media.edit',
            'media.delete',
            // Setting Permision
            'setting.index',
            'setting.create',
            'setting.show',
            'setting.edit',
            'setting.delete',
            // Themes Permision
            'theme.index',
            'theme.create',
            'theme.show',
            'theme.edit',
            'theme.delete',
            // Addons Permision
            'addons.index',
            'addons.create',
            'addons.show',
            'addons.edit',
            'addons.delete',
            // Users Permision
            'users.index',
            'users.create',
            'users.show',
            'users.edit',
            'users.delete',

            // Comments Permision
            'comment.index',
            'comment.create',
            'comment.show',
            'comment.edit',
            'comment.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
