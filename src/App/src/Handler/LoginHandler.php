<?php

declare(strict_types=1);

namespace App\Handler;


use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginHandler implements RequestHandlerInterface
{

    private TemplateRendererInterface $templateRenderer;
    private UrlHelper $urlHelper;

    public function __construct(
        TemplateRendererInterface $templateRenderer,
        UrlHelper $urlHelper
    ) {
        $this->templateRenderer = $templateRenderer;
        $this->urlHelper = $urlHelper;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $viewVariables = [
            'error' => ''
        ];
        if ($request->getMethod() == RequestMethodInterface::METHOD_POST) {
            $username = $request->getParsedBody()['username'];
            $password = $request->getParsedBody()['password'];
            if ($username == 'admin' && $password == 'admin') {
                return new RedirectResponse($this->urlHelper->generate('admin'));
            } else {
                $viewVariables['error'] = 'login failed';
            }
        }

        $output = $this->templateRenderer->render('app::login', $viewVariables);
        return new HtmlResponse($output);
    }
}
