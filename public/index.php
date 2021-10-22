<?php

use DI\ContainerBuilder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';

try {
    $containerBuilder = new ContainerBuilder();
    $containerBuilder->addDefinitions(__DIR__ . '/../config/dependencies.php');
    $container = $containerBuilder->build();

    // Instantiate App
    $app = AppFactory::createFromContainer($container);

    // Add Twig-View Middleware
    $app->add(TwigMiddleware::createFromContainer($app));

    // Add error middleware
    $app->addErrorMiddleware(true, true, true);

    // Add routes
    $routes = $container->get('routes');
    foreach ($routes as $route) {
        if (
            isset($route['method'])
            && isset($route['pattern'])
            && isset($route['callable'])
        ) {
            $mappedRoute = $app->map([$route['method']], $route['pattern'], $route['callable']);
            if (isset($route['name']) && is_string($route['name'])) {
                $mappedRoute->setName($route['name']);
            }
        }
    }
    $routesCollector = $app->getRouteCollector();

    $app->run();
} catch (\Exception $e) {
    var_dump($e->getMessage());
    die("la configuration de l'application n'a pas pu être chargée");
}