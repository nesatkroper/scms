<?php

namespace App\Providers;

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
  }
}
