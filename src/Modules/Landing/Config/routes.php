<?php
declare(strict_types=1);

use Phalcon\Mvc\Router\Group as RouterGroup;

$routes = new RouterGroup([
    'module'     => 'Landing',
    'controller' => 'HomeController',
    'action'     => 'index',
    'namespace'  => 'Phlexus\Modules\Landing\Controllers',
]);

$routes->addGet('/', [
    'controller' => 'home',
    'action'     => 'index',
]);

$routes->addPost('/doContact', [
    'controller' => 'home',
    'action'     => 'doContact',
]);

// Legal

$routes->addGet('/terms-and-conditions', [
    'controller' => 'legal',
    'action'     => 'termsConditions',
]);

$routes->addGet('/disclaimer', [
    'controller' => 'legal',
    'action'     => 'disclaimer',
]);

$routes->addGet('/privacy-policy', [
    'controller' => 'legal',
    'action'     => 'privacyPolicy',
]);

$routes->addGet('/use-policy', [
    'controller' => 'legal',
    'action'     => 'usePolicy',
]);

$routes->addGet('/cookie-policy', [
    'controller' => 'legal',
    'action'     => 'cookiePolicy',
]);

$routes->addGet('/return-policy', [
    'controller' => 'legal',
    'action'     => 'returnPolicy',
]);

return $routes;