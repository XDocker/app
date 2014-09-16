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

use Illuminate\Foundation\AliasLoader;
use Illuminate\Config\Repository as ConfigRepository;
use Symfony\Component\Console\Output\OutputInterface;

class Generator
{
    /** @var \Illuminate\Config\Repository */
    protected $config;

    /** @var \Illuminate\View\Factory */
    protected $view;

    /** @var \Symfony\Component\Console\Output\OutputInterface */
    protected $output;

    protected $extra = array();
    protected $magic = array();
    protected $interfaces = array();
    protected $helpers;

    /**
     * @param \Illuminate\Config\Repository $config
     * @param \Illuminate\View\Factory $view
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param string $helpers
     */
    public function __construct(ConfigRepository $config,
        /* Illuminate\View\Factory */ $view,
        OutputInterface $output = null,
        $helpers = ''
    ) {
        $this->config = $config;
        $this->view = $view;

        // Find the drivers to add to the extra/interfaces
        $this->detectDrivers();

        $this->extra = array_merge($this->extra, $this->config->get('laravel-ide-helper::extra'));
        $this->magic = array_merge($this->magic, $this->config->get('laravel-ide-helper::magic'));
        $this->interfaces = array_merge($this->interfaces, $this->config->get('laravel-ide-helper::interfaces'));
        $this->helpers = $helpers;
    }

    /**
     * Generate the helper file contents;
     *
     * @param  string  $format  The format to generate the helper in (php/json)
     * @return string;
     */
    public function generate($format = 'php')
    {
        // Check if the generator for this format exists
        $method = 'generate'.ucfirst($format).'Helper';
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        return $this->generatePhpHelper();
    }

    public function generatePhpHelper()
    {
        $app = app();
        return $this->view->make('laravel-ide-helper::ide-helper')
            ->with('namespaces', $this->getNamespaces())
            ->with('helpers', $this->helpers)
            ->with('version', $app::VERSION)
            ->render();
    }

    public function generateJsonHelper()
    {
        $classes = array();
        foreach ($this->getNamespaces() as $aliases) {
            foreach($aliases as $alias) {
                $functions = array();
                foreach ($alias->getMethods() as $method) {
                    $functions[$method->getName()] = '('. $method->getParamsWithDefault().')';
                }
                $classes[$alias->getAlias()] = array(
                    'functions' => $functions,
                );
            }
        }

        $flags = JSON_FORCE_OBJECT;
        if (defined('JSON_PRETTY_PRINT')) {
            $flags |= JSON_PRETTY_PRINT;
        }

        return json_encode(array(
            'php' => array(
                'classes' => $classes,
            ),
        ), $flags);
    }

    protected function detectDrivers()
    {
        try{
            if (class_exists('Auth')) {
                $class = get_class(\Auth::driver());
                $this->extra['Auth'] = array($class);
                $this->interfaces['\Illuminate\Auth\UserProviderInterface'] = $class;
            }
        }catch (\Exception $e) {}

        try{
            if (class_exists('DB')) {
                $class = get_class(\DB::connection());
                $this->extra['DB'] = array($class);
                $this->interfaces['\Illuminate\Database\ConnectionInterface'] = $class;
            }
        }catch (\Exception $e) {}

        try{
            if (class_exists('Cache')) {
                $driver = get_class(\Cache::driver());
                $store = get_class(\Cache::getStore());
                $this->extra['Cache'] = array($driver, $store);
                $this->interfaces['\Illuminate\Cache\StoreInterface'] = $store;
            }
        }catch (\Exception $e) {}

        try{
            if (class_exists('Queue')) {
                $class = get_class(\Queue::connection());
                $this->extra['Queue'] = array($class);
                $this->interfaces['\Illuminate\Queue\QueueInterface'] = $class;
            }
        }catch (\Exception $e) {}

        try{
            if (class_exists('SSH')){
                $class = get_class(\SSH::connection());
                $this->extra['SSH'] = array($class);
                $this->interfaces['\Illuminate\Remote\ConnectionInterface'] = $class;
            }
        }catch (\Exception $e) {}

        // Make all interface classes absolute
        foreach ($this->interfaces as &$interface) {
            $interface = '\\' . ltrim($interface, '\\');
        }
    }

    /**
     * Find all namespaces/aliases that are valid for us to render
     *
     * @return array
     */
    protected function getNamespaces()
    {
        $namespaces = array();

        // Get all aliases
        foreach (AliasLoader::getInstance()->getAliases() as $name => $facade) {
            $magicMethods = array_key_exists($name, $this->magic) ? $this->magic[$name] : array();
            $alias = new Alias($name, $facade, $magicMethods, $this->interfaces);
            if ($alias->isValid()) {

                //Add extra methods, from other classes (magic static calls)
                if (array_key_exists($name, $this->extra)) {
                    $alias->addClass($this->extra[$name]);
                }

                $namespace = $alias->getNamespace();
                if (!isset($namespaces[$namespace])) {
                    $namespaces[$namespace] = array();
                }
                $namespaces[$namespace][] = $alias;
            }

        }

        return $namespaces;
    }

    /**
     * Get the driver/connection/store from the managers
     *
     * @param $alias
     * @return array|bool|string
     */
    public function getDriver($alias)
    {
        try {
            if ($alias == "Auth") {
                $driver = \Auth::driver();
            } elseif ($alias == "DB") {
                $driver = \DB::connection();
            } elseif ($alias == "Cache") {
                $driver = get_class(\Cache::driver());
                $store = get_class(\Cache::getStore());
                return array($driver, $store);
            } elseif ($alias == "Queue") {
                $driver = \Queue::connection();
            } else {
                return false;
            }

            return get_class($driver);
        } catch (\Exception $e) {
            $this->error("Could not determine driver/connection for $alias.");
            return false;
        }
    }

    /**
     * Write a string as error output.
     *
     * @param  string  $string
     * @return void
     */
    protected function error($string)
    {
        if($this->output){
            $this->output->writeln("<error>$string</error>");
        }else{
            echo $string . "\r\n";
        }
    }
}
