<?php
declare(strict_types=1);

namespace FreezyBee\PrependRoute\Tests\Integration;

require __DIR__ . '/../bootstrap.php';

use Kdyby\Console\CliRouter;
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

        /** @var CliRouter $cliRoute */
        $cliRoute = $container->getService('console.router');
        $cliRoute->allowedMethods = [];

        /** @var IRouter $router */
        $router = $container->getService('router');

        $request = $router->match(new Request(new UrlScript('prepend-path')));
        Assert::same('PrependTest', $request->getPresenterName());
        Assert::same(['action' => 'someAction'], $request->getParameters());

        $request = $router->match(new Request(new UrlScript('test')));
        Assert::same('Test', $request->getPresenterName());
        Assert::same(['action' => 'default'], $request->getParameters());
    }
}

(new PrependTest)->run();
