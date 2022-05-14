<?php

$address = $_GET['path'];
include "templates/nav/nav.html";

switch ($address){
    case 'team/':
        include 'src/Controller/team.php';
        break;
    case 'kontak/':
        include 'src/Controller/contact.php';
        die;
        break;
    default:
        include 'src/Controller/homepage.php';
}

