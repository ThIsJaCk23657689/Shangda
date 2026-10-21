<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Enums\StaffPermission;
use App\Support\StaffPermissions;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        foreach (StaffPermission::cases() as $permission) {
            Gate::define(
                $permission->value,
                fn ($user): bool => StaffPermissions::allows($user, $permission),
            );
        }
    }
}
