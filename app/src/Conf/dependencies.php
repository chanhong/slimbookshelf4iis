<?php
// DIC configuration
$container = $app->getContainer();

// Database
$container['capsule'] = function ($c) {
    $capsule = new Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($c['settings']['db']);
    return $capsule;
};

// View
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig($c['settings']['view']['template_path'], $c['settings']['view']['twig']);

    // Add extensions
    echo "uri: ".$c['request']->getUri();
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $c['request']->getUri()));
    $view->addExtension(new Twig_Extension_Debug());
    $view->addExtension(new Lib\TwigExtension($c['flash']));

    return $view;
};

// CSRF guard
$container['csrf'] = function ($c) {
    $guard = new \Slim\Csrf\Guard();
    $guard->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute("csrf_status", false);
        return $next($request, $response);
    });
    return $guard;
};

// Flash messages
$container['flash'] = function ($c) {
    return new \Slim\Flash\Messages;
};

// controller
$container['Bookshelf\Controllers\AuthorController'] = function ($c) {
    return new Bookshelf\Controllers\AuthorController($c['view'], $c['router'], $c['flash'], $c['settings']['tpl']);
};

$container['Bookshelf\Controllers\BookController'] = function ($c) {
    return new Bookshelf\Controllers\BookController($c['view'], $c['router'], $c['flash'], $c['settings']['tpl']);
};

$container['phpview'] = function ($c) {
    $phpview = new \Slim\Views\PhpRenderer($c['settings']['view']['template_path']);
    
    return $phpview;
};