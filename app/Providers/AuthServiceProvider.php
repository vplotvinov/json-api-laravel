<?php

namespace App\Providers;

use App\Models\CommentModel;
use App\Models\EntityModel;
use App\Models\SubscriptionsModel;
use App\Models\UserModel;
use App\Policies\CommentPolicy;
use App\Policies\EntityPolicy;
use App\Policies\SubscriptionsPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        UserModel::class          => UserPolicy::class,
        EntityModel::class        => EntityPolicy::class,
        CommentModel::class       => CommentPolicy::class,
        SubscriptionsModel::class => SubscriptionsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::personalAccessClientId('1'); // TODO: Need improve auth API flow
    }
}
