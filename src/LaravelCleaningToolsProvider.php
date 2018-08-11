<?php

namespace Newexe\LaravelCleaningTools;

use Newexe\LaravelCleaningTools\Commands\ClearAllCachedData;
use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelCleaningToolsProvider
 * @package Newexe\LaravelCleaningTools
 */
class LaravelCleaningToolsProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ClearAllCachedData::class
            ]);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
