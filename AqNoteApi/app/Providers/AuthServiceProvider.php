<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
      $this->app['auth']->viaRequest('api', function ($request) {
          $valid = DB::table('users')->where('api_key', $request->header('Authorization'))->first();
        if (!(empty($valid))) {
          $key = explode(' ',$request->header('Authorization'));
          $user = DB::table('users')->where('api_key', $key[0])->get();

        return $user;
        }
        });
    }
}
