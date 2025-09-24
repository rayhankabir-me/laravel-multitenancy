<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Category extends Model
{
    use UsesTenantConnection;
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
    ];

}
