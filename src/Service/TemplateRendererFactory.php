<?php

namespace App\Service;

class TemplateRendererFactory
{

    public function __invoke(): TemplateRenderer
    {
        return new TemplateRenderer('mobile');
    }
}
