<?php
namespace App\Models;
;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Multitenancy\Models\Tenant;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class PosTenant extends Tenant
{
    protected $fillable = ['name', 'domain', 'database'];

    protected static function booted()
    {
        static::created(function (PosTenant $tenant) {
            $tenant->createDatabase();
        });
    }

    public function createDatabase()
    {
        // 1) Generate a unique database name based on tenant ID
        $dbName = 'tenant_' . $this->id . '_db';

        // 2) Create the database (MySQL example)
        DB::connection('landlord')->statement("
            CREATE DATABASE IF NOT EXISTS `$dbName`
            CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
        ");

        // 3) Save the database name into this tenant’s row
        $this->database = $dbName;
        $this->saveQuietly();

        // 4) Run migrations for this tenant
        Artisan::call('tenants:artisan', [
            'artisanCommand' => 'migrate --database=tenant',
        ]);

        // 5) (Optional) Seed the tenant DB
        // Artisan::call('tenants:artisan', [
        //     'artisanCommand' => "db:seed --database=tenant",
        // ]);
    }


    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_tenant', 'tenant_id', 'user_id');
    }
}