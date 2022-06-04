<?php

declare(strict_types=1);

namespace App\Handler;


use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdminHandler implements RequestHandlerInterface
{

    private TemplateRendererInterface $templateRenderer;

    public function __construct(TemplateRendererInterface $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $output = $this->templateRenderer->render('app::adminPanel');
        return new HtmlResponse($output);
    }
}
