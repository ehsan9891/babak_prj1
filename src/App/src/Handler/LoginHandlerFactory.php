<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\CacheService;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $template = $container->get(TemplateRendererInterface::class);
        $urlHelper = $container->get(UrlHelper::class);
        $cacheService = $container->get(CacheService::class);

        return new LoginHandler($template, $urlHelper, $cacheService);
    }
}
