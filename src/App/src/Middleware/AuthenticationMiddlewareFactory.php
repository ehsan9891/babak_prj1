<?php

namespace App\Middleware;

use App\Service\CacheService;
use Mezzio\Helper\UrlHelper;
use Psr\Container\ContainerInterface;

class AuthenticationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationMiddleware
    {
        $urlHelper = $container->get(UrlHelper::class);
        $cacheService = $container->get(CacheService::class);

        return new AuthenticationMiddleware($urlHelper, $cacheService);
    }
}
