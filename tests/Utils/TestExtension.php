<?php
declare(strict_types=1);

namespace FreezyBee\PrependRoute\Tests\Utils;

use FreezyBee\PrependRoute\DI\IPrependRouteProvider;
use Nette\Application\Routers\Route;
use Nette\DI\CompilerExtension;

/**
 * @author Jakub Janata <jakubjanata@gmail.com>
 */
class TestExtension extends CompilerExtension implements IPrependRouteProvider
{
    public function loadConfiguration(): void
    {
        $this->getContainerBuilder()
            ->addDefinition($this->prefix('testRoute'))
            ->setFactory(Route::class, ['prepend-path', 'PrependTest:someAction'])
            ->setAutowired(false);
    }

    /**
     * {@inheritdoc}
     */
    public function getPrependRoutes(): array
    {
        return [$this->prefix('testRoute'), $this->prefix('testRoute')];
    }
}
