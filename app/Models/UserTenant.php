<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTenant extends Model
{
    protected $table = 'user_tenant';

    protected $fillable = [
        'user_id',
        'tenant_id',
    ];
}
