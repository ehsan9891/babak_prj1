<?php

namespace App\Controller;

class Team extends BaseHandler
{
    public function showPage(): string
    {
        $name = $this->calculate('Babak');
        return "Welcome to team page" . $name;
    }

    private function calculate($name)
    {
        return $name . ' Welcome';
    }

    public function SayGoodbye()
    {

    }
}
