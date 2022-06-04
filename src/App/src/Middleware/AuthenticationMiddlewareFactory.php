<?php

namespace App\Middleware;

use Mezzio\Helper\UrlHelper;
use Psr\Container\ContainerInterface;

class AuthenticationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationMiddleware
    {
        $urlHelper = $container->get(UrlHelper::class);
        return new AuthenticationMiddleware($urlHelper);
    }
}
