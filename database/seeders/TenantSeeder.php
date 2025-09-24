<?php

namespace Database\Seeders;

use App\Models\PosTenant;
use App\Models\UserTenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            [
                'name' => 'Bata',
                'domain' => 'bata.localhost',
            ],
            [
                'name' => 'Easy',
                'domain' => 'easy.localhost',
            ],
        ];

        foreach ($tenants as $tenantData) {
            PosTenant::create($tenantData);
        }

        UserTenant::create([
            'user_id' => 1,
            'tenant_id' => 1,
        ]);
        
        UserTenant::create([
            'user_id' => 2,
            'tenant_id' => 2,
        ]);

    }
}
