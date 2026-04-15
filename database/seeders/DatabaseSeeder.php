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
        $tenants = [
            [
                'id'     => 1,
                'name'   => 'Cost2Cost Supplement',
                'domain' => 'https://cost2costsupplement.com',
                'notes'  => 'Main Default Tenant',
                'status' => 'active'
            ],
            [
                'id'     => 2,
                'name'   => 'Earthmaa Foods',
                'domain' => 'https://earthmaafoods.com',
                'notes'  => 'Earthmaa foods Tenant',
                'status' => 'active'
            ],
            [
                'id'     => 3,
                'name'   => 'Promolecules Limited',
                'domain' => 'https://promolecules.com',
                'notes'  => 'Promolecules Tenant',
                'status' => 'active'
            ],
            [
                'id'     => 4,
                'name'   => 'Grainly Foods Limited',
                'domain' => 'https://grainly-foods.com',
                'notes'  => 'Grainly Foods Tenant',
                'status' => 'active'
            ],
        ];

        foreach ($tenants as $tenant) {
            Tenant::updateOrInsert(['id' => $tenant['id']], array_merge($tenant, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
        // setting data seeder
        Setting::create([
            'option' => 'project_name',
            'value' => 'Magnus',
            'tenant_id' => 0,
        ]);
    }
}
