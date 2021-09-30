<?php

namespace AgenterLab\Uid;

use Illuminate\Support\ServiceProvider;

class UidServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Uid::class, function ($app) {
            return new Uid(
                config('uid.instance_id'), 
                $app->make('cache')->driver(
                    $app['config']->get('uid.store')
                ),
            );
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/uid.php', 'uid');
    }
}