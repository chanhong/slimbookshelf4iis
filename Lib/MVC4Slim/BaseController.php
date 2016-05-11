<?php

namespace Lib\MVC4Slim;

use Slim\Views\Twig;
use Slim\Router;
use Slim\Flash\Messages as FlashMessages;

class BaseController
{
    public $app;
    public $view;
    public $router;
    public $flash;
    public $settings;
    
    private $pubdir;
    private $selected_layout;

    public function __construct($app)
    {
        $this->app = $app;
        $this->view = $app->view;
        $this->router = $app->router;
        $this->flash = $app->flash;
        $this->settings = $app->settings;


        if (!empty($app->settings['tpl']['pubdir'])) $this->pubdir = '/'. $app->settings['tpl']['pubdir'];
        if (!empty($app->settings['tpl']['selected_layout'])) $this->selected_layout = $app->settings['tpl']['selected_layout'];
        $this->app->settings['tpl'] = ['pubdir'=> $this->pubdir,'selected_layout'=> $this->selected_layout];
    }

}
