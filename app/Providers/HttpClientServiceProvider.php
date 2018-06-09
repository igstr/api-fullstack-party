<?php

namespace App\Providers;

use App\Http\Client as HttpClient;
use Illuminate\Support\ServiceProvider;

class HttpClientServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HttpClient::class, function() {
            $config = [
                'base_uri' => env('GITHUB_API_URL'),
                'timeout'  => 5,
            ];
            return new HttpClient($config);
        });
    }
}
