<?php
declare(strict_types=1);

namespace FreezyBee\PrependRoute\Tests\Integration;

require __DIR__ . '/../bootstrap.php';

use Nette\Application\IRouter;
use Nette\Configurator;
use Nette\Http\Request;
use Nette\Http\UrlScript;
use Tester\Assert;
use Tester\TestCase;

/**
 * @testCase
 */
class PrependTest extends TestCase
{
    /**
     *
     */
    public function testInit(): void
    {
        $configurator = new Configurator;
        $configurator->setTempDirectory(__DIR__ . '/../tmp');
        $configurator->addConfig(__DIR__ . '/../config.neon');
        $container = $configurator->createContainer();

        /** @var IRouter $router */
        $router = $container->getService('router');

        $request = $router->match(new Request(new UrlScript('/prepend-path', '/prepend-path')));
        Assert::same('PrependTest', $request['presenter']);
        Assert::same('someAction', $request['action']);

        $request = $router->match(new Request(new UrlScript('/test', '/test')));
        Assert::same('Test', $request['presenter']);
        Assert::same('default', $request['action']);
    }
}

(new PrependTest)->run();
