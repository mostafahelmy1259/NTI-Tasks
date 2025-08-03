<?php

namespace App\Providers;

use App\Models\Article;
use App\Policies\ArticlePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    // Register the Article policy
    protected $policies = [
        \App\Models\Article::class => \App\Policies\ArticlePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}

