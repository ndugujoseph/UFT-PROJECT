<?php

namespace App\Providers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Payments
        Gate::define('payment_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: agents
        Gate::define('agents_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('agents_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('agents_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('agents_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('agents_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Well Wishers
        Gate::define('well_wishers_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('well_wishers_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('well_wishers_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('well_wishers_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('well_wishers_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: agent_head_payment
        Gate::define('agent_head_payment_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('agent_head_payment_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('agent_head_payment_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('agent_head_payment_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('agent_head_payment_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: agent_payments
        Gate::define('agent_payments_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('agent_payments_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('agent_payments_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('agent_payments_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('agent_payments_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: total_payment
        Gate::define('total_payment_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('total_payment_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('total_payment_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('total_payment_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('total_payment_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: districts
        Gate::define('districts_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('districts_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('districts_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('districts_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('districts_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: members
        Gate::define('members_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('members_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('members_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('members_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('members_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Tresuary
        Gate::define('tresuary_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('tresuary_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('tresuary_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('tresuary_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('tresuary_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Admin payment
        Gate::define('admin_payment_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('admin_payment_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('admin_payment_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('admin_payment_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('admin_payment_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Uft charts
        Gate::define('uft_chart_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('uft_chart_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('uft_chart_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('uft_chart_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('uft_chart_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
