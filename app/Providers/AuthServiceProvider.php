<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('edit-article', function (Admin $admin, Article $article) {
            return $admin->id === $article->admin_id ? Response::allow() : Response::denyAsNotFound();
        });
    }
}
