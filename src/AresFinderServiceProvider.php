<?php

namespace Pixiucz\AresFinder;

use Illuminate\Support\ServiceProvider;

class AresFinderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Nathanmac\Utilities\Parser\ParserServiceProvider::class);
        $this->app->bind('AresFinder', function() {
            return new \Pixiucz\AresFinder\AresFinder();
        });
        $this->app->bind('AresParser', function () {
            return new \Pixiucz\AresFinder\Core\Parser();
        });
    }
}
