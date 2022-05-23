<?php

namespace App\Service;

class TemplateRenderer
{
    public function __construct(string $device)
    {
    }

    public function render(string $filename, array $data): string
    {
        // analyse the html tags and replace some values
        $output = include __DIR__ . '/../../templates/' . $filename;
        return str_replace('title_plceholder', $data['title'], $output);
    }

}
