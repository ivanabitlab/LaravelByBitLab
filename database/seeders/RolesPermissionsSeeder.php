<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'edit categories']);

        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $author = Role::create(['name' => 'author']);

        $admin->givePermissionTo(['create posts','edit posts','edit users','edit categories']);
        $editor->givePermissionTo(['create posts','edit posts']);
        $author->givePermissionTo(['create posts']);
    }
}
