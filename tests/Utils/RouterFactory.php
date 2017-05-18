<?php
declare(strict_types=1);

namespace FreezyBee\PrependRoute\Tests\Utils;

use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\StaticClass;

/**
 * @author Jakub Janata <jakubjanata@gmail.com>
 */
class RouterFactory
{
    use StaticClass;

    /**
     * @return IRouter
     */
    public static function createRouter(): IRouter
    {
        $router = new RouteList;
        $router[] = new Route('[<presenter>][/<action=default>]', 'Test:');
        return $router;
    }
}
