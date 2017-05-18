<?php
declare(strict_types=1);

namespace FreezyBee\PrependRoute\DI;

/**
 * @author Jakub Janata <jakubjanata@gmail.com>
 */
interface IPrependRouteProvider
{
    /**
     * Return array of services - service MUST implements IRoute
     * @return string[]
     */
    public function getPrependRoutes(): array;
}
