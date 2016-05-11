<?php
// All file paths relative to root
// chdir(dirname(__DIR__));
if (!defined('LAYOUT')) define('LAYOUT', 'layout.twig');
if (!defined('CACHEROOT')) define('CACHEROOT', getenv('TEMP'));
if (!defined('CONFROOT')) define('CONFROOT', DOCROOT.'/app/Bookshelf/Conf/');

require DOCROOT . '/vendor/autoload.php';
session_start();

if (file_exists(CONFROOT . 'settings.php')) {
    $settings = require CONFROOT . 'settings.php';
} else {
    $settings = require CONFROOT . 'settings.php.dist';
}

// Instantiate Slim
$app = new \Slim\App($settings);

require CONFROOT . 'dependencies.php';
require CONFROOT . 'middleware.php';

// Register the routes
require CONFROOT . 'routes.php';

// Register the database connection with PdoLite
$pdolite = $app->getContainer()->get('pdolite');
$app->run();
