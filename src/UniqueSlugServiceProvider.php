<?php

namespace VitorLeonel\UniqueSlug;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

/**
* UniqueSlugServiceProvider class.
*/
class UniqueSlugServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the applicatin services.
     *
     */
    public function boot()
    {
    	//
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    	$this->app->singleton(UniqueSlug::class, function () {
            return new UniqueSlug;
        });

        $this->app->alias(UniqueSlug::class, 'UniqueSlug');
    }
}