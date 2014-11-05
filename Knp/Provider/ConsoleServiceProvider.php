<?php

namespace Knp\Provider;

//use Silex\ServiceProviderInterface;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;

use Knp\Console\Application as ConsoleApplication;
use Knp\Console\ConsoleEvents;
use Knp\Console\ConsoleEvent;

class ConsoleServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['console'] = function () use ($container) {
            $application = new ConsoleApplication(
                $container,
                $container['console.project_directory'],
                $container['console.name'],
                $container['console.version']
            );

            $container['dispatcher']->dispatch(ConsoleEvents::INIT, new ConsoleEvent($application));

            return $application;
        };
    }

    public function boot(Application $app)
    {
    }
}
