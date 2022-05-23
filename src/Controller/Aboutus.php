<?php

namespace App\Controller;

use App\Service\TemplateRenderer;

class Aboutus extends BaseHandler
{
    private ?TemplateRenderer $templateRender = null;

    public function showPage(): string
    {
        return $this->templateRender->render('',[]);
    }

    /**
     * @return \App\Service\TemplateRenderer|null
     */
    public function getTemplateRender()
    {
        return $this->templateRender;
    }

    /**
     * @param \App\Service\TemplateRenderer $templateRender
     */
    public function setTemplateRender(TemplateRenderer $templateRender)
    {
        $this->templateRender = $templateRender;
    }
}
