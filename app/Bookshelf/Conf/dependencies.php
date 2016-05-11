<?php
// DIC configuration
$container = $app->getContainer();

//use Lib\MVC4Slim\PdoLite;
use PdoLite\PdoLite;
use Lib\MVC4Slim\TwigExtension;

// Database
$container['pdolite'] = function ($c) {
    /*
    $settings = $c->get('settings')['pdolite'];
    $conn = PdoLite::dbConnect($settings['dsn'],$settings['username'],$settings['password']);
    */
    PdoLite::$cfg = $settings = $c->get('settings')['pdolite'];    
    $conn = PdoLite::dbConnect($settings['dsn'],$settings['username'],$settings['password']);
    return $conn;        
};

$container['pdo'] = function ($c) {
    $settings = $c->get('settings')['pdo'];
        print_r($settings);    
    
    $conn = new PDO($settings['dsn'], $settings['username'], $settings['password']);
        echo ("<br />Connect Info: ");
        print_r($conn); 
    return $conn;
};

$container['capsule'] = function ($c) {
    $capsule = new Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($c['settings']['db']);
    return $capsule;
};

// View
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig($c['settings']['view']['template_path'], $c['settings']['view']['twig']);

    // Add extensions
//    echo "uri: ".$c['request']->getUri();
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $c['request']->getUri()));
    $view->addExtension(new Twig_Extension_Debug());
//    $view->addExtension(new MVC4Slim\TwigExtension($c['flash']));
    $view->addExtension(new TwigExtension($c['flash']));

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
    return new Bookshelf\Controllers\AuthorController($c);
};

$container['Bookshelf\Controllers\BookController'] = function ($c) {
    return new Bookshelf\Controllers\BookController($c);
};

$container['phpview'] = function ($c) {
    $phpview = new \Slim\Views\PhpRenderer($c['settings']['view']['template_path']);
    
    return $phpview;
};