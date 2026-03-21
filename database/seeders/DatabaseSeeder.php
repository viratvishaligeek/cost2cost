<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Setting;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // admin data seeder
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'phone' => '8888888888',
            'password' => 'qwerty',
            'tenant_id' => 1,
        ]);

        // tenant data seeder
        Tenant::create([
            'name' => 'Cost2Cost Suppliment',
            'domain' => 'https://cost2costsupplement.com',
            'notes' => 'Main Default Tenant',
            'status' => 'active'
        ]);

        // setting data seeder
        Setting::create([
            'option' => 'project_name',
            'value' => 'Magnus',
            'tenant_id' => 0,
        ]);
    }
}
