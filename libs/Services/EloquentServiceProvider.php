<?php


namespace Libs\Services;


use Illuminate\Database\Capsule\Manager;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class EloquentServiceProvider implements ServiceProviderInterface
{

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */

    private $settings = [];

    public function register(Container $container)
    {
        if (false === $container->offsetGet('settings')->has('eloquent')) {
            throw new \InvalidArgumentException('Database configuration not found');
        }

        $container['settings']->set('eloquent', array_merge_recursive(
            $this->settings,
            $container->offsetGet('settings')->get('eloquent')
        ));

        $config = $container['settings']['eloquent'];
        $capsule = new Manager();
        $capsule->addConnection([
            'driver'    => $config['driver'],
            'host'      => $config['host'],
            'database'  => $config['database'],
            'username'  => $config['username'],
            'password'  => $config['password'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $container['eloquent'] = function ($c) use ($capsule) {
            return $capsule;
        };
    }
}
