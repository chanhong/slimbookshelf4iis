<?php
// All file paths relative to root
// chdir(dirname(__DIR__));
if (!defined('LAYOUT')) define('LAYOUT', 'layout.twig');
if (!defined('CACHEROOT')) define('CACHEROOT', getenv('TEMP'));

require DOCROOT . '/vendor/autoload.php';
session_start();

if (file_exists(DOCROOT .'/app/settings.php')) {
    $settings = require DOCROOT .'/app/settings.php';
} else {
    $settings = require DOCROOT .'/app/settings.php.dist';
}

// Instantiate Slim
$app = new \Slim\App($settings);

require DOCROOT .'/app/src/dependencies.php';
require DOCROOT .'/app/src/middleware.php';

// Register the routes
require DOCROOT .'/app/src/routes.php';

// Register the database connection with Eloquent
$capsule = $app->getContainer()->get('capsule');
$capsule->bootEloquent();

$app->run();
