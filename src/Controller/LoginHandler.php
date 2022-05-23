<?php

namespace App\Controller;

use App\Service\TemplateRenderer;

class LoginHandler extends BaseHandler
{
    private $templateRenderer;

    public function __construct(TemplateRenderer $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
    }

    public function showPage(): string
    {

        $data = [
            'title' => 'ehsan',
        ];
        return $this->templateRenderer->render('login/login.html', $data);
    }
}
