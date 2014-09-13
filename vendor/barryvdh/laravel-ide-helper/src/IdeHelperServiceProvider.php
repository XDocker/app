<?php
/**
 * Laravel IDE Helper Generator
 *
 * @author    Barry vd. Heuvel <barryvdh@gmail.com>
 * @copyright 2014 Barry vd. Heuvel / Fruitcake Studio (http://www.fruitcakestudio.nl)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/barryvdh/laravel-ide-helper
 */

namespace Barryvdh\LaravelIdeHelper;

use Illuminate\Support\ServiceProvider;
use Barryvdh\LaravelIdeHelper\Console\GeneratorCommand;
use Barryvdh\LaravelIdeHelper\Console\Generator2Command;
Use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;

class IdeHelperServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('barryvdh/laravel-ide-helper', 'laravel-ide-helper', __DIR__);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['command.ide-helper.generate'] = $this->app->share(
            function ($app) {
                return new GeneratorCommand($app['config'], $app['files'], $app['view']);
            }
        );

        $this->app['command.ide-helper.models'] = $this->app->share(
            function () {
                return new ModelsCommand();
            }
        );

        $this->commands('command.ide-helper.generate', 'command.ide-helper.models');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('command.ide-helper.generate', 'command.ide-helper.models');
    }

}
