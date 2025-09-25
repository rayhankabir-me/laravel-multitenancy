<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Multitenancy\Models\Tenant;

class AuthorizeTenantAccess
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $tenant = Tenant::current(); // current tenant resolved by Spatie

        if (! $tenant) {
            abort(404, 'No tenant found.');
        }

        // Check if logged-in user belongs to this tenant
        if (! $user || ! $user->tenants->contains($tenant->id)) {
            abort(403, 'You do not have access to this tenant.');
        }

        return $next($request);
    }
}
