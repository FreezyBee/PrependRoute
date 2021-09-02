<?php

declare(strict_types=1);

namespace FreezyBee\PrependRoute\DI;

use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;

/**
 * @author Jakub Janata <jakubjanata@gmail.com>
 */
class PrependRouteExtension extends CompilerExtension
{
    /**
     * @param ClassType $classType
     */
    public function afterCompile(ClassType $classType): void
    {
        /** @var string[][] $routeDefs */
        $routeDefs = [];

        /** @var CompilerExtension $extension */
        foreach ($this->compiler->getExtensions() as $extension) {
            if ($extension instanceof IPrependRouteProvider) {
                $routeDefs[] = $extension->getPrependRoutes();
            }
        }

        if (!$routeDefs) {
            return;
        }

        $method = $classType->getMethod('createServiceRouter');

        $newBody = '$mainService = new Nette\Application\Routers\RouteList();' . "\n";

        foreach ($routeDefs as $routeDef) {
            foreach ($routeDef as $route) {
                $newBody .= "\$mainService[] = \$this->getService('$route');\n";
            }
        }

        $oldBody = str_replace('return ', '$mainService[] = ', $method->getBody() ?? '');

        $method->setBody("$newBody $oldBody return \$mainService;");
    }
}
