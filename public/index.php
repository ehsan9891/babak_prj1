<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Controller\Aboutus;
use App\Controller\Contact;
use App\Controller\Homepage;
use App\Controller\LoginHandler;
use App\Controller\Team;

require '../vendor/autoload.php';


$address = $_GET['path'];
include "../templates/nav/nav.html";

$factory = new \App\Service\TemplateRendererFactory;
$templateRenderer = $factory();

$routes = [
    'team/' => new Team,
    'kontakt/' => new Contact($templateRenderer),
    'aboutus/' => new Aboutus(),
    'login/' => new LoginHandler($templateRenderer),
];

$handler = $routes[$address] ?? new Homepage();

echo $handler->showPage();

