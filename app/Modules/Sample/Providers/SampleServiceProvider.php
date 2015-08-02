<?php
namespace App\Modules\Sample\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class SampleServiceProvider extends ServiceProvider
{
    /**
     * Register the Sample module service provider.
     *
     * @return void
     */
    public function register()
    {
        // This service provider is a convenient place to register your modules
        // services in the IoC container. If you wish, you may make additional
        // methods or service providers to keep the code more focused and granular.
        App::register('App\Modules\Sample\Providers\RouteServiceProvider');

        $this->registerNamespaces();
    }

    /**
     * Register the Sample module resource namespaces.
     *
     * @return void
     */
    protected function registerNamespaces()
    {
        Lang::addNamespace('sample', realpath(__DIR__.'/../Resources/Lang'));

        View::addNamespace('sample', realpath(__DIR__.'/../Resources/Views'));
    }
}
