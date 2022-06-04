<?php

namespace App\Middleware;


use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Helper\UrlHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class  AuthenticationMiddleware implements MiddlewareInterface
{
    private UrlHelper $urlHelper;

    public function __construct(UrlHelper $urlHelper)
    {
        $this->urlHelper = $urlHelper;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $isAdmin = false;
        if (!$isAdmin) {
            $url = $this->urlHelper->generate('login');
            return new RedirectResponse($url);
        }

        return $handler->handle($request);
    }
}
