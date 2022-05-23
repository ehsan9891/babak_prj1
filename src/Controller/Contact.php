<?php

namespace App\Controller;

use App\Service\TemplateRenderer;

class Contact extends BaseHandler
{
    private $templateRenderer;

    public function __construct(TemplateRenderer $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
    }

    public function showPage(): string
    {
        return $this->templateRenderer->render('contact/contact.html', []);
    }
}
