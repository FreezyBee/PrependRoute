Quickstart
==========

[![Build Status](https://travis-ci.org/FreezyBee/PrependRoute.svg?branch=master)](https://travis-ci.org/FreezyBee/PrependRoute)
[![Coverage Status](https://coveralls.io/repos/github/FreezyBee/PrependRoute/badge.svg?branch=master)](https://coveralls.io/github/FreezyBee/PrependRoute?branch=master)

Installation
------------

The best way to install FreezyBee/PrependRoute is using [Composer](http://getcomposer.org/):

```sh
composer require freezy-bee/prepend-route
```

With Nette `2.4` and newer, you can enable the extension using your neon config.

```yml
extensions:
	prependRoute: FreezyBee\PrependRoute\DI\PrependRouteExtension
```

Documentation
-------------

### Usage

Your extension MUST implements interface `FreezyBee\PrependRoute\DI\IPrependRouteProvider`.

```php

class TestExtension extends CompilerExtension implements IPrependRouteProvider
{
    public function loadConfiguration(): void
    {
        // register route service (testRoute)
        ...
    }

    /**
     * Return array of services - service MUST implements IRoute
     * @return string[]
     */
    public function getPrependRoutes(): array
    {
        return [$this->prefix('testRoute')];
    }
}
```