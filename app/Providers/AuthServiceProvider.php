<?php

namespace App\Providers;

use App\Model\UserMapper;
use Illuminate\Support\ServiceProvider;
use Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            $userMapper = $this->app->make(UserMapper::class);
            if ($token = $request->input('access_token')) {
                try {
                    $user = $userMapper->fetchByToken($token);
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                    return;
                }

                return $user;
            }
        });
    }
}
