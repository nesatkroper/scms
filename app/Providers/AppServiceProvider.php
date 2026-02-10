<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\StudentObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
  public function register(): void {}

  public function boot(): void
  {
    if (app()->environment('production')) {
      URL::forceScheme('https');
    }

    Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    
    // Register StudentObserver for automatic cache invalidation
    User::observe(StudentObserver::class);
  }
}
