<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();

    Gate::define('Product Categories', function ($user) {
      return $user->hasAnyPermission([
        'PC Show',
        'PC Create',
        'PC Update',
        'PC Delete'
      ]);
    });

    Gate::define('Product', function ($user) {
      return $user->hasAnyPermission([
        'P Show',
        'P Create',
        'P Update',
        'P Delete'
      ]);
    });

    Gate::define('Report Stock', function ($user) {
      return $user->hasAnyPermission([
        'RS Show',
        'RS Create',
        'RS Update',
        'RS Delete'
      ]);
    });

    Gate::define('Report Transaction', function ($user) {
      return $user->hasAnyPermission([
        'RT Show',
        'RT Create',
        'RT Update',
        'RT Delete'
      ]);
    });

    Gate::define('Receive', function ($user) {
      return $user->hasAnyPermission([
        'R Show',
        'R Create',
        'R Update',
        'R Delete'
      ]);
    });

    Gate::define('Transaction', function ($user) {
      return $user->hasAnyPermission([
        'T Show',
        'T Create',
        'T Update',
        'T Delete'
      ]);
    });

    Gate::define('Manage Meta', function ($user) {
      return $user->hasAnyPermission([
        'Meta Show',
        'Meta Create',
        'Meta Update',
        'Meta Delete'
      ]);
    });

    Gate::define('Manage Users', function ($user) {
      return $user->hasAnyPermission([
        'User Show',
        'User Create',
        'User Update',
        'User Delete'
      ]);
    });

    Gate::define('Manage Roles', function ($user) {
      return $user->hasAnyPermission([
        'Role Show',
        'Role Create',
        'Role Update',
        'Role Delete'
      ]);
    });
  }
}
