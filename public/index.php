<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Controller\Aboutus;
use App\Controller\Contact;
use App\Controller\Homepage;
use App\Controller\LoginHandler;
use App\Controller\Team;
use App\Service\TemplateRenderer;
use App\Service\TemplateRendererFactory;

require '../vendor/autoload.php';


$address = $_GET['path'];
include "../templates/nav/nav.html";


function getService(string $class){
    $factories = [
        TemplateRenderer::class => TemplateRendererFactory::class,
    ];

    $factory = new $factories[$class];
    return $factory();
}


$routes = [
    'team/' => new Team,
    'kontakt/' => new Contact(getService(TemplateRenderer::class)),
    'aboutus/' => new Aboutus(),
    'login/' => new LoginHandler(getService(TemplateRenderer::class)),
];

$handler = $routes[$address] ?? new Homepage();

echo $handler->showPage();

