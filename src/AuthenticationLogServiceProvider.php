<?php

namespace Yadahan\AuthenticationLog;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

class AuthenticationLogServiceProvider extends ServiceProvider
{
    use EventMap;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerEvents();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'authentication-log');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'authentication-log');

        $this->mergeConfigFrom(__DIR__.'/../config/authentication-log.php', 'authentication-log');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'authentication-log-migrations');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/authentication-log'),
            ], 'authentication-log-views');

            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/authentication-log'),
            ], 'authentication-log-translations');

            $this->publishes([
                __DIR__.'/../config/authentication-log.php' => config_path('authentication-log.php'),
            ], 'authentication-log-config');
        }
    }

    /**
     * Register the Authentication Log's events.
     *
     * @return void
     */
    protected function registerEvents()
    {
        $events = $this->app->make(Dispatcher::class);

        foreach ($this->events as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\ClearCommand::class,
            ]);
        }
    }
}
