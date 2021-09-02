<?php

declare(strict_types=1);

namespace FreezyBee\PrependRoute\Tests\Utils;

use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\Routing\Router;
use Nette\StaticClass;

/**
 * @author Jakub Janata <jakubjanata@gmail.com>
 */
class RouterFactory
{
    use StaticClass;

    /**
     * @return RouteList<Router>
     */
    public static function createRouter(): RouteList
    {
        $router = new RouteList();
        $router[] = new Route('[<presenter>][/<action=default>]', 'Test:');
        return $router;
    }
}
