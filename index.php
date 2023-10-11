<?php
require_once 'config.php';
require_once 'classes/db.php';
require_once 'classes/baseController.php';
require_once 'controllers/homeController.php';
require_once 'classes/router.php';

global $db;
$db = new \Core\DB( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST );

$router = new \Core\Router();
$router->addRoute('/', 'homeController');
/*$router->addRoute('/login', 'loginController');
$router->addRoute('/registration', 'registrationController');
$router->addRoute('/account', 'accountController');*/

$url = $_SERVER['REQUEST_URI'];
$router->handleRequest($url);