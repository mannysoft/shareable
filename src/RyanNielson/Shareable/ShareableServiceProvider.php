<?php namespace RyanNielson\Shareable;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ShareableServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
        //$this->loadViewsFrom(__DIR__.'/views', 'shareable');
        $this->publishes([__DIR__.'/views' => resource_path('views/vendor/shareable'),]);
        //$this->package('ryannielson/shareable');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind('shareable', function($app) {
        //     return new Shareable($app['view']);
        // });
        
        $this->app['shareable'] = $this->app->share(function($app)
		{
			return new Shareable($app['view']);
		});
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['shareable'];
    }
}
