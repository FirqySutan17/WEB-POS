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

    Gate::define('Manage Portfolio', function ($user) {
      return $user->hasAnyPermission([
        'Portfolio Show',
        'Portfolio Create',
        'Portfolio Update',
        'Portfolio Delete'
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

    Gate::define('Manage Skill', function ($user) {
      return $user->hasAnyPermission([
        'Skill Show',
        'Skill Create',
        'Skill Update',
        'Skill Delete'
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
