<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

Artisan::command('permissions:setup', function () {
    $allPermissions = [
        // custom tenant change permissions
        'choose_tenant',
        // Tenant | Team Member | Roles permissions
        'tenant-browse',
        'tenant-read',
        'tenant-edit',
        'tenant-add',
        'tenant-delete',
        // ----------------
        'team-browse',
        'team-read',
        'team-edit',
        'team-add',
        'team-delete',
        // --------------------
        'role-browse',
        'role-read',
        'role-edit',
        'role-add',
        'role-delete',

        // blog-category | blog permissions
        'blog_category-browse',
        'blog_category-read',
        'blog_category-edit',
        'blog_category-add',
        'blog_category-delete',
        // ---------
        'blog-browse',
        'blog-read',
        'blog-edit',
        'blog-add',
        'blog-delete',

        // brand | category | options | option_value | product Permissions
        'brand-browse',
        'brand-read',
        'brand-edit',
        'brand-add',
        'brand-delete',
        // -----------------
        'category-browse',
        'category-read',
        'category-edit',
        'category-add',
        'category-delete',
        // -----------------
        'options-browse',
        'options-read',
        'options-edit',
        'options-add',
        'options-delete',
        // -----------------
        'option_value-browse',
        'option_value-read',
        'option_value-edit',
        'option_value-add',
        'option_value-delete',
        // -----------------
        'product-browse',
        'product-read',
        'product-edit',
        'product-add',
        'product-delete',
        // -----------------

        // global | general | seo | email Permissions
        'global-setting',
        'general-setting',
        'seo-setting',
        'email-setting',

    ];
    // Clear cache to avoid permission cache issues
    app()[PermissionRegistrar::class]->forgetCachedPermissions();
    // Delete all related records in model_has_permissions and model_has_roles
    DB::table('model_has_permissions')->delete();
    DB::table('model_has_roles')->delete();
    DB::table('role_has_permissions')->delete();
    // Delete all permissions and roles
    Permission::query()->delete();
    Role::query()->delete();
    // Reset auto-increment values
    DB::statement('ALTER TABLE permissions AUTO_INCREMENT = 1');
    DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1');
    // Recreate all permissions
    foreach ($allPermissions as $permission) {
        Permission::create(['name' => $permission, 'guard_name' => 'admin']);
    }
    // Create superadmin role and assign all permissions
    $superadminRole = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);
    $superadminRole->syncPermissions(Permission::all());
    // Assign the 'superadmin' role to the user with ID 73 (example user)
    $user = Admin::find(1); // Replace with the actual user ID
    if ($user) {
        $user->assignRole('superadmin');
        $this->info('User assigned the superadmin role successfully.');
    } else {
        $this->error('Admin not found.');
    }
    $this->info('Roles and permissions have been set up successfully.');
})->describe('Setup roles and permissions for the application');
